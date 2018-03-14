<?php

namespace App\Http\Controllers;

use App\User;
use App\Gsmile;
use App\Rsmile;
use App\Matchuser;
use App\Cconfirmation;
use App\Retaiment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class RetaimentController extends Controller
{



    public function create (Request $request)
    {



        //generate virtual GS;

         $createSmile=new Gsmile;

         $createSmile->user_id=Auth::user()->id;

         $createSmile->left_amount=$request->amount/2; //initializing left_amount

         $createSmile->track_token=$track_token1=mt_rand(10000, 1000000);

         $createSmile->amount=$request->amount/2;

         $createSmile->remember_token=$request->_token;

         $createSmile->hidden=1;

         $createSmile->save();


         $smileId=Gsmile::where('track_token', $track_token1)->first()->id;

        //RS 100% left
        $rsmile=new rsmile;

        $rsmile->user_id=Auth::user()->id;

        $rsmile->gsmile_id=$smileId;

        $rsmile->amount=$request->amount;

        $rsmile->left_amount=$request->amount;

        $rsmile->track_token=$track_token=mt_rand(10000, 100000);

        $rsmile->remember_token= $request->_token;

        $rsmile->save();


        Retaiment::where('r_token', $request->retaiment_id)->update(['status'=>2]);



        //update reap status in GS table for participant
        Gsmile::where('track_token', $track_token1)->update(['reap_status'=>1]);
        //update reap status in GS table for participant

        return Redirect::to('/wallet/view')->with('notification','Your RS request has been received');



        }




}
