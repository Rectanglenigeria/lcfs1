<?php

namespace App\Http\Controllers;

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
    public function view($match_id)
    {
    	$match=Matchuser::where('id', $match_id)->first();
    	//echo json_encode($match);
    	$timeUsed=intval(time())-intval(strtotime($match->created_at));

		  if($match->is_extended == 1){
		  	$allocatedTime=48*60*60 ;  //48 + 6 hours
		  }else{
		  	 $allocatedTime=24*60*60 ; //48 hours to seconds
		  }

          $timeLeft= $allocatedTime-$timeUsed;

          if($timeLeft <= 0){
          	$timeLeft =0;
          }else{
          $timeLeft =$timeLeft;

          }

    	return view('pages.auth_pages.matches.view_payment_details',['match'=>$match, 'timeLeft'=>$timeLeft]);
    }

    public function viewrs($match_id)
    {
    	$match=Matchuser::where('id', $match_id)->first();
    	//echo json_encode($match);
    	$timeUsed=intval(time())-intval(strtotime($match->created_at));
    	if($match->is_extended == 1){
		  	$allocatedTime=48*60*60 ;  //48 + 6 hours
		  }else{
		  	 $allocatedTime=24*60*60 ; //48 hours to seconds
		  }

          $timeLeft= $allocatedTime-$timeUsed;

          if($timeLeft <= 0){
          	$timeLeft =0;
          }else{
          $timeLeft =$timeLeft;

          }
    	return view('pages.auth_pages.matches.rsview_payment_details',['match'=>$match, 'timeLeft'=>$timeLeft]);
    }

    public function extendPaymentTime($match_id)
    {
    	Matchuser::where('id',$match_id)->update(['is_extended'=>1]);
    	$match=Matchuser::where('id', $match_id)->first();
    	//echo json_encode($match);
    	$timeUsed=intval(time())-intval(strtotime($match->created_at));
    	if($match->is_extended == 1){
		  	$allocatedTime=48*60*60 ;  //48 + 6 hours
		  }else{
		  	 $allocatedTime=24*60*60 ; //48 hours to seconds
		  }

          $timeLeft= $allocatedTime-$timeUsed;

          if($timeLeft <= 0){
          	$timeLeft =0;
          }else{
          $timeLeft =$timeLeft;

          }
    	return view('pages.auth_pages.matches.rsview_payment_details',['match'=>$match, 'timeLeft'=>$timeLeft]);
    }


    public function UploadPaymentTeller(Request $request){


      $formData=$request->all();

        $rule=array(
            'file' => 'required|image|mimes:jpeg,png,jpg|max:3000000'
            );

        $message=array(
            'file.required'=>'Teller is required.',
            );

        $validator=Validator::make($formData, $rule, $message);

        if($validator->fails()){
            return Redirect::to('matches/view/'.$request->matchId)->with('notification','Teller must either be in JPEG, PNG or JPG format. Maximum file size allowed is 3MB');

        }else{


    	if($request->hasFile('file')){
    		$file=$request->file('file');

        $fileName=$file->getClientOriginalName();

        //validate intaganographic : php script in image formData
        if(stripos($fileName, 'php')){
          return Redirect::to('matches/view/'.$request->matchId)->with('notification','Teller name must not contain "php" keyword. Kindly rename the teller');
        }

    		$file->move('public/uploads',$file->getClientOriginalName());

    	Matchuser::where('id', $request->matchId)->update(['payment_status' =>2]);
        //specify payment_type
       /* $match=Matchuser::where('id', $request->matchId)->first();
        if((($match->gsmile->amount - $match->amount)/100) == 90){
          Matchuser::where('id', $request->matchId)->update(['payment_type' =>1]);
        }*/

        Matchuser::where('id', $request->matchId)->update(['payment_status' =>2]);


    		Cconfirmation::where('match_id', $request->matchId)->update(['teller_link' => $file->getClientOriginalName()]);

        //specify payment_type
      /*  $confirm=Cconfirmation::where('match_id', $request->matchId)->first();
        if((($match->gsmile->amount - $match->amount)/100) == 90){

          Cconfirmation::where('match_id', $request->matchId)->update(['payment_type' =>1]);
        }*/

    		Cconfirmation::where('match_id', $request->matchId)->update(['payment_status' =>2]);



    		return Redirect::to('matches/view/'.$request->matchId)->with('notification','Payment teller successfully uploaded. Awaiting confirmation from other party.');
    	}else{

    		return Redirect::to('matches/view/'.$request->matchId)->with('notification','No payment teller');

    	}
    }


  }











































    public function ConfirmPayment(Request $request){

        $match=Matchuser::where('id', $request->matchId)->first();


        //for initial or First GS of pioneer :100%
        //bot fadahunsi case

        if($match->rsmile_user->email=="system@gmail.com" || $match->rsmile_user->id==37){
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
            if($match->gsmile_user->is_pioneer =='1' || $match->gsmile_user->is_early_reaper =='1'){

                if($match->gsmile_user->is_early_reaper =='1'){
                  $rsmileAmount=$mathAmount*1.6;
                }

                if($match->gsmile_user->is_pioneer =='1'){
                  $rsmileAmount=$mathAmount*1.8;

                }

         $rsmile= new Rsmile;
         $rsmile->user_id=$match->gsmile_user->id;
         $rsmile->gsmile_id=$match->gsmile_id;
         $rsmile->amount= $rsmileAmount;
         $rsmile->left_amount= $rsmileAmount;
         $rsmile->track_token=$track_token=mt_rand(1000, 100000);
         $rsmile->save();
     }

            //turn indurance count to 1; partiallly paid or not paid & participate in 10% collection
         Insurance::where('pioneer_id', $match->gsmile_user->id)->update(['count'=>1]);

        }else{


            //for other times: 10% and part or all 90%
            //not bot fadahunsi
           $match=Matchuser::where('id', $request->matchId)->first();
           echo json_encode($match);
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

      $check=0.3 * $match->gsmile->amount;
      if($check == $match->amount){
                $json_url = "http://api.ebulksms.com:8080/sendsms.json";
                $xml_url = "http://api.ebulksms.com:8080/sendsms.xml";
                $username = null;
                $apikey = null;

                    $username = "laughtercommunity@gmail.com";
                    $apikey = "93b7beb42956897243858e7587df11527c212deb";
                    $sendername = substr("SMILES!", 0, 11);
                    $recipients = $match->gsmile_user->phone;
                    $message = "Your 30% down payment of ".(number_format(0.3*$match->gsmile->amount,2))." has been confirmed. You remaining 70% will be matched within the next 15 days. Keep smilling!";
                    $flash = 0;
                    if (get_magic_quotes_gpc()) {
                        $message = stripslashes($message);
                    }
                    $message = substr($message, 0, 160);
                #Use the next line for HTTP POST with JSON
                    $result = $this->useJSON($json_url, $username, $apikey, $flash, $sendername, $message, $recipients);
                #Uncomment the next line and comment the one above if you want to use HTTP POST with XML
                    //$result = useXML($xml_url, $username, $apikey, $flash, $sendername, $message, $recipients);


                //sendSMS section

                //$result=="SUCCESS"
}





    	return Redirect::to('matches/viewrs/'.$request->matchId)->with('notification','Payment has successfully been confirmed.');


    }






























































    public function FakeReceipt($match_id)
    {
      $match=Matchuser::where('id', $match_id)->first();
      if(!empty($match)){

        //report GS user

                    $report=new Message;
                    $report->name=$match->rsmile_user->name;
                    $report->email=$match->rsmile_user->email;
                    $report->title="Fake Teller Message";
                    $report->type=3;
                    $report->attachment_link=$match->confirmation->teller_link;
                    $report->body= "User ".$match->gsmile_user->name." ( email = ".$match->gsmile_user->email.", phone number = ".$match->gsmile_user->phone.") uploaded a teller in an attempt to fulfill GS request (Amnt=".number_format($match->amount, 2).", Date=".$match->created_at."). on or before allocated time. Receiver Details : Name = ".$match->rsmile_user->name.", Email =".$match->rsmile_user->email.", Phone number = ".$match->rsmile_user->phone.". Kindly block and re-match me. Thanks";
                    $report->save();

                    return Redirect::to('/matches/viewrs/'.$match_id)->with('notification','Issue has been reported to an adminitrator and we will check it and get back to you soon. You can also chat with our online support team. Thanks');



      }

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

//SMS gateway RestFul API functions
}
