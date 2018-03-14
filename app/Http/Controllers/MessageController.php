<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class MessageController extends Controller
{


	public function readForAdmin()
	{
		$messages= Message::orderBy('id', 'desc')->paginate(20);
		return view('admin.messages.list',['messages'=>$messages]);
	}

	public function viewForAdmin($id)
	{
		$message= Message::where('id', $id)->first();
		return view('admin.messages.view',['message'=>$message]);
	}


    public function sendContactMessage(Request $request)
    {
    	$formData=$request->all();

        $rule=array(
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required',
            'attachment'=>'required'
            );

        $message=array(
            'firstname.required'=>'firstname is required',
            'lastname.required'=>'lastname is required',
            'email.required'=>'email is required',
            'subject.required'=>'subject is required',
            'message.required'=>'message is required'
            );

        $validator=Validator::make($formData, $rule, $message);

        if($validator->fails()){
            return Redirect::to('/contact')->withErrors($validator);

        }else{
            //compare code

        	$message= new Message;
        	$message->name=$request->firstname." ".$request->lastname;
        	$message->email=$request->email;
        	$message->title=$request->subject;
        	$message->body=$request->message;
        	$message->type=1;
        	


        	if($request->hasFile('attachment')){
    		$file=$request->file('attachment');

    		$file->move('public/uploads',$file->getClientOriginalName());

    		$message->attachment_link=$file->getClientOriginalName();
    	}else{

    		$message->attachment_link=null;
    	}

    	$message->save();



          	return Redirect::to('/contact')->with('notification','Your message has been sent. You will receive feedback soon. Thanks.');

           
        }

    }
}
