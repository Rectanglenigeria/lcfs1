<?php

namespace App\Http\Controllers\admin;


use App\User;
use App\Gsmile;
use App\Rsmile;
use App\Matchuser;
use App\Cconfirmation;
use App\Message;
use App\Insurance;
use App\Retaiment;
use App\Backgroundaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;


class BgController extends Controller
{

  public function updateMGI(){
      $gsmile=Gsmile::orderBy('id', 'asc')->get();
      foreach ($gsmile as $key => $smile) {
        Matchuser::where('gsmile_id', $smile->id)->update(['gsmile_user_id'=>$smile->user_id]);
      }

      return Redirect::to('/admin/dashboard')->with('notification','All done');



  }


    public function run()
    {
                    $countBlock=$this->blockUsers();

                  return Redirect::to('/admin/dashboard')->with('notification', $countBlock.' Users blocked');


    }


     public function runAutoMatch()
    {
                    $countMatches=$this->autoMatchUsers();

                  return Redirect::to('/admin/dashboard')->with('notification', $countMatches.' matches.');


    }






       public function autoMatchUsers()
    {

    	$countMatches=0;

        $background1=Backgroundaction::where('action_name','pause_automatch')->first();
        if($background1->interval==1){


        //setting run time
        $background=Backgroundaction::where('action_name','auto_match')->first();
        $intervalInSecs=(intval($background->interval) *24* 60 *60);
        $lastRunTime=strtotime($background->updated_at);
        $now=time();
        $lastRunInterval=$now-$lastRunTime;
        if($lastRunInterval >= $intervalInSecs){


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

                	if(!isset($gsmile->user->id)){continue;}

                    if($gsmile->hidden == 1){continue;}

                    $rsmiles=Rsmile::where('left_amount','>', 0)->orderBy('id', 'asc')->get();
                    if(! collect($rsmiles)->isEmpty()){
                        foreach ($rsmiles as $key => $rsmile) {

                        	if(!isset($rsmile->user->id)){continue;}
                        	//echo json_encode($rsmile);
                        	//echo json_encode($gsmile);
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
                                    $countMatches++;
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

                                      $countMatches++;
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
                                    $countMatches++;
                                    continue;
                            }
                        }
                    }
                }
            }



            Backgroundaction::where('action_name', 'auto_match')->update(['interval'=>1]);

        }


        return $countMatches;
    }else{
         //Backgroundaction::where('action_name', 'auto_match')->update(['interval'=>1]);
         //return true;
    }

    }


    public function blockUsers()
    {

    	$countBlock=0;


            $matches = Matchuser::where('payment_status',1)->orderBy('id', 'asc')->get();

            if(!empty($matches)){

                foreach ($matches as $key => $match) {
                    //check form time 48hrs + 8hrs
                    if($match->is_extended >= 1){
                        $allocatedTime=(48+12)*60*60;
                    }elseif($match->is_extended <=0){
                        $allocatedTime=48*60*60;
                    }

                    //check for time
                    $matchingTime=strtotime($match->created_at);
                    $expiresAt=$matchingTime+$allocatedTime;
                    $outOfTime=$now-$expiresAt;
                    if($outOfTime >= 0){


                        //unmactch
                        //rollback
                           //for GS

                    if(isset($match->rsmile_user->id)){
                    $newGsLeftAmount= ($match->gsmile->left_amount + $match->amount);
                    Gsmile::where('id', $match->gsmile->id)->update(['left_amount'=>$newGsLeftAmount]);
                        //for RS
                    if(isset($match->rsmile->id)){
                        $newRsLeftAmount= ($match->rsmile->left_amount + $match->amount);
                        Rsmile::where('id', $match->rsmile->id)->update(['left_amount'=>$newRsLeftAmount]);
                    }

                    //block RS user


                    //delete
                    //if(isset($match->confirmation->id)){}
                    Cconfirmation::where('match_id',$match->id)->delete();
                    //report


                    if(isset($match->gsmile_user->id)){

                    User::where('id', $match->gsmile_user->id)->update(['is_block'=>1]);



                    $report=new Message;
                    $report->name="System";
                    $report->email="admin@smilesteadily.com";
                    $report->title="Blockage message";
                    $report->type=2;
                    $report->body= "User ".$match->gsmile_user->name." ( email = ".$match->gsmile_user->email.", phone number = ".$match->gsmile_user->phone.") has been blocked for not fulfilling GS request (Amnt=".number_format($match->amount, 2).", Date=".$match->created_at."). on or before allocated time. Receiver Details : Name = ".$match->rsmile_user->name.", Email =".$match->rsmile_user->email.", Phone number = ".$match->rsmile_user->phone." Receiver will be rematched with another participant(s) within 15 days.";
                    $report->save();

                        }
                    Matchuser::where('id', $match->id)->delete();


                    $countBlock++;

                }



                    }

                }



            }



        return $countBlock;

    }


    public function addGrowth()
    {
        //setting run time
        $background=Backgroundaction::where('action_name','growth')->first();
        $intervalInSecs=($background->interval *24* 60 *60);
        $lastRunTime=strtotime($background->updated_at);
        $now=time();
        $lastRunInterval=$now-$lastRunTime;
        if($lastRunInterval >= $intervalInSecs){


            $gsmiles=Gsmile::orderBy('id', 'asc')->get();   //growth is added based on GS time

            //echo json_encode($gsmiles);

            if(!empty($gsmiles)){
            foreach ($gsmiles as $key => $gsmile) {
                //stop at 15th day
                $timeCreatedInSecs=strtotime($gsmile->created_at);
                $growthDuration=(15*24*60*60);  //15 days
                $now=time();
                if(($now-$timeCreatedInSecs) <= $growthDuration){
                $growth=$gsmile->growth;
                $perDayGrowth=($gsmile->amount/15);
                $newGrowth=$growth+$perDayGrowth;
                Gsmile::where('id', $gsmile->id)->update(['growth'=>$newGrowth]);
            }

            }
        }


            Backgroundaction::where('action_name', 'growth')->update(['interval'=>1]);


        }


         return true;

    }


    public function makeTeamLead($phone)
    {

        $user=User::where('phone',$phone)->first();

        if(!empty($user)){

            $id=$user->id;

        if(isset($id)){
        //setting run time
        $background=Backgroundaction::where('action_name','make_teamlead')->first();
        $intervalInSecs=($background->interval *24* 60 *60);
        $lastRunTime=strtotime($background->updated_at);
        $lastLoggingTime=strtotime(User::where('id', $id)->first()->updated_at);
        $now=time();
        $lastRunInterval=$now-$lastLoggingTime;
        if($lastRunInterval >= $intervalInSecs){

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

             Backgroundaction::where('action_name', 'make_teamlead')->update(['interval'=>1]);
        }

    }

    }

        return true;

    }





}
