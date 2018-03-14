<?php



namespace App\Http\Controllers\Admin;


use App\User;
use App\Gsmile;
use App\Rsmile;
use App\Matchuser;
use App\Cconfirmation;
use App\Message;
use App\Insurance;
use App\Retaiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class MatchuserController extends Controller
{

	public function read()
    {
    	$matches=Matchuser::orderBy('id','desc')->paginate(500);
    	//echo json_encode($match);

        $timeLeftArray=[];

if(!empty($matches)){
            $count=0;
        foreach ($matches as $key => $match) {
          $timeUsed=intval(time())-intval(strtotime($match->created_at));

          if($match->is_extended == 1){
            $allocatedTime=(48+6)*60*60 ;  //48 + 6 hours
          }else{
             $allocatedTime=48*60*60 ; //48 hours to seconds
          }

          $timeLeft= $allocatedTime-$timeUsed;

          if($timeLeft <= 0){
            $timeLeftArray[$count] =0;
          }else{
          $timeLeftArray[$count] = $timeLeft;

          }

          $count++;
        }

    }

    	$achievedMatchNo=Matchuser::all()->count();
        return view('admin.match.list',['matches'=>$matches, 'achievedMatchNo'=>$achievedMatchNo, 'timeLeftArray'=>$timeLeftArray]);
    }


    public function unmatch($id)

    {
        $match=Matchuser::where('id', $id)->first();
        $gsmile_id=$match->gsmile_id;
        $rsmile_id=$match->rsmile_id;
        //echo json_encode($match);
        //rollback
                           //for GS
                    $newGsLeftAmount= ($match->gsmile->left_amount + $match->amount);
                    Gsmile::where('id', $match->gsmile->id)->update(['left_amount'=>$newGsLeftAmount]);
                        //for RS
                    if(isset($match->rsmile->id)){
                        $newRsLeftAmount= ($match->rsmile->left_amount + $match->amount);
                        Rsmile::where('id', $match->rsmile->id)->update(['left_amount'=>$newRsLeftAmount]);
                    }
                    //delete
                    //if(isset($match->confirmation->id)){}
                    Cconfirmation::where('match_id',$match->id)->delete();
                    //report


        //delete match
        $match=Matchuser::where('id',$id)->delete();

        return Redirect::to('admin/matches/list')->with('notification','Users succefully Unmatched');
    }


    public function SelectUnmatchedGs ($rs_id)
    {
    $RsUser= Rsmile::where('id',$rs_id)->first();
    $UmatchedSmiles=Gsmile::where('left_amount','>',0)->orderBy('id', 'asc')->get();//->paginate(20);
        $UmatchedSmilesNo=Gsmile::where('left_amount','>',0)->count();
        return view('admin.match.select_users_to_match',['UmatchedSmiles'=>$UmatchedSmiles, 'UmatchedSmilesNo'=>$UmatchedSmilesNo,'RsId'=>$rs_id, 'RsAmount'=>$RsUser->left_amount,'RsName'=>$RsUser->user->name]);
    }



    public function MatchManually(Request $request)
    {
    		$rsmile_id=$request->RsId;
    	//$request->all() corresponds to php $_REQUEST HTTP supperglobal array
            //value format =GS20000, RS101 GS0
    	foreach ($request->all() as $key => $value) {

    		if($key == 'RsId'){    //remove RS ID
    			continue;
    		}

            if($key == '_token'){    //remove remember token
                continue;
            }

            if($value == 0){    //Remove 0
                continue;
            }

    		$gsmile_id=$key;
            $amountToRemoveFromGS=intval($value);

    	$gsmile=Gsmile::where('id',$gsmile_id)->first();
    	$rsmile=Rsmile::where('id',$rsmile_id)->first();


    		//match script

    	 $match= new Matchuser;
    	 $match->gsmile_user_id=$gsmile->user->id;
    	 $match->rsmile_user_id=$rsmile->user->id;
    	 $match->gsmile_id=$gsmile_id;
    	 $match->rsmile_id=$rsmile_id; //0 for pioneers
    	 $amountToPay=$match->amount=$amountToRemoveFromGS;
    	 $match->payment_status=1;
    	 $track_token=mt_rand(10000, 1000000);
    	 $match->track_token=$track_token;
    	 $match->remember_token=$request->_token;
    	 $match->save();


    	 $confirm=new Cconfirmation;
    	 $confirm->gsmile_id=$gsmile_id;
    	 $confirm->rsmile_id=$rsmile_id;
         $confirmM=Matchuser::where('track_token',$track_token)->first();
    	 $confirm->match_id=$confirmM->id;
    	 $confirm->payment_status=1;
    	 $confirm->amount=$amountToPay;
    	 $confirm->left_amount=($gsmile->left_amount - $amountToPay);
    	 $confirm->remember_token=$request->_token;
    	 $confirm->save();

    	 Gsmile::where('id',$gsmile_id)->update(['left_amount'=>($gsmile->left_amount - $amountToPay)]);
    	 Rsmile::where('id',$rsmile_id)->update(['left_amount'=>($rsmile->left_amount-$amountToPay)]);

    	 //end og matching script

       //send GS MATCHING SMS
       $check=0.8 * $gsmile->Left_amount;
       if($check == $amountToRemoveFromGS){
                 $json_url = "http://api.ebulksms.com:8080/sendsms.json";
                 $xml_url = "http://api.ebulksms.com:8080/sendsms.xml";
                 $username = null;
                 $apikey = null;

                     $username = "smilesteadily@gmail.com";
                     $apikey = "4c8260b451691cdbb07dfa8e47a994bdcd412b51";
                     $sendername = substr("SMILES!", 0, 11);
                     $recipients = $gsmile->user->phone;
                     $message = "Hi SMILER, your 80% smile has been matched. Kindly make payment and get confirmed. Then, proceed to hae your new GS IP confirmed to enable your RS";
                     $flash = 0;
                     if (get_magic_quotes_gpc()) {
                         $message = stripslashes($message);
                     }
                     $message = substr($message, 0, 160);
                 #Use the next line for HTTP POST with JSON
                     $result = $this->useJSON($json_url, $username, $apikey, $flash, $sendername, $message, $recipients);
                 #Uncomment the next line and comment the one above if you want to use HTTP POST with XML
                     //$result = useXML($xml_url, $username, $apikey, $flash, $sendername, $message, $recipients);




                 //$result=="SUCCESS"
     }


		 //send RS SMS

		 $json_url = "http://api.ebulksms.com:8080/sendsms.json";
		 $xml_url = "http://api.ebulksms.com:8080/sendsms.xml";
		 $username = null;
		 $apikey = null;

				 $username = "smilesteadily@gmail.com";
				 $apikey = "4c8260b451691cdbb07dfa8e47a994bdcd412b51";
				 $sendername = substr("SMILES!", 0, 11);
				 $recipients = $rsmile->user->phone;
				 $message = "Hi SMILER, you've been matched to receive a sum of ".number_format($amountToRemoveFromGS, 2)." From ".$gsmile->user->name.". kindly login to your dashboard.";
				 $flash = 0;
				 if (get_magic_quotes_gpc()) {
						 $message = stripslashes($message);
				 }
				 $message = substr($message, 0, 160);
		 #Use the next line for HTTP POST with JSON
				 $result = $this->useJSON($json_url, $username, $apikey, $flash, $sendername, $message, $recipients);
		 #Uncomment the next line and comment the one above if you want to use HTTP POST with XML
				 //$result = useXML($xml_url, $username, $apikey, $flash, $sendername, $message, $recipients);

       //send sms


    	}

    	return Redirect::to('admin/rsmile/list')->with('notification','User succefully matched with other participants. ');

    }










    public function MatchManuallyBODMAS(Request $request)
    {
            $rsmile_id=$request->RsId;
        //$request->all() corresponds to php $_REQUEST HTTP supperglobal array
        foreach ($request->all() as $key => $value) {
            if($value != 'on'){
                continue;
            }

            $gsmile_id=$key;

        $gsmile=Gsmile::where('id',$gsmile_id)->first();
        $rsmile=Rsmile::where('id',$rsmile_id)->first();


            //match script

         $match= new Matchuser;
         $match->gsmile_user_id=$gsmile->user_id;
         $match->rsmile_user_id=$rsmile->user_id;
         $match->gsmile_id=$gsmile_id;
         $match->rsmile_id=$rsmile_id; //0 for pioneers
         $amountToPay=$match->amount=$gsmile->left_amount;
         $match->payment_status=1;
         $track_token=mt_rand(10000, 1000000);
         $match->track_token=$track_token;
         $match->remember_token=$request->_token;
         $match->save();


         $confirm=new Cconfirmation;
         $confirm->gsmile_id=$gsmile_id;
         $confirm->rsmile_id=$rsmile_id;
         $confirmM=Matchuser::where('track_token',$track_token)->first();
         $confirm->match_id=$confirmM->id;
         $confirm->payment_status=1;
         $confirm->amount=$amountToPay;
         $confirm->left_amount=($amountToPay - $gsmile->left_amount);
         $confirm->remember_token=$request->_token;
         $confirm->save();

         Gsmile::where('id',$gsmile_id)->update(['left_amount'=>($amountToPay - $gsmile->left_amount)]);
         Rsmile::where('id',$rsmile_id)->update(['left_amount'=>($rsmile->left_amount-$amountToPay)]);

         //end og matching script


        }

        return Redirect::to('admin/rsmile/list')->with('notification','User succefully matched with other participants. ');

    }




    public function ConfirmPayment(Request $request){

        $match=Matchuser::where('id', $request->matchId)->first();


        //for initial or First GS of pioneer :100%
        //bot fadahunsi case

        if($match->rsmile_user->email=="fadahunsi@gmail.com" || $match->rsmile_user->id==37){
            //that is bot
            $mathAmount=$match->amount;
            //update payment status
            Matchuser::where('id', $request->matchId)->update(['payment_status' =>3]);
            $match= Matchuser::where('id', $request->matchId)->first();

            //update payment status
            Cconfirmation::where('match_id', $request->matchId)->update(['payment_status' =>3]);
            //update amount = match amount
            Cconfirmation::where('match_id', $request->matchId)->update(['amount' =>$mathAmount]);
            //update payment left amount=GS left amount
            Cconfirmation::where('match_id', $request->matchId)->update(['left_amount' =>$match->gsmile->left_amount]);

            $bot_rsmile=Rsmile::where('id', $match->rsmile_id)->first();

            if(!empty($bot_rsmile)){
                if($bot_rsmile->left_amount==0){
                Rsmile::where('id', $bot_rsmile->id)->update(['payment_status'=>3]);
            }

            }



            //generate RS for pioneer
            if($match->gsmile_user->is_pioneer =='1'){
         $rsmile= new Rsmile;
         $rsmile->user_id=$match->gsmile_user->id;
         $rsmile->gsmile_id=$match->gsmile_id;
         $rsmile->amount= $mathAmount * 2;
         $rsmile->left_amount= $mathAmount * 2;
         $rsmile->track_token=$track_token=mt_rand(1000, 100000);
         $rsmile->save();
     }

            //turn indurance count to 1; partiallly paid or not paid & participate in 10% collection
         Insurance::where('pioneer_id', $match->gsmile_user->id)->update(['count'=>1]);

        }else{


            //for other times: 10% and part or all 90%
            //not bot fadahunsi
           $match=Matchuser::where('id', $request->matchId)->first();
           //echo json_encode($match);
           $mathAmount=$match->amount;
            //update payment status
            Matchuser::where('id', $request->matchId)->update(['payment_status' =>3]);
            $match= Matchuser::where('id', $request->matchId)->first();
            //update payment status
            Cconfirmation::where('match_id', $request->matchId)->update(['payment_status' =>3]);

            //update amount = match amount
            Cconfirmation::where('match_id', $request->matchId)->update(['amount' =>$match->amount]);

            //update payment left amount=GS left amount
            Cconfirmation::where('match_id', $request->matchId)->update(['left_amount' =>$match->gsmile->left_amount]);

            //for paying pioneer
            if($match->gsmile_user->is_pioneer=='1'){
            if($match->gsmile->left_amount==0){
                //pioneer has been fully paid and circle ends
                  //turn indurance count to 0; fully paid,do not participate in 10% collection
                Insurance::where('pioneer_id', $match->gsmile_user->id)->update(['count'=>0]);

            }elseif($match->gsmile->left_amount>0){
                 //turn indurance count to 1; partiallly paid or not paid & participate in 10% collection
                Insurance::where('pioneer_id', $match->gsmile_user->id)->update(['count'=>1]);
            }

          }


            //for receiving pioneer
            if($match->rsmile_user->is_pioneer=='1'){
              if($match->rsmile->left_amount==0){
                //pioneer has been fully paid and circle ends
                  //turn indurance count to 0; fully paid,do not participate in 10% collection
                Insurance::where('pioneer_id', $match->rsmile_user->id)->update(['count'=>0]);

            }elseif($match->rsmile->left_amount>0){
                 //turn indurance count to 1; partiallly paid or not paid & participate in 10% collection
                Insurance::where('pioneer_id', $match->rsmile_user->id)->update(['count'=>1]);
            }

            }






            $receiver_rsmile=Rsmile::where('id', $match->rsmile_id)->first();

            if(!empty($receiver_rsmile)){
                if($receiver_rsmile->left_amount==0){
                 Rsmile::where('id', $receiver_rsmile->id)->update(['payment_status'=>3]);
            }

            }


            //for retainment unfreezing

            if(isset($match->gsmile->r_token)){

              if($match->gsmile->r_token>0){



              $r_token=$match->gsmile->r_token;

              Retaiment::where('r_token',$r_token)->update(['status'=>1]);

              }

            }




        }







      /*if($match->gsmile_user->is_pioneer == '1'){

        $insurance=Insurance::where('pioneer_id',$match->gsmile_user->id)->first();
        if(empty($insurance) || !isset($insurance)){
          Insurance::where('pioneer_id',$match->gsmile_user->id)->update(['count'=>1]);
        }else{
          $count=$insurance->count;
          $newCount=$count+1;
          Insurance::where('pioneer_id',$match->gsmile_user->id)->update(['count'=>$newCount]);
        }

      } */


      //Matchuser::where('id', $request->matchId)->update(['payment_status' =>3]);
     // $match= Matchuser::where('id', $request->matchId)->first();

       // Cconfirmation::where('match_id', $request->matchId)->update(['payment_status' =>3]);

      //SMS API
        //sendSMS section

      $check=0.2 * $match->gsmile->amount;
      if($check == $match->amount){
                $json_url = "http://api.ebulksms.com:8080/sendsms.json";
                $xml_url = "http://api.ebulksms.com:8080/sendsms.xml";
                $username = null;
                $apikey = null;

                    $username = "smilesteadily@gmail.com";
                    $apikey = "4c8260b451691cdbb07dfa8e47a994bdcd412b51";
                    $sendername = substr("SMILES!", 0, 11);
                    $recipients = $match->gsmile_user->phone;
                    $message = "Your 20% down payment of ".(number_format(0.2*$match->gsmile->amount,2))." has been confirmed. You remaining 80% will be matched within the next 15 days. Keep smilling!";
                    $flash = 0;
                    if (get_magic_quotes_gpc()) {
                        $message = stripslashes($message);
                    }
                    $message = substr($message, 0, 160);
                #Use the next line for HTTP POST with JSON
                    $result = $this->useJSON($json_url, $username, $apikey, $flash, $sendername, $message, $recipients);
                #Uncomment the next line and comment the one above if you want to use HTTP POST with XML
                    //$result = useXML($xml_url, $username, $apikey, $flash, $sendername, $message, $recipients);

    }


    $check2=0.8 * $match->gsmile->amount;
    if($check2 == $match->amount){
              $json_url = "http://api.ebulksms.com:8080/sendsms.json";
              $xml_url = "http://api.ebulksms.com:8080/sendsms.xml";
              $username = null;
              $apikey = null;

                  $username = "smilesteadily@gmail.com";
                  $apikey = "4c8260b451691cdbb07dfa8e47a994bdcd412b51";
                  $sendername = substr("SMILES!", 0, 11);
                  $recipients = $match->gsmile_user->phone;
                  $message = "Your 80% down payment of ".(number_format(0.8*$match->gsmile->amount,2))." has been confirmed. You remaining 80% will be matched within the next 15 days. Keep smilling!";
                  $flash = 0;
                  if (get_magic_quotes_gpc()) {
                      $message = stripslashes($message);
                  }
                  $message = substr($message, 0, 160);
              #Use the next line for HTTP POST with JSON
                  $result = $this->useJSON($json_url, $username, $apikey, $flash, $sendername, $message, $recipients);
              #Uncomment the next line and comment the one above if you want to use HTTP POST with XML
                  //$result = useXML($xml_url, $username, $apikey, $flash, $sendername, $message, $recipients);

  }


      return Redirect::to('admin/matches/list')->with('notification','Payment has successfully been confirmed.');


    }





    //SMS gateway RestFul API functions

    public function useJSON($url, $username, $apikey, $flash, $sendername, $messagetext, $recipients) {
    $gsm = array();
    $country_code = '234';
    $arr_recipient = explode(',', $recipients);
    foreach ($arr_recipient as $recipient) {
      $mobilenumber = trim($recipient);
      if (substr($mobilenumber, 0, 1) == '0'){
          $mobilenumber = $country_code . substr($mobilenumber, 1);
      }
      elseif (substr($mobilenumber, 0, 1) == '+'){
          $mobilenumber = substr($mobilenumber, 1);
      }
      $generated_id = uniqid('int_', false);
      $generated_id = substr($generated_id, 0, 30);
      $gsm['gsm'][] = array('msidn' => $mobilenumber, 'msgid' => $generated_id);
    }
    $message = array(
      'sender' => $sendername,
      'messagetext' => $messagetext,
      'flash' => "{$flash}",
    );

    $request = array('SMS' => array(
          'auth' => array(
              'username' => $username,
              'apikey' => $apikey
          ),
          'message' => $message,
          'recipients' => $gsm
    ));
    $json_data = json_encode($request);
    if ($json_data) {
      $response = $this->doPostRequest($url, $json_data, array('Content-Type: application/json'));
      $result = json_decode($response);
      return $result->response->status;
    } else {
      return false;
    }
    }

    //Function to connect to SMS sending server using HTTP POST

    public function doPostRequest($url, $data, $headers = array('Content-Type: application/x-www-form-urlencoded'))
    {
    $php_errormsg = '';
    if (is_array($data)) {
      $data = http_build_query($data, '', '&');
    }
    $params = array('http' => array(
          'method' => 'POST',
          'content' => $data)
    );
    if ($headers !== null) {
      $params['http']['header'] = $headers;
    }
    $ctx = stream_context_create($params);
    $fp = fopen($url, 'rb', false, $ctx);
    if (!$fp) {
      return "Error: gateway is inaccessible";
    }
    //stream_set_timeout($fp, 0, 250);
    try {
      $response = stream_get_contents($fp);
      if ($response === false) {
          throw new Exception("Problem reading data from $url, $php_errormsg");
      }
      return $response;
    } catch (Exception $e) {
      $response = $e->getMessage();
      return $response;
    }
    }





}
