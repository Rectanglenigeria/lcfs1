<?php

namespace App\Http\Controllers;

use App\User;
use App\Gsmile;
use App\Rsmile;
use App\Matchuser;
use App\Newsfeed;
use App\Referer;
use App\Bonus;
use App\Cconfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class BonusController extends Controller
{
    public function listBonus()
    {

        $totalRefBonus=Bonus::where([['user_id', Auth::user()->id],['type',1]])->sum('amount');

    	$refererBonuses= Bonus::where([['user_id', Auth::user()->id],['type',1]])->orderBy('id', 'desc')->paginate(20);

    	$videoBonuses= Bonus::where([['user_id', Auth::user()->id],['type',2]])->orderBy('id', 'desc')->paginate(20);

    	return view('pages.auth_pages.bonus.list',['refererBonuses'=>$refererBonuses, 'videoBonuses'=>$videoBonuses, 'totalRefBonus'=>$totalRefBonus]);
    }


    public function receiveRefererBonus($id)
    {
      
    	$totalGsmileAmount=0;
    	//ensure that user acheived gsmile > bonus amount
    	$bonus=Bonus::where('id', $id)->first();

         $referreeGsmile=Gsmile::where('id',$bonus->referee_gsmile_id)->first();

         $referreeGsmileID=$referreeGsmile->id;

         $checkConfirmationOfInsurance=Cconfirmation::where([['gsmile_id', $referreeGsmileID], ['payment_type', 0],['payment_status', 3]])->get();


         if($referreeGsmile->amount < $bonus->amount){

            return Redirect::to('/bonus/list')->with('notification','Bonus Error');

         }

         if(collect($checkConfirmationOfInsurance)->isEmpty()){
           //insurance has not been confirm

            return Redirect::to('/bonus/list')->with('notification','Insurance of your referree GS is not yet confirmed');
         }


    $acheivedConfirmation =Cconfirmation::where('gsmile_id', $referreeGsmileID)->get();


                    $sumAllMatchesAmount=0;
                      $paymentStatusArray=[];
                      $count=0;
                      foreach($acheivedConfirmation->confirmation as $confirmation){
                        $sumAllMatchesAmount+=$confirmation->amount; 
                        $paymentStatusArray[$count]=$confirmation->payment_status;
                        $count++;
                      }

                      if(in_array(0, $paymentStatusArray) || in_array(1, $paymentStatusArray) || in_array(2, $paymentStatusArray)){
                        $paidAll=false;
                      }else{
                        //all are 3s
                        $paidAll=true;
                      }

            if($sumAllMatchesAmount < $acheivedConfirmation->amount && $paidAll ==false){
                        return Redirect::to('/bonus/list')->with('notification','Your referree 80% GS is not yet confirmed');
                      }



    	$userAchivedGsmiles=$bonus->user->gsmile;

    	

    		//create and his GS and tunr it to mature
    		$gsmile = new Gsmile;
    		$gsmile->user_id=$bonus->referee_id;
    		$gsmile->amount=$bonus->amount;
    		$gsmile->left_amount=$bonus->amount;
    		$gsmile->hidden=1;
    		$gsmile->track_token=mt_rand(1000, 100000);
    		$gsmile->save();

    		$rsmile=new Rsmile;
    		$rsmile->user_id=$bonus->referee_id;
    		$rsmile->gsmile_id=0; // for bonus
    		$rsmile->amount->bonus->amount;
    		$rsmile->left_amount->$bonus->amount;
    		$rsmile->save();

    		Bonus::where('id', $bonus->id)->update(['has_cashed_out'=>1]);
    		return Redirect::to('/bonus/list')->with('notification','You successdfully cashed out.');

    

    }


     public function receiveVideoBonus($id)
    {
    	$totalGsmileAmount=0;

    	$bonus=Bonus::where('id', $id)->first();

         $beneficiaryLastGsmile=Gsmile::where('id',$bonus->user->id)->orderBy('desc')->first();

         $beneficiaryLastGsmileID=$beneficiaryLastGsmile->id;

         $checkConfirmationOfInsurance=Cconfirmation::where([['gsmile_id', $beneficiaryLastGsmileID], ['payment_type', 0],['payment_status', 3]])->get();


         if($beneficiaryLastGsmile->amount < $bonus->amount){

            return Redirect::to('/bonus/list')->with('notification','You need to GS not less that 100% of your bonus');

         }

         if(collect($checkConfirmationOfInsurance)->isEmpty()){
           //insurance has not been confirm

            return Redirect::to('/bonus/list')->with('notification','Insurance of your GS is not yet confirmed');
         }


    

    		//create and his GS and tunr it to mature
    		$gsmile = new Gsmile;
    		$gsmile->user_id=$bonus->referee_id;
    		$gsmile->amount=$bonus->amount;
    		$gsmile->left_amount=$bonus->left_amount;
    		$gsmile->hidden=1;
    		$gsmile->track_token=mt_rand(1000, 100000);
    		$gsmile->save();
    		
    		$rsmile=new Rsmile;
    		$rsmile->user_id=$bonus->user_id;
    		$rsmile->gsmile_id=0; // for bonus
    		$rsmile->amount->bonus->amount;
    		$rsmile->left_amount->$bonus->amount;
    		$rsmile->save();
    		Bonus::where('id', $bonus->id)->update(['has_cashed_out'=>1]);
    		return Redirect::to('/bonus/list')->with('notification','You successdfully cashed out.');

    	
   
}

}
