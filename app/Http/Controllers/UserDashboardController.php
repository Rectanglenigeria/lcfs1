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
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class UserDashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {



    	$matches=Matchuser::where('gsmile_user_id',Auth::user()->id)
							->orWhere('rsmile_user_id',Auth::user()->id)
							->orderBy('id','desc')->paginate(30,['*'], 'page_a');
							//echo Auth::user()->id;
							//echo json_encode($matches);
		$timeLeftArray=[];

if(!empty($matches)){
			$count=0;
		foreach ($matches as $key => $match) {
		  $timeUsed=intval(time())-intval(strtotime($match->created_at));

		  if($match->is_extended == 1){
		  	$allocatedTime=(48)*60*60 ;  //48 + 12 hours
		  }else{
		  	 $allocatedTime=24*60*60 ; //48 hours to seconds
		  }

          $timeLeft= $allocatedTime-$timeUsed;

          if($timeLeft <= 0){
          	$timeLeftArray[$count] =0;
          }else{
          $timeLeftArray[$count] = $timeLeft;

          }

          $count++;
		}

	}




		$newsfeeds=Newsfeed::orderBy('id','desc')->get();
		$referees =Referer::where('referer_user_id', Auth::user()->id)
							->orderBy('id','desc')->paginate(10, ['*'], 'page_b');


		$transactions=Matchuser::where([['rsmile_user_id', Auth::user()->id],['payment_status', 3]])->orWhere([['gsmile_user_id',Auth::user()->id],['payment_status', 3]])
							->orderBy('id','desc')->paginate(10, ['*'], 'page_c');



		$latestPaid=Matchuser::where('payment_status',3)->orderBy('id','desc')->get();

		//echo json_encode($referees);

    	return view('pages.auth_pages.index',['matches'=>$matches,'timeLeftArray'=>$timeLeftArray, 'newsfeeds'=>$newsfeeds,'referees'=>$referees,'transactions'=>$transactions,'latestPaid'=>$latestPaid]);
    }







    public function blockGsmileUsers()
    {
      $now=time();
      $matches = Matchuser::where([['rsmile_user_id',Auth::user()->id],['payment_status',1]])->orderBy('id', 'asc')->get();

      if(!collect($matches)->isEmpty()){

          foreach ($matches as $key => $match) {
              //check form time 48hrs + 8hrs
              if($match->is_extended >= 1){
                  $allocatedTime=(48)*60*60;
              }elseif($match->is_extended <=0){
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

}




public function removeDefaulter($match_id)
{
  $match = Matchuser::where('id', $match_id)->orderBy('id', 'asc')->first();

  if(!collect($match)->isEmpty()){

              //unmactch//rollback //for GS

          if(isset($match->rsmile_user->id)){
          $newGsLeftAmount= ($match->gsmile->left_amount + $match->amount);
          Gsmile::where('id', $match->gsmile->id)->update(['left_amount'=>$newGsLeftAmount]);
              //for RS
          if(isset($match->rsmile->id)){
              $newRsLeftAmount= ($match->rsmile->left_amount + $match->amount);
              Rsmile::where('id', $match->rsmile->id)->update(['left_amount'=>$newRsLeftAmount]);
          }

          //block RS user //delete
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

          return Redirect::to('/dashboard')->with('notification','Defaulter successfully removed from your matc. You will be rematched soon.');


  }
}

}




}
