<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Gsmile;
use App\Rsmile;
use App\Matchuser;
use App\Cconfirmation;
use App\Message;
use App\Insurance;
use App\Retaiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class CronjobController extends Controller
{
    public function execute(Request $request){

    	//authenticate request

    	$authToken="2DagaswjhwTYWBAsdb192026302jksd";

    	if($request->token==$authToken){


    		//make team lead
    		makeTeamLead();

    	//add growth
    		addGrowth();

    	//update investment ages

    		updateInvestmentAge();

    	//block timeout users
    		blockUsers();

    	//automatic marging


    		echo "*ok*";


    	}




    	  //if($this->makeTeamLead($request->phone)){

                //if($this->addGrowth()){
                    //if($this->blockUsers()){
                        //if($this->autoMatchUsers()){

    	
    }



     public function autoMatchUsers(){

        $background1=Backgroundaction::where('action_name','pause_automatch')->first();
        if($background1->interval==1){


     


            //return Redirect::to('kkk');

            //loop true GS that have not been match i.e where left_amount > 0 orderby id(asc)
                //loop RS 
                    // apply 3 conditions
                            //if GS left A == RS left A || match && break 1
                            // if GS Left A < RS left A || match , update and break 1;
                            // if GS left A > RS left A  || match , update and continue;

            $gsmiles = Gsmile::where('left_amount','>', 0)->orderBy('id', 'asc')->get();
            if(! collect($gsmiles)->isEmpty()){

                foreach ($gsmiles as $key => $gsmile) {

                    if($gsmile->hidden == 1){continue;}

                    $rsmiles=Rsmile::where('left_amount','>', 0)->orderBy('id', 'asc')->get();
                    if(! collect($rsmiles)->isEmpty()){
                        foreach ($rsmiles as $key => $rsmile) {
                            #user cannot be matched to oneself
                            if($gsmile->user->id == $rsmile->user->id){
                                continue;
                            }
                            //condition 1
                            if($gsmile->left_amount == $rsmile->left_amount){
                                $amountToPay=$gsmile->amount;
                                $track_token=mt_rand(1000, 100000);
                                //populate match table
                                    $match = new Matchuser;
                                    $match->gsmile_user_id=$gsmile->user->id;
                                    $match->rsmile_user_id=$rsmile->user->id;
                                    $match->gsmile_id=$gsmile->id;
                                    $match->rsmile_id=$rsmile->id;
                                    $match->amount = $amountToPay;
                                    $match->payment_status=1;
                                    $match->track_token=$track_token;
                                    $match->save();
                                //popuplate confirmation table
                                    $confirm = new Cconfirmation;
                                    $confirm->gsmile_id=$gsmile->id;
                                    $confirm->rsmile_id=$rsmile->id;
                                    $confirm->match_id=(Matchuser::where('track_token',$track_token)->first()->id);
                                    $confirm->amount = $amountToPay;
                                    $confirm->payment_status=1;
                                    $confirm->left_amount=0; //on GS side
                                    $confirm->save();
                                //update left amount for GS and RS : set left A=0
                                    Gsmile::where('id', $gsmile->id)->update(['left_amount'=>0]);
                                    Rsmile::where('id', $rsmile->id)->update(['left_amount'=>0]);
                                //break out of child loop : break 1
                                    break 1;
                            }

                            //condition 2
                            if($gsmile->left_amount < $rsmile->left_amount){
                                $amountToPay=$gsmile->amount;
                                $track_token=mt_rand(1000, 100000);
                                //populate match table
                                    $match = new Matchuser;
                                    $match->gsmile_user_id=$gsmile->user->id;
                                    $match->rsmile_user_id=$rsmile->user->id;
                                    $match->gsmile_id=$gsmile->id;
                                    $match->rsmile_id=$rsmile->id;
                                    $match->amount = $amountToPay;
                                    $match->payment_status=1;
                                    $match->track_token=$track_token;
                                    $match->save();
                                //popuplate confirmation table
                                    $confirm = new Cconfirmation;
                                    $confirm->gsmile_id=$gsmile->id;
                                    $confirm->rsmile_id=$rsmile->id;
                                    $confirm->match_id=(Matchuser::where('track_token',$track_token)->first()->id);
                                    $confirm->amount = $amountToPay;
                                    $confirm->payment_status=1;
                                    $confirm->left_amount=0;
                                    $confirm->save();
                                //update left amount for GS and RS : set left A=0
                                    Gsmile::where('id', $gsmile->id)->update(['left_amount'=>0]);
                                    Rsmile::where('id', $rsmile->id)->update(['left_amount'=>($rsmile->left_amount - $amountToPay)]);
                                //break out of child loop : break 1
                                    break 1;
                            }

                            //condition 1
                            if($gsmile->left_amount > $rsmile->left_amount){
                                $amountToPay=$rsmile->amount;
                                $track_token=mt_rand(1000, 100000);
                                //populate match table
                                    $match = new Matchuser;
                                    $match->gsmile_user_id=$gsmile->user->id;
                                    $match->rsmile_user_id=$rsmile->user->id;
                                    $match->gsmile_id=$gsmile->id;
                                    $match->rsmile_id=$rsmile->id;
                                    $match->amount = $amountToPay;
                                    $match->payment_status=1;
                                    $match->track_token=$track_token;
                                    $match->save();
                                //popuplate confirmation table
                                    $confirm = new Cconfirmation;
                                    $confirm->gsmile_id=$gsmile->id;
                                    $confirm->rsmile_id=$rsmile->id;
                                    $confirm->match_id=(Matchuser::where('track_token',$track_token)->first()->id);
                                    $confirm->amount = $amountToPay;
                                    $confirm->payment_status=1;
                                    $confirm->left_amount=$gsmile->left_amount - $amountToPay;
                                    $confirm->save();
                                //update left amount for GS and RS : set left A=0
                                    Gsmile::where('id', $gsmile->id)->update(['left_amount'=>0]);
                                    Rsmile::where('id', $rsmile->id)->update(['left_amount'=>($rsmile->left_amount - $amountToPay)]);
                                //break out of child loop : break 1
                                    continue;
                            }
                        }
                    }
                }
            }



           

       
        return true;
    }else{
         //Backgroundaction::where('action_name', 'auto_match')->update(['interval'=>1]);
         //return true;
    }

    }


    public function blockUsers(){

      	//runs daily

            $matches = Matchuser::where('payment_status',1)->orderBy('id', 'asc')->get();

            if(!empty($matches)){

                foreach ($matches as $key => $match) {
                    //check form time 24hrs + 24hrs
                    if($match->is_extended == 1){
                        $allocatedTime=(24+24)*60*60;
                    }else{
                        $allocatedTime=24*60*60;
                    }

                    //check for time
                    $matchingTime=strtotime($match->created_at);
                    $expiresAt=$matchingTime+$allocatedTime;
                    $outOfTime=$now-$expiresAt;
                    if($outOfTime >= 0){


                        //unmactch
                        //rollback
                           //for GS
                    $newGsLeftAmount= ($match->gsmile->left_amount + $match->amount);
                    Gsmile::where('id', $match->gsmile->id)->update(['left_amount'=>$newGsLeftAmount]);
                        //for RS
                    if(isset($match->rsmile->id)){
                        $newRsLeftAmount= ($match->rsmile->left_amount + $match->amount);
                        Rsmile::where('id', $match->rsmile->id)->update(['left_amount'=>$newRsLeftAmount]);
                    }

                    //block RS user

                    User::where('id', $match->gsmile_user->id)->update(['is_block'=>1]);
                    
                    //delete
                    //if(isset($match->confirmation->id)){}
                    Cconfirmation::where('match_id',$match->id)->delete();
                    //report


                    $report=new Message;
                    $report->name="System";
                    $report->email="admin@laughtercommunity.com";
                    $report->title="Blockage message";
                    $report->type=2;
                    $report->body= "User ".$match->gsmile_user->name." ( email = ".$match->gsmile_user->email.", phone number = ".$match->gsmile_user->phone.") has been blocked for not fulfilling SL request (Amnt=".number_format($match->amount, 2).", Date=".$match->created_at."). on or before allocated time. Receiver Details : Name = ".$match->rsmile_user->name.", Email =".$match->rsmile_user->email.", Phone number = ".$match->rsmile_user->phone." Receiver will be rematched with another participant(s) within 10 days.";
                    $report->save();


                    Matchuser::where('id', $match->id)->delete();

                    }
                    
                }
                


            }
           
        

        return true;

    }


    public function updateInvestmentAge(){

    	$gsmiles=Gsmile::orderby('id', 'asc')->get();

    	foreach ($gsmiles as $key => $gsmile) {
    		
    		if($gsmile->age >=10){
    			continue;
    		}else{

    			$newAge=$gsmile->age + 1;

    			Gsmile::where('id', $gsmile->id)->update(['age'=>$newAge]);
    		}
    	}


    }


    public function addGrowth() {
        
  
    		//runs daily
				            
            $gsmiles=Gsmile::orderBy('id', 'asc')->get();   //growth is added based on GS time
            
            //echo json_encode($gsmiles);

            if(!empty($gsmiles)){

            foreach ($gsmiles as $key => $gsmile) {

                //stop at 10th day
                $timeCreatedInSecs=strtotime($gsmile->created_at);

                $growthDuration=(10*24*60*60);  //10 days

                $now=time();

                if(($now-$timeCreatedInSecs) <= $growthDuration){


                $growth=$gsmile->growth;


                if($gsmile->user->is_pioneer == '1'){

                	 $roiValue=(80/100); //80% ROI;

				 }elseif($gsmile->user->is_early_reaper == '1'){

				 	$sower_id=$gsmile->user->id;

				 	$achievedSmiles=Gsmile::where('user_id', $sower_id)->count();

				 	if(achievedSmiles > 1){

				 			$roiValue=(50/100); //50% ROI;

				 	}else{

				 			$roiValue=(60/100); //60% ROI;

				 	}

				 }else{

				 	$roiValue=(50/100); //50% ROI;

				 }

                $perDayGrowth=(($roiValue*$gsmile->amount)/10);

                $newGrowth=$growth+$perDayGrowth;

                Gsmile::where('id', $gsmile->id)->update(['growth'=>$newGrowth]);


            }

            }
        }


            

        
         return true;

    }


    public function makeTeamLead(){

    	//runs daily

    	$users=User::orderBy('id', 'asc')->get();

    	foreach ($users as $key => $user) {

    		if($user->is_teamlead=='1'){
    			continue;
    		}else{

    			$id=$user->id;
        
       
       

            //make team lead;
        $totalDownlines=0;
        //first generation
        $firstGen=Referer::where('referer_user_id', $id)->get();
        if(!empty($firstGen)){
            $firstGenCount=Referer::where('referer_user_id', $id)->count();
            $totalDownlines=$totalDownlines+$firstGenCount;

            //second generation
            foreach ($firstGen as $key => $first) {
                $secondGen=Referer::where('referer_user_id', $first->referee_user_id)->get();
                if(!empty($secondGen)){
                    $secondGenCount=Referer::where('referer_user_id',$first->referee_user_id)->count();
                    $totalDownlines=$totalDownlines+$secondGenCount;

                        //third generation
                            foreach ($secondGen as $key => $second) {
                                $thirdGen=Referer::where('referer_user_id', $second->referee_user_id)->get();
                                if(!empty($thirdGen)){
                                    $thirdGenCount=Referer::where('referer_user_id', $second->referee_user_id)->count();
                                    $totalDownlines=$totalDownlines+$thirdGenCount;
                                }
                            }

                }
            }
        }
        

        if($totalDownlines >= 50){
            User::where('id', $id)->update(['is_teamlead'=>1]);
        }

            

   

    		}

    		
    	}



        return true;

    }













}
