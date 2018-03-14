<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
//Models
use App\User;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }


    public function read(){
    	$users = User::orderBy('id', 'desc')->paginate(1000);
    	$countAllUsers=User::all()->count();
        return view('admin.users',['users'=>$users, 'userNo'=>$countAllUsers]);

    }

    public function view($id){
        $user = User::where('id', $id)->first();
        return view('admin.user_view',['user'=>$user]);

    }

    public function makePioneer($id){
        User::where('id', $id)
          ->update(['is_pioneer' => '1']);
        return Redirect::to('admin/user/list')->with('notification','user succefully made pioneer');
    }

    public function unmakePioneer($id){
        User::where('id', $id)
          ->update(['is_pioneer' => '0']);
        return Redirect::to('admin/user/list')->with('notification','user succefully made ordinary user');
    }


     public function makeTeamLead($id){
        User::where('id', $id)
          ->update(['is_teamlead' => '1']);
        return Redirect::to('admin/user/list')->with('notification','user succefully made team lead');
    }

    public function unmakeTeamLead($id){
        User::where('id', $id)
          ->update(['is_teamlead' => '0']);
        return Redirect::to('admin/user/list')->with('notification','user succefully made ordinary user');
    }

     public function makeEarlyReaper($id){
        User::where('id', $id)
          ->update(['is_early_reaper' => '1']);
        return Redirect::to('admin/user/list')->with('notification','user succefully made early reaper');
    }

    public function unmakeEarlyReaper($id){
        User::where('id', $id)
          ->update(['is_early_reaper' => '0']);
        return Redirect::to('admin/user/list')->with('notification','user succefully made ordinary user');
    }



    public function delete($id){
    	$deletedRows = User::where('id', $id)->delete();
    	return Redirect::to('admin/user/list')->with('notification','user succefully deleted');
    }

    public function blockUser($id){
    	User::where('id', $id)
          ->update(['is_block' => 1]);
        return Redirect::to('admin/user/list')->with('notification','user succefully blocked');
    }

    public function unBlockUser($id){
    	User::where('id', $id)
          ->update(['is_block' => 0]);
        return Redirect::to('admin/user/list')->with('notification','user succefully unblocked');
    }
}
