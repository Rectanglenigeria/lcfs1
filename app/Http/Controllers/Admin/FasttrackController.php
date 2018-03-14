<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Gsmile;
use App\Rsmile;
use App\Matchuser;
use App\Retaiment;
use App\Backgroundaction;
use App\Insurance;
use App\Cconfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class FasttrackController extends Controller
{
     public function view()
    {
        $achievedSmiles=Gsmile::orderBy('id', 'desc')->paginate(500);
        $achievedSmilesNo=Gsmile::all()->count();
        return view('admin.fasttrack.list',['achievedSmiles'=>$achievedSmiles, 'achievedSmilesNo'=>$achievedSmilesNo]);
    }

    public function stage($gsmile_id)
    {
    	$gsmile=Gsmile::where('id', $gsmile_id)->first();
    	//compute engine : compute ROI and income
    	$invested=Gsmile::where('id', $gsmile_id)->first()->amount;
    	$roi=$invested;
    	$income=$invested+$roi;


    	// remove and store retaiment
    	$retainmentAmount=(0.1)*$income;
    	$leftAmountAfterRetainment=$income-$retainmentAmount;

    	//create RS 
    	//RS 80% left
        $rsmile=new rsmile;
        $rsmile->user_id=$gsmile->user->id;
        $rsmile->gsmile_id=$gsmile_id;
        $rsmile->amount=$leftAmountAfterRetainment;
        $rsmile->left_amount=$leftAmountAfterRetainment;
        $rsmile->track_token=$track_token=mt_rand(10000, 100000);
        $rsmile->remember_token=null;
        $rsmile->save();

        //Extract 20% retainment
        $r_token=mt_rand(10000, 100000);
            $retainSmile=new Retaiment;
            $retainSmile->user_id=$gsmile->user->id;
            $retainSmile->rsmile_id=Rsmile::where('track_token',$track_token)->first()->id;
            $retainSmile->amount=$retainmentAmount;
            $retainSmile->status=0;  //pending
            $retainSmile->r_token=$r_token;
            $retainSmile->save();
            //GS 20% recommitment


        //update reap status in GS table for participant
        Gsmile::where('id', $gsmile_id)->update(['reap_status'=>1]);
        //update reap status in GS table for participant


        return Redirect::to('/admin/fasttrack/view')->with('notification','User successfully staged.');

        //create gsmile of amount equivalent to initial amount
    	//match 20% insurance  to pioneer
    	//$fsuser_id=$gsmile->user->id;
    	//$response = $this->saveGsRequest(['amount'=>$invested, '_token'=>null, 'user_id'=>$fsuser_id]);

                    //return Redirect::to('/admin/fasttrack/view')->with('notification','User successfully staged. You can now match user. User has also been macthed with '.$response['pioneer_name'].'('.$response['pioneer_phone'].') to make insurance payement of '.$response['insuranceAmount'].' Naira (20%). Check Matchlist.');

    	//end staging process and return admin back

    }

    public function match($rsmile_id)
    {




    }




public function saveGsRequest($request)
{

     
        //create GS request for req 'owner'

         $createSmile=new Gsmile;

         $createSmile->user_id=$request['user_id'];

         $createSmile->left_amount=$request['amount']; //initializing left_amount

         $createSmile->track_token=$track_token1=mt_rand(10000, 1000000);

         $createSmile->amount=$request['amount'];

       

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

        $number_of_pioneers=count($user);
        
        //echo json_encode($user);

        $randomNumber=mt_rand(0,$number_of_pioneers-1); //the limits iclusive

        $selected_pioneer_id=$user[$randomNumber]->id;

        //while ($selected_pioneer_id == $gsmilem->user->id) {
          //  $randomNumber=mt_rand(0,$number_of_pioneers-1); //the limits iclusive
           // $selected_pioneer_id=$user[$randomNumber]->id;
        //}
                $pioneer=User::where('id',$selected_pioneer_id)->first();

                $pioneer_id=$pioneer->id;


            if(empty($user)){

            $pioneer_phone='08137990656';

            $pioneer=User::where('phone',$pioneer_phone)->first();

            $pioneer_id=$pioneer->id;

            $pioneer_name=$pioneer->name;

            }else{






                    //there are pioneers

              $achievedGsmilesByPioneer=Gsmile::where('user_id', $pioneer_id)->get();

                if(empty($achievedGsmilesByPioneer)){

                    continue;
                }   //not relevant







                    $lastRsmilesOfPioneer=Gsmile::where('user_id', $pioneer_id)->orderBy('id','desc')->first();

                   // echo $randomNumber;
                    if(empty($lastRsmilesOfPioneer)){

                        continue;  

                    }else{





                        if($lastRsmilesOfPioneer->left_amount == 0){

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
         
         $match->gsmile_user_id=$request['user_id'];
         
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

                          if($pioneer_id==$request['user_id']){
                            continue;

                          }

            //if rsmile->left_amount == 0 : what happens $this->saveGsRequest($request)
            //if insurance 20% > $rsmile->left-amount $this->saveGsRequest($request);
                          //populate match table

                            $match= new Matchuser;

                            $match->gsmile_user_id=$request['user_id'];

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
            if(isset($has_matched)){

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
         
         $match->gsmile_user_id=$request['user_id'];
         
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
