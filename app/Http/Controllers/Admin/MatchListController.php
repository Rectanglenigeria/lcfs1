<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Matchuser;
use App\Helprequest;
use App\Ghelprequest;
use App\User;

class MatchListController extends Controller
{
   	public function __construct(){
        $this->middleware('admin');
    }

    public function read(){
    	$matchusers=Matchuser::orderBy('id', 'desc')->paginate(1000);
    	$countEntries=Matchuser::all()->count();
    	$sumPaidOut=Helprequest::where('status','3')->sum('amount');
    	return view('admin.list.index',
    		['matchusers'=>$matchusers,
    		'totalMatchesMade'=>$countEntries,
    		'totalAmountPaidOut'=>$sumPaidOut]);
    }


    public function match($ghuser_id, $gh_id,$gh_amount){
    	$amount=implode('k', [intval(explode('k', $gh_amount)[0])/2, null]);
    	$helprequests=Helprequest::where([['status','0'],['amount',$amount]])
    								->orderBy('created_at', 'desc')
               						->get();
    	return view('admin.list.matchuser',
    		['helprequests'=>$helprequests,
    		'ghuserId'=>$ghuser_id,
    		'ghId'=>$gh_id,
    		'ghAmount'=>$gh_amount]);
    }


    public function create(Request $request){
    	$FormData=$request->all();

    	$rule=array(
    		'ph_param'=>'required'
    		);

    	$message=array(
    		'ph_param.required'=>'No PH request selected'
    		);

    	$validator=Validator::make($FormData, $rule, $message);

    	if($validator->fails()){
    		return Redirect::to('admin/matchlist/match/{$request->ghuserId}/{$request->ghId}/{$request->ghAmount
    		}')->withErrors($validator)->withInput();

    	}else{
    		$phParam=explode('/', $request->ph_param);
    		//update Ghelprequest model (for multi updates)
    		$checkForHalfMatching=Matchuser::where('ghelprequest_id',$request->gh_id);
    		if(empty($checkForHalfMatching)){
    			$has_matched=1;
    		}else{
    			$has_matched=2;
    		}
    		$ghelprequest=Ghelprequest::where('id',$request->gh_id)->first();
    		$ghelprequest->status='2';
    		$ghelprequest->has_matched=$has_matched;
    		$ghelprequest->save();


    		$matchuser=new Matchuser;
    		$matchuser->phuser_id=$phParam[0];
    		$matchuser->ghuser_id=$request->ghuser_id;
    		$matchuser->helprequest_id=$phParam[1];
    		$matchuser->ghelprequest_id=$request->gh_id;
			$matchuser->status='2';
    		//$matchuser->amount='40k';
    		$matchuser->approval='0';
    		$matchuser->remember_token=$request->_token;
    		$matchuser->save();


    		//update Helprequest model 
    		$helprequest=Helprequest::where('id',$phParam[1])->first();
    		$helprequest->status='2';
    		$helprequest->save();
    		
    		return Redirect::to('admin/matchlist')->with('notification','Match request succefully created');
    	}

    }


    public function unmatch($phuserId, $ghelprequestId){

       
        $checkHasMatchedStatus=Ghelprequest::where('id',$ghelprequestId)->first()->has_matched;
        if($checkHasMatchedStatus==1){
            $updateTargetGhelprequestRow=Ghelprequest::where('id',$ghelprequestId)->first();
            $updateTargetGhelprequestRow->status='0';
            $updateTargetGhelprequestRow->has_matched=0;
            $updateTargetGhelprequestRow->save();
        }elseif($checkHasMatchedStatus==2){
            $updateTargetGhelprequestRow=Ghelprequest::where('id',$ghelprequestId)->first();
            $updateTargetGhelprequestRow->status='3';
            $updateTargetGhelprequestRow->has_matched=1;
            $updateTargetGhelprequestRow->save();
        }else{
            var_dump('Attempt to decline failed.');
        }

        $deleteTargetMatchuserRow=Matchuser::where('phuser_id',$phuserId)->delete();

        $deleteTargetHelprequestRow=Helprequest::where('user_id',$phuserId)->delete();

        return Redirect::to('admin/matchlist')->with('notification','Request to unmatch succefully completed');


    }

