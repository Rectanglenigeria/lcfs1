<?php

namespace App\Http\Controllers;

use App\User;
use App\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class PagesController extends Controller
{
    public function index(){

    }

    public function about(){
    	return view('pages.about',['ActiveTab'=>'about']);

    }

    public function contact(){
    	return view('pages.contact',['ActiveTab'=>'contact']);

    }

    public function faqs(){
    	return view('pages.faqs',['ActiveTab'=>'faqs']);

    }

    public function testimonial(){
    	$approvedTestimonies=Testimonial::where('has_approved','1')
        ->orWhere('has_approved','2')->orderBy('id','desc')->paginate(12);
    	return view('pages.testimonial',['ActiveTab'=>'testimonial','approvedTestimonies'=>$approvedTestimonies]);

    }

    public function getTestimony($testimony_id){
    	$testimony=Testimonial::where('id',$testimony_id)->first();
    	return view('pages.testimony',['ActiveTab'=>'testimonial','testimony'=>$testimony]);

    }
}
