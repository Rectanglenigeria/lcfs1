<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
//Models
use App\User;
use App\Admin;
use App\Backgroundaction;


class DashboardController extends Controller
{

	public function __construct(){
        $this->middleware('admin');
    }


    public function readLatestUsers(){

        $insurance=Backgroundaction::where('action_name','insurance_value')->first()->interval;

        $automatchStatus=Backgroundaction::where('action_name','pause_automatch')->first();
        $currentAdmin= Admin::where('id', Auth::guard('admin')->user()->id)->first();
        $CurrentAdminlastLoginTimestamp= $currentAdmin->updated_at;
        $users = User::where('created_at','>=', $CurrentAdminlastLoginTimestamp)->orderBy('id', 'desc')->paginate(1000);
        $countAllUsers=User::where('created_at','>=', $CurrentAdminlastLoginTimestamp)->count();  

        return view('admin.dashboard',['users'=>$users, 'userNo'=>$countAllUsers,'automatchStatus'=>$automatchStatus,'insurance'=>$insurance]);

    }


    public function updateInsurance(Request $request)
    {

        $formData=$request->all();

        $rule=array(
            'insurance'=>'required',
            
            );

        $message=array(
            'insurance.required'=>'Insurance value is required.'
            
            );

        $validator=Validator::make($formData, $rule, $message);

        if($validator->fails()){
            return Redirect::to('/admin/dashboard/')->withErrors($validator);

        }else{
             $value=intval($request->insurance);
        Backgroundaction::where('action_name','insurance_value')->update(['interval'=>$value]);
        return Redirect::to('/admin/dashboard')->with('insurance updated to '. $value."%");


        }

       
    }
}
