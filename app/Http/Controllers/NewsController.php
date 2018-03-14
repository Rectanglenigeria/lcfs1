<?php

namespace App\Http\Controllers;

use App\Newsfeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsController extends Controller
{
    public function read()
    {
    	$newsfeeds=Newsfeed::orderBy('id', 'desc')->paginate(10);
    	return view('pages.auth_pages.news.list',['newsfeeds'=>$newsfeeds]);
    }

    public function view($news_id)
    {
    	$news=Newsfeed::where('id', $news_id)->first();
    	return view('pages.auth_pages.news.view',['news'=>$news]);
    }


    public function delete($news_id)
    {
        Newsfeed::where('id', $news_id)->delete();
        $news=Newsfeed::where('id', $news_id)->first();
        return view('admin.news.view',['news'=>$news]);
    }

    public function readForAdmin()
    {
    	$newsfeeds=Newsfeed::orderBy('id', 'desc')->paginate(10);
    	return view('admin.news.list',['newsfeeds'=>$newsfeeds]);
    }

     public function viewForAdmin($news_id)
    {
    	$news=Newsfeed::where('id', $news_id)->first();
    	return view('admin.news.view',['news'=>$news]);
    }


     public function showNewsForm()
    {
    	return view('admin.news.create');
    }

    public function create(Request $request)
    {
    	$formData=$request->all();

        $rule=array(
            'title'=>'required',
            'body'=>'required',
            );

        $message=array(
            'title.required'=>'Title of news required.',
            'body.required'=>'Body of news is required.',
            );

        $validator=Validator::make($formData, $rule, $message);

        if($validator->fails()){
            return Redirect::to('/admin/news/create')->withErrors($validator);

        }else{
            //compare code

        	$news= new Newsfeed;
        	$news->title=$request->title;
        	$news->body=$request->body;
        	$news->remember_token=$request->_token;
        	$news->save();
          	return Redirect::to('/admin/news/create')->with('notification','News has been published');

           
        }
    }
}
