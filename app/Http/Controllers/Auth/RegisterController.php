<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => 'required|string|numeric|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'is_active'=>'0',
            //'referer_link'=>$data['referer_link']
        ]);
    }

    public function showActivationForm($id)
    {
        return view('auth.activation_form',['user_id'=>$id]);
    }

    public function activateUser(Request $request)
    {
        $formData=$request->all();

        $rule=array(
            'code'=>'required',
            'user_id'=>'required'
            );

        $message=array(
            'code.required'=>'verification code is required.',
            'user_id.required'=>'user ID is required'
            );

        $validator=Validator::make($formData, $rule, $message);

        if($validator->fails()){
            return Redirect::to('/activate_user/'.$request->user_id)->withErrors($validator);

        }else{
            //compare code
            $user=User::Where('id',$request->user_id)->first();
            if($user->activation_code==$request->code){
                $user->is_active='1';
                $user->save();
                return Redirect::to('/login')->with('notification','Your account has been verified. Login below.');
            }else{
                return Redirect::to('/activate_user/'.$request->user_id)->with('notification','Incorrect verification code. Click "resend code" button');
            }

           
        }
    }



    public function reVerify($id){

        $user=User::Where('id',$id)->first();
        $code=mt_rand(1000, 100000);

        User::where('id', $user->id)->update(['activation_code'=>$code]);
        //SMS API
        //sendSMS section
                $json_url = "http://api.ebulksms.com:8080/sendsms.json";
                $xml_url = "http://api.ebulksms.com:8080/sendsms.xml";
                $username = null;
                $apikey = null;
                    
                    $username = "laughtercommunity@gmail.com";
                    $apikey = "93b7beb42956897243858e7587df11527c212deb";
                    $sendername = substr("LC!", 0, 11);
                    $recipients = $user->phone;
                    $message = $code." is your LC verification code";
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

                   
                   return Redirect::to('activate_user/'.$user->id);
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
