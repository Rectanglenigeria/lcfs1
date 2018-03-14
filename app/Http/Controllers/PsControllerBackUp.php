<?php

namespace App\Http\Controllers;
use App\User;
use App\Gsmile;
use App\Rsmile;
use App\Matchuser;
use App\Cconfirmation;
use App\Referer;
use App\Bonus;
use App\Insurance;
use App\Backgroundaction;
use App\Retaiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;



class PsController extends Controller
{	
	//return give smile form 

    public function showGsmileForm()
    {
        return view('pages.auth_pages.gsmiles.create');
    }

    //parses and paginate all user smiles

    public function achieved ()
    {
        $achievedSmiles=Gsmile::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(30);

        return view('pages.auth_pages.gsmiles.achieved',['achievedSmiles'=>$achievedSmiles]);

    }

    //create give smile requests

    public function create (Request $request)
    {
    	//parse minimum GS value exception to user

    	$amount=intval($request->amount); //string to number

         if($amount < 10000)
         {

            return Redirect::to('/gsmile/create')->with('notification','Ops! Minimum amount is 10,000 Naira')->withInput();
         }

         //parse maximu GS exception to user

         if($amount > 500000)
         {

            return Redirect::to('/gsmile/create')->with('notification','Ops! Maximum amount is 500,000 Naira')->withInput();
         }

         //all user levels cannot give subsequent smile value lesser than first  GS value

         $gsHistory=Gsmile::where('user_id', Auth::user()->id)->orderBy('id','desc')->first();

         if(!empty($gsHistory))
         {

         	//has initial GS
            $userFirstGsAmount=$gsHistory->amount;
            
         }else{
         	//No initial GS,
            $userFirstGsAmount=0;
        }

        //parse exception to view 
        if($userFirstGsAmount > $request->amount){

        	return Redirect::to('/gsmile/create')->with('notification','Your new GS amount can not be lesser than your last GS amount ('.number_format($userFirstGsAmount,2).' Naira)')->withInput();
        }

        //parse exception on multi GS for user

        $achievedSmiles=Gsmile::where('user_id', Auth::user()->id)->orderBy('id','asc')->get();

                if(!empty($achievedSmiles))
                {

                    $leftAmountStatusArray=[];

                foreach ($achievedSmiles as $key => $smile) {

                    if($smile->left_amount > 0){

                        $status = 0;

                        //lesser than or equal to zero

                    }else{

                        $status = 1;
                    }

                    $leftAmountStatusArray[$key]=$status;

                }



                }else{

                    $leftAmountStatusArray=[0,0,0];

                }

                // parse no multi GS exception for ordinary participant

                if(in_array(0, $leftAmountStatusArray) && Auth::user()->is_pioneer <= 0)
                {

                	 $not="You must fufill all previous GS requests before new GS request";

            		 return Redirect::to('/gsmile/create')->with('notification', $not)->withInput();
                }



                  if(in_array(0, $leftAmountStatusArray) && Auth::user()->is_pioneer == 0)
                {

                	 $not="You must fufill all previous GS requests before new GS request";

            		 return Redirect::to('/gsmile/create')->with('notification', $not)->withInput();
                }



                //parmit  2 multi GS for pioneer and Team Lead
				//echo json_encode($leftAmountStatusArray);
		

            	//return Redirect::to('/gte/'.$countFalseValues);
                 
//echo json_encode($leftAmountStatusArray);
//echo $countFalseValues;

                 if(Auth::user()->is_pioneer == '1')
                 {

                 	//match pioneer or team lead

                 	//get form data

                 	$formData=$request->all();

                        $rule=array(
                            'amount'=>'required',
                        );

                        $message=array(
                            'amount.required'=>'Smile amount is required.',
                            );

                        $validator=Validator::make($formData, $rule, $message);

                        if($validator->fails()){

                            return Redirect::to('/gsmile/create')->withErrors($validator);

                        }else{


                            //if user is pioneer
                            if(Auth::user()->is_pioneer == '1'){

        						$AllGsmilesForPioneer=Gsmile::where('user_id', Auth::user()->id)->orderBy('id','asc')->get(); 

        					//	echo json_encode($AllGsmilesForPioneer);
                         	//
                            	if(collect($AllGsmilesForPioneer)->isEmpty()){
                                 
                                 // match 100% for pioneer

                                 	$response=$this->saveInitPioneerGsRequest($request->all());

                                 	return Redirect::to('/gsmile/create')->with('notification','You have succesfully created a smile request. You have been matched with '.$response['pioneer_name'].'('.$response['pioneer_phone'].') to make  payment of '.$response['insuranceAmount'].' Naira (100%). Check Matchlist table for account details.');

                           		 }else{

                                            //confirm 100% of retainment GS
                                            if(isset($request->retainment_id)){

                                                //check for previous request

                                                $check=Gsmile::where('r_token',$request->retainment_id)->first();

                                                if(collect($check)->isEmpty()){



                                                $rid=$request->amount;
                                                $rToPay=intval($request->retainment_amt);
                                                if($rid < $rToPay){
                                                    return Redirect::to('/wallet/view')->with('You must make new GS of 100% of retainment capital.');
                                                }

                                               //$parseDetails=['retainment_id']=$request->re

                                            }else{

                                                return Redirect::to('/wallet/view')->with('Already GS to unlock retained smile.');
                                            }


                                            }

                                 			#is pioneer other GS
                                			$response= $this->saveGsRequest($request->all());

                                 			return Redirect::to('/gsmile/create')->with('notification','You have succesfully created a smile request. You have been matched with '.$response['pioneer_name'].'('.$response['pioneer_phone'].') to make insurance payment of '.$response['insuranceAmount'].' Naira (20%). Check Matchlist table for account details.');
                               
                            	 }
                           
                           }

                   
                        }


                 }else{

                 	//parse the exception to view

                    //confirm 100% of retainment GS
                                            if(isset($request->retainment_id)){
                                                $rid=$request->request->amount;
                                                $rToPay=intval($request->retainment_amt);
                                                if($rid < $rToPay){
                                                    return Redirect::to('/wallet/view')->with('You must make new GS of 100% of retainment capital.');
                                                }
                                            }


                 	$response = $this->saveGsRequest($request->all());

                    return Redirect::to('/gsmile/create')->with('notification','You have succesfully created a smile request. You have been matched with '.$response['pioneer_name'].'('.$response['pioneer_phone'].') to make insurance payement of '.$response['insuranceAmount'].' Naira (20%). Check Matchlist table for account details.');

                 }





    }



