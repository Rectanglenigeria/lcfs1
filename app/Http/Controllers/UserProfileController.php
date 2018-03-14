<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function __construct()
    {
    	//$this->middleware('auth');
    }
    
    public function read()
    {
    	$user=User::where('id', Auth::user()->id)->first();
    	return view('pages.auth_pages.profile',['userProfile'=>$user]);
        //return view('pages.about',['ActiveTab'=>'about']);

    }

    public function update(Request $request)
    {
    	$formData=$request->all();

        $rule=array(
            'name'=>'required',
            'account_name'=>'required|unique:users',
            'account_no'=>'required|numeric|unique:users',
            'bank'=>'required'
            );

        $message=array(
            'name.required'=>'name is required.',
            'account_name.required'=>'account name code is required.',
            'account_name.unique'=>'The account name already exit. Use another account name',
            'account_no.required'=>'account number code is required.',
           'account_no.unique'=>'The account number already exit. Use another account number',
            'account_no.number'=>'Account number must have numeric value',
            'account_no.min'=>'Account number must be atleast 10 digits ',
            );

        $validator=Validator::make($formData, $rule, $message);

        if($validator->fails()){
            return Redirect::to('/user_profile')->withErrors($validator);

        }else{
            //compare code

        	$user=User::Where('id',Auth::user()->id)->first();
        	$user->name=$request->name;
        	$user->account_name=$request->account_name;
        	$user->account_no=$request->account_no;
        	$user->bank=$request->bank;
        	$user->save();
          	return Redirect::to('/dashboard')->with('notification','All done. Profile successfully updated. Sow laughter now.');

           
        }
    }



    public function updateForAdmin(Request $request)
    {
        $formData=$request->all();

        $rule=array(
            'name'=>'required',
            'account_name'=>'required',
            'account_no'=>'required|numeric',
            'bank'=>'required'
            );

        $message=array(
            'name.required'=>'name is required.',
            'account_name.required'=>'account name code is required.',
            'account_no.required'=>'account number code is required.',
            'account_no.number'=>'Account number must have numeric value',
            'account_no.min'=>'Account number must be atleast 10 digits ',
            );

        $validator=Validator::make($formData, $rule, $message);

        if($validator->fails()){
            return Redirect::to('/admin/user/view/'.$request->id)->withErrors($validator);

        }else{
            //compare code

            $user=User::Where('id',$request->id)->first();
            $user->name=$request->name;
            $user->account_name=$request->account_name;
            $user->account_no=$request->account_no;
            $user->bank=$request->bank;
            $user->save();
            return Redirect::to('/admin/user/view/'.$request->id)->with('notification','All done. Profile successfully updated.');

           
        }
    }
}
