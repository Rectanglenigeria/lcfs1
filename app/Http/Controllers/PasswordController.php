<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function view()
    {
    	return view('auth.password');
    }


    public function reset(Request $request)
    {
    	$formData=$request->all();

        $rule=array(
            'phone'=>'required',
            );

        $message=array(
            'phone.required'=>'phone number is required.',
            );

        $validator=Validator::make($formData, $rule, $message);

        if($validator->fails()){
            return Redirect::to('/passwords/reset')->withErrors($validator);

        }else{

        	$user=User::where('phone',$request->phone)->first();

        	if($user->phone == $request->phone){

        		$user_id = base64_encode($user->id);


        			// send link to user phone
                //SMS API
        //sendSMS section
                $json_url = "http://api.ebulksms.com:8080/sendsms.json";
                $xml_url = "http://api.ebulksms.com:8080/sendsms.xml";
                $username = null;
                $apikey = null;
                    
                    $username = "laughtercommunity@gmail.com";
                    $apikey = "93b7beb42956897243858e7587df11527c212deb";
                    $sendername = substr("LAUGHTER!", 0, 11);
                    $recipients = $user->phone;
                    $message = $user_id." is your code";
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

                if($result=="SUCCESS"){

                   return Redirect::to('/passwords/update/'.$user->id)->with('notification','All done. Enter code sent to your phone here.');
                }else{
                    return Redirect::to('/passwords/reset')->with('notification','Technical error. Try latter.');
                }




        		
        	}else{
        		return Redirect::to('/passwords/reset')->with('notification','Wrrong phone number');
        	}
            

        	
          	

           
        }
    }



    public function showUpdateForm($user_id)
    {
    	//$user_id=base64_decode($user_id);
    	return view('auth.update_password', ['user_id'=>$user_id]);
    }


     public function showGetForm($user_id)
    {
        //$user_id=base64_decode($user_id);
        return view('auth.get_new_password', ['user_id'=>$user_id]);
    }



    public function verifyCode(Request $request)
    {

        $formData=$request->all();

        $rule=array(
            'code'=>'required',
            );

        $message=array(
            'code.required'=>'Code  is required.',
            );

        $validator=Validator::make($formData, $rule, $message);

        if($validator->fails()){
            return Redirect::to('/passwords/update/'.base64_decode($request->user_id))->withErrors($validator);

        }else{


            $userID=base64_decode($request->code);
            $data=User::where('id',$userID)->get();

            if(empty($data)){
                return Redirect::to('/passwords/update/'.base64_decode($request->user_id))->with('notification','Codes do not match.');
            }else{

                return Redirect::to('/passwords/getNew/'.$userID)->with('notification','Enter new password here.');

            }

                return Redirect::to('/login')->with('notification','All done. Your password has been reset login below');
            
            }

    }


    public function updatePassword(Request $request)
    {

    	$formData=$request->all();

        $rule=array(
            'new_password'=>'required',
            );

        $message=array(
            'new_password.required'=>'New password is required.',
            );

        $validator=Validator::make($formData, $rule, $message);

        if($validator->fails()){
            return Redirect::to('/passwords/getNew/'.base64_encode($request->user_id))->withErrors($validator);

        }else{

            $newPassword=Hash::make($request->new_password);
        	User::where('id',$request->user_id)->update(['password'=>$newPassword]);

        		return Redirect::to('/login')->with('notification','All done. Your password has been reset login below');
        	
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

public function doPostRequest($url, $data, $headers = array('Content-Type: application/x-www-form-urlencoded')) {
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