    public function saveInitPioneerGsRequest($request)
{

    $pioneer_id=Auth::user()->id;

    //etract retainment token out

    if(isset($request['retainment_id'])){

        $retainment_id=$request['retainment_id'];



    }else{

        $retainment_id=0;

    }

    //create GS request by pioneer
         $createSmile=new Gsmile;

         $createSmile->user_id=Auth::user()->id;

         $createSmile->left_amount=$request['amount']; //initializing left_amount

         $createSmile->track_token=$track_token1=mt_rand(10000, 1000000);

         $createSmile->amount=$request['amount'];

         $createSmile->r_token=$retainment_id;

         $createSmile->remember_token=$request['_token'];

         $createSmile->save();

         $gsmilem=Gsmile::where('track_token',$track_token1)->first();

         $pioneer_gsmile_id=$gsmilem->id; 


    //Create Virtual GS request for bot
         $createSmile1=new Gsmile;

         $createSmile1->user_id=User::where('email', 'fadahunsi@gmail.com')->first()->id;

         $createSmile1->left_amount=($request['amount']/2); //initializing left_amount
         
         $createSmile1->amount=($request['amount']/2);

         $createSmile1->track_token=$ref_track_token=mt_rand(1000, 100000);

         $createSmile1->hidden=1;

         $createSmile1->save();

    //create virtual RS for bot
         $rsmile= new Rsmile;

         $rsmile->user_id=User::where('email', 'fadahunsi@gmail.com')->first()->id;

         $rsmile->gsmile_id=Gsmile::where('track_token', $ref_track_token)->first()->id;

         $rsmile->amount=$request['amount'];

         $rsmile->left_amount=$request['amount'];

         $rsmile->track_token=$bot_rs_track_token=mt_rand(1000, 100000);

         $rsmile->remember_token=$request['_token'];

         $rsmile->save();

         $bot_rsmile_id=Rsmile::where('track_token', $bot_rs_track_token)->first()->id;

         

        //match pioneer GS to both RS
        //match user 100% with central bot
         $insuranceAmount=$request['amount'];

         $match= new Matchuser;

         $match->gsmile_user_id=Auth::user()->id;

         $match->rsmile_user_id=User::where('email', 'fadahunsi@gmail.com')->first()->id;

         $match->gsmile_id=$pioneer_gsmile_id;

         $match->rsmile_id=$bot_rsmile_id; //0 for pioneers

         $match->amount=$request['amount'];

         $match->payment_status=1;

         $match->payment_type=2;  //2 for 100% , 

         $track_token2=mt_rand(10000, 1000000);

         $match->track_token=$track_token2;

         $match->remember_token=$request['_token'];

         $match->save();

         //populate confirmation table

         $confirm=new Cconfirmation;

         $confirm->gsmile_id=$pioneer_gsmile_id;

         $confirm->rsmile_id=$bot_rsmile_id;

         $confirm->match_id=Matchuser::where('track_token',$track_token2)->first()->id;

         $bot=User::where('email', 'fadahunsi@gmail.com')->first();

         $confirm->payment_status=1;

         $confirm->amount=$request['amount'];

         $confirm->left_amount=0;

         $confirm->remember_token=$request['_token'];

         $confirm->save();


         //stage pioneer to 20% queue line setting count =0 i.e about to receive

         $checkInsurance=Insurance::where('pioneer_id',Auth::user()->id)->first();

         if(empty($checkInsurance)){

            $insurance=new Insurance;

            $insurance->pioneer_id=Auth::user()->id;

            $insurance->count=0;

            $insurance->save();

         }else{

            Insurance::where('pioneer_id',Auth::user()->id)->update(['count'=>0]);
         }

         

         //give referrer bonus per GS

         //first generation
         $referer =Referer::where('referee_user_id',Auth::user()->id)->first();

         if(!empty($referer)){

         $referer_id=$referer->referer_user_id;

         $bonus = new Bonus;

         $bonus->user_id= $referer_id; //referer id

         $bonus->amount= (5/100) * $request['amount'];

         $bonus->type=1;

         $bonus->referee_id=Auth::user()->id;

         $bonus->save();


         //second generation
         $referer1 =Referer::where('referee_user_id',$referer_id)->first();

         if(!empty($referer1)) {

         $referer_id=$referer1->referer_user_id;

         $referer_user=User::where('id', $referer_id)->first();

         if($referer_user->is_pioneer == '1' || $referer_user->is_teamlead == '1'){

         $bonus1 = new Bonus;

         $bonus1->user_id= $referer_id; //referer id

         $bonus1->amount= (3/100) * $request['amount'];

         $bonus1->type=1;

         $bonus1->referee_id=Auth::user()->id;

         $bonus1->save();

          //Third generation
         $referer2 =Referer::where('referee_user_id',$referer_id)->first();

         if(!empty($referer2)){

         $referer_id=$referer2->referer_user_id;

         $referer_user=User::where('id', $referer_id)->first();

         if($referer_user->is_pioneer == '1' || $referer_user->is_teamlead == '1'){

         $bonus2 = new Bonus;

         $bonus2->user_id= $referer_id; //referer id

         $bonus2->amount= (1/100) * $request['amount'];

         $bonus2->type=1;

         $bonus2->referee_id=Auth::user()->id;

         $bonus2->save();

        }


        }


    }


        }


    }




         //update GS table for pioneer

        Gsmile::where('id', $pioneer_gsmile_id)->update(['left_amount'=>($request['amount'] - $insuranceAmount)]);

         //update RS table for bot

         $rsLeftAmount=0;

        Rsmile::where('id', $bot_rsmile_id)->update(['left_amount'=>$rsLeftAmount]);



         return $response = ['pioneer_name'=>$bot->name, 'pioneer_phone'=>$bot->phone,'insuranceAmount'=>number_format($request['amount'], 2),'status'=>'success'];

        
}



public function saveGsRequest($request)
{

        //etract retainment token out
    //echo $request['retainment_amt'];
    //return Redirect::to('/dd/r');

    if(isset($request['retainment_id'])){

        $retainment_id=$request['retainment_id'];

    }else{

        $retainment_id=0;
        
    }

        //create GS request for req 'owner'

         $createSmile=new Gsmile;

         $createSmile->user_id=Auth::user()->id;

         $createSmile->left_amount=$request['amount']; //initializing left_amount

         $createSmile->track_token=$track_token1=mt_rand(10000, 1000000);

         $createSmile->amount=$request['amount'];

         $createSmile->r_token=$retainment_id;

         $createSmile->remember_token=$request['_token'];

         $createSmile->save();

         $gsmilem=Gsmile::where('track_token',$track_token1)->first();

         $owner_gsmile_id=$gsmilem->id; 

   

        
         //calculate and macth 20% insurance to pioneer

         //geting insurance percent from model
         $bg=Backgroundaction::where('action_name','insurance_value')->first();
         if(collect($bg)->isEmpty()){
         	$insuranceAmount=floor((20/100)*$request['amount']);
         }else{
         	$insDBval=Backgroundaction::where('action_name','insurance_value')->first()->interval;
         $insDBval=intval($insDBval);
         $insuranceAmount=floor(($insDBval/100)*$request['amount']);

         }
         

        


         $start = $user=User::where('is_pioneer','1')->orderBy('id', 'asc')->count();

         for($i=1; $i<=$start; $i++){
 

        $user=User::where('is_pioneer','1')->orderBy('id', 'asc')->get();

        $number_of_pioneers=$start;
        
        //echo json_encode($user);

        $randomNumber=mt_rand(0,$number_of_pioneers-1); //the limits iclusive

        $selected_pioneer_id=$user[$randomNumber]->id;

        //echo $user[$randomNumber]->id;
        //return Redirect::to('cc/gg');

        //while ($selected_pioneer_id == $gsmilem->user->id) {
          //  $randomNumber=mt_rand(0,$number_of_pioneers-1); //the limits iclusive
           // $selected_pioneer_id=$user[$randomNumber]->id;
        //}
                $pioneer=User::where('id',$selected_pioneer_id)->first();

                $pioneer_id=$pioneer->id;


            if(collect($user)->isEmpty()){

            $pioneer_phone='08137990656';

            $pioneer=User::where('phone',$pioneer_phone)->first();

            $pioneer_id=$pioneer->id;

            $pioneer_name=$pioneer->name;

            }else{






                    //there are pioneers

              $achievedGsmilesByPioneer=Gsmile::where('user_id', $pioneer_id)->get();

                if(collect($achievedGsmilesByPioneer)->isEmpty()){

                    continue;
                }   //not relevant






                        //was Gsmile
                    $lastRsmilesOfPioneer=Rsmile::where('user_id', $pioneer_id)->orderBy('id','desc')->first();

                   // echo $randomNumber;
                    if(collect($lastRsmilesOfPioneer)->isEmpty()){

                        continue;  

                    }else{





                        if($lastRsmilesOfPioneer->left_amount <= 0){

                        //fully paid , so not participate
                            Insurance::where('pioneer_id', $pioneer_id)->update(['count'=>0]);

                            continue;

                            //partly paid, participate
                        }elseif($lastRsmilesOfPioneer->left_amount > 0){
                        	Insurance::where('pioneer_id', $pioneer_id)->update(['count'=>1]);

                            
                        }


         $insuranceCount=Insurance::where('pioneer_id', $pioneer_id)->first()->count;

                        if($lastRsmilesOfPioneer->left_amount >0 && $insuranceCount>0){

//echo $pioneer_id;   



















                        	//getting the receiver Rsmile request
                        	$pioneer_rsmile=Rsmile::where('user_id', $pioneer_id)->orderBy('id', 'desc')->first();

                        	if(collect($pioneer_rsmile)->isEmpty()){
                        		//to safe the system when there is limited or no 
                        		//RS requests
                        		$pioneer_id=40;

                    $pioneer=User::where('id',40)->first();

                    $pioneer_name=$pioneer->name;

                    $pioneer_phone=$pioneer->phone;

                    //match to bot 2

        //Create Virtual GS request for bot2
         $createSmile1=new Gsmile;

         $createSmile1->user_id=User::where('email', 'oladejo@gmail.com')->first()->id;

         $createSmile1->left_amount=($insuranceAmount/2); //initializing left_amount
         
         $createSmile1->amount=($insuranceAmount/2);
         
         $createSmile1->track_token=$ref_track_token=mt_rand(1000, 100000);
         
         $createSmile1->hidden=1;
         
         $createSmile1->save();

    //create virtual RS for bot2

         $rsmile= new Rsmile;
         
         $rsmile->user_id=User::where('email', 'oladejo@gmail.com')->first()->id;
         
         $rsmile->gsmile_id=Gsmile::where('track_token', $ref_track_token)->first()->id;
         
         $rsmile->amount=$insuranceAmount;
         
         $rsmile->left_amount=$insuranceAmount;
         
         $rsmile->track_token=$bot_rs_track_token=mt_rand(1000, 100000);
         
         $rsmile->remember_token=$request['_token'];
         
         $rsmile->save();
         
         $bot_rsmile_id=Rsmile::where('track_token', $bot_rs_track_token)->first()->id;

         

        //match  GS to bot2 RS
        
        //match user 20% with  bot2
         
         $match= new Matchuser;
         
         $match->gsmile_user_id=Auth::user()->id;
         
         $match->rsmile_user_id=User::where('email', 'oladejo@gmail.com')->first()->id;
        
         $match->gsmile_id=$owner_gsmile_id;
         
         $match->rsmile_id=$bot_rsmile_id; //0 for pioneers
         
         $match->amount=$insuranceAmount;
         
         $match->payment_status=1;
         
         $match->payment_type=0;  //  0 for 20% 2 for 100% , 
         
         //$match->parent_id=$owner_gsmile_id;
         
         $track_token23=mt_rand(10000, 1000000);
         
         $match->track_token=$track_token23;
         
         $match->remember_token=$request['_token'];
         
         $match->save();

         //populate confirmation table
         $confirm=new Cconfirmation;

         $confirm->gsmile_id=$owner_gsmile_id;

         $confirm->rsmile_id=$bot_rsmile_id;

         $confirm->match_id=Matchuser::where('track_token',$track_token23)->first()->id;

         $bot=User::where('email', 'oladejo@gmail.com')->first();

         $confirm->payment_status=1;

         $confirm->amount=$insuranceAmount;

         $confirm->left_amount=$gsLeftAmount=0;

         $confirm->remember_token=$request['_token'];

         $confirm->save();







//referrer section

         //give referrer bonus per GS

         //first generation
         $referer =Referer::where('referee_user_id',Auth::user()->id)->first();

         if(!empty($referer)){

         $referer_id=$referer->referer_user_id;

         $bonus = new Bonus;

         $bonus->user_id= $referer_id; //referer id

         $bonus->amount= (5/100) * $request['amount'];

         $bonus->type=1;

         $bonus->referee_id=Auth::user()->id;

         $bonus->save();


         //second generation
         $referer1 =Referer::where('referee_user_id',$referer_id)->first();

         if(!empty($referer1)) {

         $referer_id=$referer1->referer_user_id;

         $referer_user=User::where('id', $referer_id)->first();

         if($referer_user->is_pioneer == '1' || $referer_user->is_teamlead == '1'){

         $bonus1 = new Bonus;

         $bonus1->user_id= $referer_id; //referer id

         $bonus1->amount= (3/100) * $request['amount'];

         $bonus1->type=1;

         $bonus1->referee_id=Auth::user()->id;

         $bonus1->save();

          //Third generation
         $referer2 =Referer::where('referee_user_id',$referer_id)->first();

         if(!empty($referer2)){

         $referer_id=$referer2->referer_user_id;

         $referer_user=User::where('id', $referer_id)->first();

         if($referer_user->is_pioneer == '1' || $referer_user->is_teamlead == '1'){

         $bonus2 = new Bonus;

         $bonus2->user_id= $referer_id; //referer id

         $bonus2->amount= (1/100) * $request['amount'];

         $bonus2->type=1;

         $bonus2->referee_id=Auth::user()->id;

         $bonus2->save();

        }


        }


    }


        }


    }



         //referreer section








         //update GS table
         Gsmile::where('id', $owner_gsmile_id)->update(['left_amount'=>($request['amount'] - $insuranceAmount)]);

         //update RS table

         $rsLeftAmount=0;
         
        Rsmile::where('id', $bot_rsmile_id)->update(['left_amount'=>$rsLeftAmount]);


         return $response = ['pioneer_name'=>$pioneer_name, 'pioneer_phone'=>$pioneer_phone,'insuranceAmount'=>number_format($insuranceAmount, 2),'status'=>'success']; 





                        	}else{

                        		  //do the matching
                          $pioneer_rsmile_id = $rsmile1=Rsmile::where('user_id', $pioneer_id)->orderBy('id', 'desc')->first()->id;

                          $pioneer_rsmile=Rsmile::where('user_id', $pioneer_id)->orderBy('id', 'desc')->first();

                        	}



                          

                          


































































































                          //skip match if reciver=giver

                          if($pioneer_id==Auth::user()->id){
                            continue;

                          }

            //if rsmile->left_amount == 0 : what happens $this->saveGsRequest($request)
            //if insurance 20% > $rsmile->left-amount $this->saveGsRequest($request);
                          //populate match table

                            $match= new Matchuser;

                            $match->gsmile_user_id=Auth::user()->id;

                            $match->rsmile_user_id=$pioneer_id;

                            $match->gsmile_id=$owner_gsmile_id;

                            $match->rsmile_id=$pioneer_rsmile_id; //0 for pioneers

                            $amountToPay=$match->amount=$insuranceAmount;  //20%

                            $match->payment_status=1;

                            $match->payment_type=0;  //20% flag

                            $track_token22=mt_rand(10000, 1000000);

                            $match->track_token=$track_token22;

                            $match->remember_token=$request['_token'];

                            $match->save();

                            //populate confirmation table

         $confirm=new Cconfirmation;

         $confirm->gsmile_id=$owner_gsmile_id;

         $confirm->rsmile_id=$pioneer_rsmile_id;

         $confirmM=Matchuser::where('track_token',$track_token22)->first();

         $confirm->match_id=$confirmM->id;

         $confirm->payment_status=1;

         $confirm->amount=$amountToPay;

         $confirm->left_amount=$gsLeftAmount=$request['amount'] - $insuranceAmount;//$leftAmount;

         $confirm->remember_token=$request['_token'];

         $confirm->save();





//referrer section

         //give referrer bonus per GS

         //first generation
         $referer =Referer::where('referee_user_id',Auth::user()->id)->first();

         if(!empty($referer)){

         $referer_id=$referer->referer_user_id;

         $bonus = new Bonus;

         $bonus->user_id= $referer_id; //referer id

         $bonus->amount= (5/100) * $request['amount'];

         $bonus->type=1;

         $bonus->referee_id=Auth::user()->id;

         $bonus->save();


         //second generation
         $referer1 =Referer::where('referee_user_id',$referer_id)->first();

         if(!empty($referer1)) {

         $referer_id=$referer1->referer_user_id;

         $referer_user=User::where('id', $referer_id)->first();

         if($referer_user->is_pioneer == '1' || $referer_user->is_teamlead == '1'){

         $bonus1 = new Bonus;

         $bonus1->user_id= $referer_id; //referer id

         $bonus1->amount= (3/100) * $request['amount'];

         $bonus1->type=1;

         $bonus1->referee_id=Auth::user()->id;

         $bonus1->save();

          //Third generation
         $referer2 =Referer::where('referee_user_id',$referer_id)->first();

         if(!empty($referer2)){

         $referer_id=$referer2->referer_user_id;

         $referer_user=User::where('id', $referer_id)->first();

         if($referer_user->is_pioneer == '1' || $referer_user->is_teamlead == '1'){

         $bonus2 = new Bonus;

         $bonus2->user_id= $referer_id; //referer id

         $bonus2->amount= (1/100) * $request['amount'];

         $bonus2->type=1;

         $bonus2->referee_id=Auth::user()->id;

         $bonus2->save();

        }


        }


    }


        }


    }



         //referreer section








         //update GS table
         Gsmile::where('id', $owner_gsmile_id)->update(['left_amount'=>($request['amount'] - $insuranceAmount)]);

         //update RS table

         $rsLeftAmount=$pioneer_rsmile->left_amount - $insuranceAmount;

        Rsmile::where('id', $pioneer_rsmile_id)->update(['left_amount'=>$rsLeftAmount]);

        $has_matched=1;


                    $pioneer=User::where('id', $pioneer_id)->first();

                    $pioneer_name=$pioneer->name;

                    $pioneer_phone=$pioneer->phone;

         return $response = ['pioneer_name'=>$pioneer_name, 'pioneer_phone'=>$pioneer_phone,'insuranceAmount'=>number_format($insuranceAmount, 2),'status'=>'success'];  

        break;




                        }


                    }

                    




                }// closes if no pioneer

                

           } //closes for loop

            //turn bot to oladejo
            if(!isset($has_matched)){

                    $pioneer_id=40;

                    $pioneer=User::where('id',40)->first();

                    $pioneer_name=$pioneer->name;

                    $pioneer_phone=$pioneer->phone;

                    //match to bot 2

        //Create Virtual GS request for bot2
         $createSmile1=new Gsmile;

         $createSmile1->user_id=User::where('email', 'oladejo@gmail.com')->first()->id;

         $createSmile1->left_amount=($insuranceAmount/2); //initializing left_amount
         
         $createSmile1->amount=($insuranceAmount/2);
         
         $createSmile1->track_token=$ref_track_token=mt_rand(1000, 100000);
         
         $createSmile1->hidden=1;
         
         $createSmile1->save();

    //create virtual RS for bot2

         $rsmile= new Rsmile;
         
         $rsmile->user_id=User::where('email', 'oladejo@gmail.com')->first()->id;
         
         $rsmile->gsmile_id=Gsmile::where('track_token', $ref_track_token)->first()->id;
         
         $rsmile->amount=$insuranceAmount;
         
         $rsmile->left_amount=$insuranceAmount;
         
         $rsmile->track_token=$bot_rs_track_token=mt_rand(1000, 100000);
         
         $rsmile->remember_token=$request['_token'];
         
         $rsmile->save();
         
         $bot_rsmile_id=Rsmile::where('track_token', $bot_rs_track_token)->first()->id;

         

        //match  GS to bot2 RS
        
        //match user 20% with  bot2
         
         $match= new Matchuser;
         
         $match->gsmile_user_id=Auth::user()->id;
         
         $match->rsmile_user_id=User::where('email', 'oladejo@gmail.com')->first()->id;
        
         $match->gsmile_id=$owner_gsmile_id;
         
         $match->rsmile_id=$bot_rsmile_id; //0 for pioneers
         
         $match->amount=$insuranceAmount;
         
         $match->payment_status=1;
         
         $match->payment_type=0;  //  0 for 20% 2 for 100% , 
         
         //$match->parent_id=$owner_gsmile_id;
         
         $track_token23=mt_rand(10000, 1000000);
         
         $match->track_token=$track_token23;
         
         $match->remember_token=$request['_token'];
         
         $match->save();

         //populate confirmation table
         $confirm=new Cconfirmation;

         $confirm->gsmile_id=$owner_gsmile_id;

         $confirm->rsmile_id=$bot_rsmile_id;

         $confirm->match_id=Matchuser::where('track_token',$track_token23)->first()->id;

         $bot=User::where('email', 'oladejo@gmail.com')->first();

         $confirm->payment_status=1;

         $confirm->amount=$insuranceAmount;

         $confirm->left_amount=$gsLeftAmount=0;

         $confirm->remember_token=$request['_token'];

         $confirm->save();






         //referrer section

         //give referrer bonus per GS

         //first generation
         $referer =Referer::where('referee_user_id',Auth::user()->id)->first();

         if(!empty($referer)){

         $referer_id=$referer->referer_user_id;

         $bonus = new Bonus;

         $bonus->user_id= $referer_id; //referer id

         $bonus->amount= (5/100) * $request['amount'];

         $bonus->type=1;

         $bonus->referee_id=Auth::user()->id;

         $bonus->save();


         //second generation
         $referer1 =Referer::where('referee_user_id',$referer_id)->first();

         if(!empty($referer1)) {

         $referer_id=$referer1->referer_user_id;

         $referer_user=User::where('id', $referer_id)->first();

         if($referer_user->is_pioneer == '1' || $referer_user->is_teamlead == '1'){

         $bonus1 = new Bonus;

         $bonus1->user_id= $referer_id; //referer id

         $bonus1->amount= (3/100) * $request['amount'];

         $bonus1->type=1;

         $bonus1->referee_id=Auth::user()->id;

         $bonus1->save();

          //Third generation
         $referer2 =Referer::where('referee_user_id',$referer_id)->first();

         if(!empty($referer2)){

         $referer_id=$referer2->referer_user_id;

         $referer_user=User::where('id', $referer_id)->first();

         if($referer_user->is_pioneer == '1' || $referer_user->is_teamlead == '1'){

         $bonus2 = new Bonus;

         $bonus2->user_id= $referer_id; //referer id

         $bonus2->amount= (1/100) * $request['amount'];

         $bonus2->type=1;

         $bonus2->referee_id=Auth::user()->id;

         $bonus2->save();

        }


        }


    }


        }


    }



         //referreer section








         //update GS table
         Gsmile::where('id', $owner_gsmile_id)->update(['left_amount'=>($request['amount'] - $insuranceAmount)]);

         //update RS table

         $rsLeftAmount=0;
         
        Rsmile::where('id', $bot_rsmile_id)->update(['left_amount'=>$rsLeftAmount]);


         return $response = ['pioneer_name'=>$pioneer_name, 'pioneer_phone'=>$pioneer_phone,'insuranceAmount'=>number_format($insuranceAmount, 2),'status'=>'success']; 

            } 

        //track  down 20% of GS




         



}



}
