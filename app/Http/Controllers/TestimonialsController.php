<?php

namespace App\Http\Controllers;

use App\Testimonial;
use App\User;
use App\Gsmile;
use App\Rsmile;
use App\Bonus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class TestimonialsController extends Controller
{

	public function getReceivedSmiles()
	{
		$receivedSmiles=Rsmile::where([['user_id',Auth::user()->id],['payment_status','3']])->orderBy('id','desc')->get();
		$achievedTestimonies=Testimonial::where('user_id',Auth::user()->id)->get();
    	
	return view('pages.auth_pages.testimonials.create',['smiles'=>$receivedSmiles,'achievedTestimonies'=>$achievedTestimonies]);
	}

    public function create(Request $request)
    {
    	$formData=$request->all();

        $rule=array(
            'message'=>'required',
            'smileId'=>'required'
            );

        $message=array(
            'message.required'=>'Message field is required.',
            'smileId.required'=>'Smile'
            );

        $validator=Validator::make($formData, $rule, $message);

        if($validator->fails()){
            return Redirect::to('/testimonials/create')->withErrors($validator);

        }else{

    	if(isset($request->video_link)){
    		$video_link=$request->video_link;
    		$has_video='1';
    	}else{
    		$video_link=null;
    		$has_video=null;
    	}

    	$testimony=new Testimonial;
    	$testimony->user_id=Auth::user()->id;
    	$testimony->rsmile_id=$request->smileId;
    	$testimony->message=$request->message;
    	$testimony->video_link=$video_link;
    	$testimony->has_video=$has_video;
    	$testimony->save();

    	return Redirect::to('/testimonials/create')->with('notification','Testimony has been received. Awaiting approval.');

    	}

    }

    public function listTest()
    {
    	$approvedTestimonies=Testimonial::where('has_approved','1')
        ->orWhere('has_approved','2')->orderBy('id', 'desc')->paginate(15);
    	return view('pages.auth_pages.testimonials.list',['approvedTestimonies'=>$approvedTestimonies]);
    }

    public function view($testimony_id)
    {
    	$testimony=Testimonial::where('id',$testimony_id)->first();
    	return view('pages.auth_pages.testimonials.view',['testimony'=>$testimony]);
    }

    public function viewHome($testimony_id)
    {
        $testimony=Testimonial::where('id',$testimony_id)->first();
        return view('pages.auth_pages.testimonials.view',['testimony'=>$testimony]);
    }


    public function listForAdmin()
    {
    	$testimonials=Testimonial::orderBy('id', 'desc')->paginate(50);
    	return view('admin.testimonial.list',['testimonials'=>$testimonials]);

    }


     public function viewForAdmin($id)
    {
    	$testimony=Testimonial::where('id', $id)->first();
    	return view('admin.testimonial.view',['testimony'=>$testimony]);

    }


     public function approveTestimony($id)
    {
    	Testimonial::where('id', $id)->update(['has_approved'=>'1']);
    	return Redirect::to('/admin/testimony/view/'.$id)->with('notification','Testimony approved');
    }

    public function approveTestimonyAndVideo($id)
    {
    	Testimonial::where('id', $id)->update(['has_approved'=>'2']);
        $testimony=Testimonial:: where('id',$id)->first();
    	//populate bonus table 
    $bonus = new Bonus;
    $bonus->user_id= $testimony->user->id;
    $bonus->type=2;
    $bonus->rsmile_id=$testimony->rsmile->id;
    $bonus->amount= (5/100)*$testimony->rsmile->amount;
    $bonus->save();


    	return Redirect::to('/admin/testimony/view/'.$id)->with('notification','Testimony approved, Video bonus granted');

    }




}
