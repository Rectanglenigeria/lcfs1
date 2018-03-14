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

class RsmileController extends Controller
{
    public function showMaturedGs()
    {
        $achievedSmiles=Gsmile::where('user_id', Auth::user()->id)->orderBy('id','desc')->paginate(30);

        return view('pages.auth_pages.rsmiles.create',['achievedSmiles'=>$achievedSmiles]);
    }

    public function create (Request $request)
    {

        //confirm 10% of new GS

        //extract 20% retainment
        


        //Cond 1: user cannot RS untill he clears his depth
        $achievedSmiles=Gsmile::where('user_id', Auth::user()->id)->get();
        $leftAmountArray=[];
        foreach ($achievedSmiles as $key => $smile) {
            if($smile->left_amount == 0){$status=true;}else{$status=false;}
            $leftAmountStatusArray[$key]=$status;
        }
        
        if(in_array(false, $leftAmountStatusArray)){
            return Redirect::to('/rsmile/create')->with('notification','You must fufill all previous GS requests before making an RS request')->withInput();
        }else{







        //get gmsile amount plus ROI
        $achievedSmiles=Gsmile::where('id', $request['smileId'])->first();
        $investedAmount=$achievedSmiles->amount;
        $ROI=$achievedSmiles->growth;

        //cond 2 : subtract 20% recommitment and GS it

















            if(Auth::user()->is_pioneer == '1'){


                //if pioneer already has RS on rsmile table
                $alreadyRS=Rsmile::where('gsmile_id', $request['$smileId'])->first();
                 if(!empty($alreadyRS)){
                     //update reap status in GS table for participant
        Gsmile::where('id', $request['smileId'])->update(['reap_status'=>1]);
        //update reap status in GS table for participant
         return Redirect::to('/rsmile/create')->with('notification','Your RS request has been received. 20% recommitment GS on your RS has been made. Your RS request(80%) will be matched within soon.');

                 }else{
                    //create new rs for him
                        $recommitmentAmount=floor((20/100)*($investedAmount*2));

                        $leftAmountAfterRecommitment=floor(($investedAmount) - $recommitmentAmount);  //80%

                         //GS 20% recommitment 
            $createSmile=new Gsmile;
            $createSmile->user_id=Auth::user()->id;
            $createSmile->left_amount=$recommitmentAmount; //initializing left_amount
            $createSmile->amount=$recommitmentAmount;
            $createSmile->remember_token=$request->_token;
            $track_token=mt_rand(10000, 1000000);
            $createSmile->track_token=$track_token;
            $createSmile->save();
            //GS 20% recommitment


        //RS 80% left
        $rsmile=new rsmile;
        $rsmile->user_id=Auth::user()->id;
        $rsmile->gsmile_id=$request->smileId;
        $rsmile->amount=$leftAmountAfterRecommitment;
        $rsmile->left_amount=$leftAmountAfterRecommitment;
        $rsmile->remember_token= $request->_token;
        $rsmile->save();

        //update reap status in GS table for participant
        Gsmile::where('id', $request['smileId'])->update(['reap_status'=>1]);
        //update reap status in GS table for participant
        
        return Redirect::to('/rsmile/create')->with('notification','Your RS request has been received. 20% recommitment GS on your RS has been made. Your RS request(80%) will be matched within soon.');
                 }

                













            }else{

                    //for ordinary user
                $alreadyRS=Rsmile::where('gsmile_id', $request['$smileId'])->first();

                if(empty($already)){

                    $recommitmentAmount=floor((20/100)*($investedAmount*2));

                     $leftAmountAfterRecommitment=floor(($investedAmount) - $recommitmentAmount);  //80%
                }else{
                    //user has already RS : notification
                     return Redirect::to('/rsmile/create')->with('notification','Already requested smile.')->withInput();
                }
                



 //GS 20% recommitment 
            $createSmile=new Gsmile;
            $createSmile->user_id=Auth::user()->id;
            $createSmile->left_amount=$recommitmentAmount; //initializing left_amount
            $createSmile->amount=$recommitmentAmount;
            $createSmile->remember_token=$request->_token;
            $track_token=mt_rand(10000, 1000000);
            $createSmile->track_token=$track_token;
            $createSmile->save();
            //GS 20% recommitment


        //RS 80% left
        $rsmile=new rsmile;
        $rsmile->user_id=Auth::user()->id;
        $rsmile->gsmile_id=$request->smileId;
        $rsmile->amount=$leftAmountAfterRecommitment;
        $rsmile->left_amount=$leftAmountAfterRecommitment;
        $rsmile->remember_token= $request->_token;
        $rsmile->save();

        //update reap status in GS table for participant
        Gsmile::where('id', $request['smileId'])->update(['reap_status'=>1]);
        //update reap status in GS table for participant
        
        return Redirect::to('/rsmile/create')->with('notification','Your RS request has been received. 20% recommitment GS on your RS has been made. Your RS request(80%) will be matched within soon.');


                
            }
        















          

        }

    }




}