    public function unmatchandblock($phuserId, $ghelprequestId){
       
        $checkHasMatchedStatus=Ghelprequest::where('id',$ghelprequestId)->first()->has_matched;
        if($checkHasMatchedStatus==1){
            $updateTargetGhelprequestRow=Ghelprequest::where('id',$ghelprequestId)->first();
            $updateTargetGhelprequestRow->status='0';
            $updateTargetGhelprequestRow->has_matched=0;
            $updateTargetGhelprequestRow->save();
        }elseif($checkHasMatchedStatus==2){
            $updateTargetGhelprequestRow=Ghelprequest::where('id',$ghelprequestId)->first();
            $updateTargetGhelprequestRow->status='3';
            $updateTargetGhelprequestRow->has_matched=1;
            $updateTargetGhelprequestRow->save();
        }else{
            var_dump('Attempt to decline failed.');
        }

        $deleteTargetMatchuserRow=Matchuser::where('phuser_id',$phuserId)->delete();

        $deleteTargetHelprequestRow=Helprequest::where('user_id',$phuserId)->delete();

        $blockUser=User::where('id',$phuserId)->first();
        $blockUser->status='1';
        $blockUser->save();

        return Redirect::to('admin/matchlist')->with('notification','Request to unmatch and block user succefully completed');


    }



    public function unmatchandconfirmphuser($ghuserId, $ghelprequestId, $helprequestId){
       
        $checkHasMatchedStatus=Ghelprequest::where('id',$ghelprequestId)->first()->has_matched;
        if($checkHasMatchedStatus==1){
            $updateTargetGhelprequestRow=Ghelprequest::where('id',$ghelprequestId)->first();
            $updateTargetGhelprequestRow->status='0';
            $updateTargetGhelprequestRow->has_matched=0;
            $updateTargetGhelprequestRow->save();
        }elseif($checkHasMatchedStatus==2){
            $updateTargetGhelprequestRow=Ghelprequest::where('id',$ghelprequestId)->first();
            $updateTargetGhelprequestRow->status='3';
            $updateTargetGhelprequestRow->has_matched=1;
            $updateTargetGhelprequestRow->save();
        }else{
            var_dump('Attempt to decline failed.');
        }

        $deleteTargetMatchuserRow=Matchuser::where('helprequest_id',$helprequestId)->delete();

        $updateTargetHelprequestRow=Helprequest::where('id',$helprequestId)->first();
        $updateTargetHelprequestRow->status='3';
        $updateTargetHelprequestRow->save();


        $blockUser=User::where('id',$ghuserId)->first();
        $blockUser->status='1';
        $blockUser->save();

        return Redirect::to('admin/matchlist')->with('notification','Request to unmatch, confirm and block users succefully completed');


    }



    public function blocktimedeclindedusers(){
    	$count=0;
    	$getAllMatches=Matchuser::all();
    	foreach ($getAllMatches as $match) {
			$timeUsed=intval(time())-intval(strtotime($match->created_at));
          	$allocatedTime=24*60*60 ; //converting 24hrs to seconds
          	$timeLeft= $allocatedTime-$timeUsed;

          	if($timeLeft<0 && $match->approval=='0'){


          		//unmatchandblock
          		$checkHasMatchedStatus=Ghelprequest::where('id',$match->ghelprequest_id)->first()->has_matched;
        if($checkHasMatchedStatus==1){
            $updateTargetGhelprequestRow=Ghelprequest::where('id',$match->ghelprequest_id)->first();
            $updateTargetGhelprequestRow->status='0';
            $updateTargetGhelprequestRow->has_matched=0;
            $updateTargetGhelprequestRow->save();
        }elseif($checkHasMatchedStatus==2){
            $updateTargetGhelprequestRow=Ghelprequest::where('id',$match->ghelprequest_id)->first();
            $updateTargetGhelprequestRow->status='3';
            $updateTargetGhelprequestRow->has_matched=1;
            $updateTargetGhelprequestRow->save();
        }else{
            var_dump('Attempt to decline failed.');
        }

        $deleteTargetMatchuserRow=Matchuser::where([['phuser_id',$match->phuser_id],['approval','0']])->delete();

        $deleteTargetHelprequestRow=Helprequest::where('user_id',$match->phuser_id)->delete();

        $blockUser=User::where('id',$match->phuser_id)->first();
        $blockUser->status='1';
        $blockUser->save();

        $count++;
          	}
          	else{
          		continue;
          	}
          	
    		
    	}

    	return Redirect::to('admin/matchlist')->with('notification', $count.' requests made.'.$count.' users blocked.');


    }


}

