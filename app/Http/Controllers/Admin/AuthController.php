<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use RegistersUsers;

    protected $guard = 'admin';

    protected $loginView ='admin.auth.login';

    protected $registerView='admin.auth.register';

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin',['except'=>['showLoginForm','login']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    


    public function CreateAdminUser(Request $request){

        if(Auth::guard('admin')->user()->role==2){


    	$FormData=$request->all();

    	$rule=array(
    		'username'=>'required|unique:admins',
            'password'=>'required',
            'repassword'=>'required|same:password',
            'role'=>'required',
           // 'g-recaptcha-response' => 'required|captcha'
    		);

    	$message=array(
    		'username.required'=>'Username is required',
            'username.unique'=>'The username has already been taken, try another one.',
            'password.required'=>'Password is required',
            'role.required'=>'Admin level is required'
    		);

    	$validator=Validator::make($FormData, $rule, $message);

    	if($validator->fails()){
    		return Redirect::to('admin/register')->withErrors($validator)->withInput();

    	}else{
    		$admin=new Admin;
    		$admin->username=$request->username;
    		$admin->password= Hash::make($request->password);
            $admin->role=$request->role;
    		$admin->remember_token=$request->_token;
    		$admin->save();
    		
    		return Redirect::to('admin/login')->with('notification','Admin user created, sign in below')->withInput();
    	}


        }else{
            return Redirect::to('admin/home');
        }



    }








    protected function showLoginForm(){
    	return view('admin.auth.login');
    }




   protected function login(Request $request){
    	$FormData=Input::except(array('_token'));

    	$rule=array(
    		'username'=>'required',
    		'password'=>'required',
            //'g-recaptcha-response' => 'required|captcha'
    		);

    	$message=array(
    		'username.required'=>'Username is required',
    		'password.required'=>'Password is required'
    		);

    	$validator=Validator::make($FormData, $rule, $message);

    	if($validator->fails()){
    		return Redirect::to('admin/login')->withErrors($validator)->withInput();

    	}else{
    		$FormData=array(
    			"username"=>Input::get('username'),
    			"password"=>Input::get('password')
    			);

             

    		if(Auth::guard('admin')->attempt($FormData)){
    			return Redirect::to('admin/home')
    			->with('notification','You are logged in succesfully');
    		}else{
    			return Redirect::to('admin/login')->with('notification','Password incorrect');
    			//var_dump('not match');
    		}
        

        


    	}

    }

















 	protected function showRegistrationForm(){
        if(Auth::guard('admin')->user()->role==2){
            return view('admin.auth.register');
        }else
        {
            return Redirect::to('admin/home');
        }
 		

    }

    protected function register(){

    }

    protected function logout(){
        Auth::guard('admin')->logout();
        return Redirect::to('admin/login')->with('notification','You have succesfully logged out.');

    }



}
