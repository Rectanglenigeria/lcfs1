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


        $gsmile_id=$request->smileId;

        $userGsHistory=Gsmile::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        $userLastGsID=Gsmile::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first()->id;

        if($userLastGsID == $gsmile_id){

            return Redirect::to('/rsmile/create')->with('notification','Ops! You are to make a new SL and get its down payment confirmed before RL.');
        }

        if($userLastGsID != $gsmile_id){

            $newSmileID=$userLastGsID;

            $confirmation=Cconfirmation::where('gsmile_id', $newSmileID)->get();

            if(collect($confirmation)->isEmpty()){

                return Redirect::to('/rsmile/create')->with('notification','Ops! Down payment not seen');

            }else{

                $confirmation=Cconfirmation::where([['gsmile_id', $newSmileID], ['payment_type', 0]])->first();

                if(collect($confirmation)->isEmpty()){

                    return Redirect::to('/rsmile/create')->with('notification','Ops! Down payment not seen.');

                }else{

                    $confirmation=Cconfirmation::where([['gsmile_id', $newSmileID], ['payment_type', 0], ['payment_status',3]])->first();

                    if(collect($confirmation)->isEmpty()){

                        return Redirect::to('/rsmile/create')->with('notification','Ops! Down payment not yet confirmed by other participant');

                    }

                }


            }

        }


        //check if there is GS after RS's GS
        //if yes, check confirmation table where gsmile_id =new GS id type =0 10% and payment_status=3
        //if yes, allow to RS   -else

        //confirm 10% of new GS

        //extract 20% retainment










        //get gmsile amount plus ROI
        $achievedSmiles=Gsmile::where('id', $request['smileId'])->first();

        $investedAmount=$achievedSmiles->amount;

        $ROI=$achievedSmiles->growth;

        //cond 2 : subtract 20% recommitment and GS it

















            if(Auth::user()->is_pioneer == '1'){


                //if pioneer already has RS on rsmile table
                $alreadyRS=Rsmile::where('gsmile_id', $request->smileId)->first();
                 if(!empty($alreadyRS)){
                     //update reap status in GS table for participant
        Gsmile::where('id', $request['smileId'])->update(['reap_status'=>1]);
        //update reap status in GS table for participant
         return Redirect::to('/rsmile/create')->with('notification','Your RL request has been received. 30% recommitment SL on your RL has been made. Your RL request(70%) will be matched within soon.');

                 }else{
                    //create new rs for him

                        $roi=(80/100)*$investedAmount;

                        $retainmentAmount=floor((10/100)*($investedAmount+($roi)));

                        $leftAmountAfterRetainment=floor(($investedAmount + $roi) - $retainmentAmount);  //70%



        //RS 80% left
        $rsmile=new rsmile;
        $rsmile->user_id=Auth::user()->id;
        $rsmile->gsmile_id=$request->smileId;
        $rsmile->amount=$leftAmountAfterRetainment;
        $rsmile->left_amount=$leftAmountAfterRetainment;
        $rsmile->track_token=$track_token=mt_rand(10000, 100000);
        $rsmile->remember_token=$request->_token;
        $rsmile->save();

        //Extract 20% retainment
        $r_token=mt_rand(10000, 100000);
            $retainSmile=new Retaiment;
            $retainSmile->user_id=Auth::user()->id;
            $retainSmile->rsmile_id=Rsmile::where('track_token',$track_token)->first()->id;
            $retainSmile->amount=$retainmentAmount;
            $retainSmile->status=0;  //pending
            $retainSmile->r_token=$r_token;
            $retainSmile->save();
            //GS 20% recommitment


        //update reap status in GS table for participant
        Gsmile::where('id', $request['smileId'])->update(['reap_status'=>1]);
        //update reap status in GS table for participant

        return Redirect::to('/rsmile/create')->with('notification','Your RL request has been received. 10% of your RL amount is being retained in your wallet. Your RL request(90%) will be matched within soon.');
                 }







        }elseif(Auth::user()->is_early_reaper == '1'){


            $achievedSmilesCount=Gsmile::where('user_id', Auth::user()->id)->count();

            if($achievedSmilesCount>1){
                $roi=(50/100)*$investedAmount;

            }else{

                $roi=(60/100)*$investedAmount;

            }




                    //for ordinary user
                $alreadyRS=Rsmile::where('gsmile_id', $request->smileId)->first();

                if(empty($already)){

                     $retainmentAmount=floor((10/100)*($investedAmount+($roi)));

                        $leftAmountAfterRetainment=floor(($investedAmount + $roi) - $retainmentAmount);  //70%

                    
                }else{
                    //user has already RS : notification
                     return Redirect::to('/rsmile/create')->with('notification','Already requested smile.')->withInput();
                }




        //RS 80% left
        $rsmile=new rsmile;
        $rsmile->user_id=Auth::user()->id;
        $rsmile->gsmile_id=$request->smileId;
        $rsmile->amount=$leftAmountAfterRetainment;
        $rsmile->left_amount=$leftAmountAfterRetainment;
        $rsmile->track_token=$track_token=mt_rand(10000, 100000);
        $rsmile->remember_token= $request->_token;
        $rsmile->save();

          //Extract 20% retainment
         $r_token=mt_rand(10000, 100000);
            $retainSmile=new Retaiment;
            $retainSmile->user_id=Auth::user()->id;
            $retainSmile->rsmile_id=Rsmile::where('track_token',$track_token)->first()->id;
            $retainSmile->amount=$retainmentAmount;
            $retainSmile->status=0;  //pending  1=insurance of new Gs  confirmed
            $retainSmile->r_token=$r_token;
            $retainSmile->save();
            //GS 20% recommitment

        //update reap status in GS table for participant
        Gsmile::where('id', $request['smileId'])->update(['reap_status'=>1]);
        //update reap status in GS table for participant

        return Redirect::to('/rsmile/create')->with('notification','Your RL request has been received. 10% of your RL amount is being retained in your wallet. Your RL request(90%) will be matched within soon.');










            }else{

                    //for ordinary user
                $alreadyRS=Rsmile::where('gsmile_id', $request->smileId)->first();

                if(empty($already)){

                    $roi=(50/100)*$investedAmount;

                     $retainmentAmount=floor((10/100)*($investedAmount+($roi)));

                        $leftAmountAfterRetainment=floor(($investedAmount + $roi) - $retainmentAmount);  //70%

                    
                }else{
                    //user has already RS : notification
                     return Redirect::to('/rsmile/create')->with('notification','Already requested smile.')->withInput();
                }




        //RS 80% left
        $rsmile=new rsmile;
        $rsmile->user_id=Auth::user()->id;
        $rsmile->gsmile_id=$request->smileId;
        $rsmile->amount=$leftAmountAfterRetainment;
        $rsmile->left_amount=$leftAmountAfterRetainment;
        $rsmile->track_token=$track_token=mt_rand(10000, 100000);
        $rsmile->remember_token= $request->_token;
        $rsmile->save();

          //Extract 20% retainment
         $r_token=mt_rand(10000, 100000);
            $retainSmile=new Retaiment;
            $retainSmile->user_id=Auth::user()->id;
            $retainSmile->rsmile_id=Rsmile::where('track_token',$track_token)->first()->id;
            $retainSmile->amount=$retainmentAmount;
            $retainSmile->status=0;  //pending  1=insurance of new Gs  confirmed
            $retainSmile->r_token=$r_token;
            $retainSmile->save();
            //GS 20% recommitment

        //update reap status in GS table for participant
        Gsmile::where('id', $request['smileId'])->update(['reap_status'=>1]);
        //update reap status in GS table for participant

        return Redirect::to('/rsmile/create')->with('notification','Your RL request has been received. 10% of your RL amount is being retained in your wallet. Your RL request(90%) will be matched within soon.');



            }


















        }






}
