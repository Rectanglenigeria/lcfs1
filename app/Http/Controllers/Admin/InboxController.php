<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Pagination\LengthAwarePaginator;
use App\AdminInbox;


class InboxController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function read(){
    	$inboxs=AdminInbox::where('type','0')
    						->orWhere('type','1')
                            ->orderBy('id', 'desc')
    						->paginate(50);
    	return view('admin.inbox.index',['inboxs'=>$inboxs]);
    }

    public function readFilterByFakereceipt(){
    	$inboxs=AdminInbox::where('type','2')
                            ->orderBy('id', 'desc')
    						->paginate(50);
    	return view('admin.inbox.fakereceipt',['inboxs'=>$inboxs]);
    }

    public function delete($id){
    	$deletedRows = AdminInbox::where('id', $id)->delete();
    	return Redirect::to('admin/inbox')->with('notification','Message succefully deleted');
    }

    public function update(){

    }

    public function reply(Request $request){
        $userDetails=AdminInbox::where('id',$request->input('userId'))->first();
        Mail::send('emails.inboxreply',['url'=>'http://www.expocash.com','username'=>$userDetails->sendername,'replyMessage'=>$request->input('replyMessage')],function($message) use ($request)
        {
            $message->from('admin@expocash.com', 'Expocash platform - Reply message');

            $message->to($request->input('userEmail'));

        });

        $userDetails->reply=$request->input('replyMessage');
        $userDetails->save();

        return Redirect::to('admin/inbox')->with('notification','Message sent succefully to'.$request->input('userEmail'));

    }

    public function fakereceiptreply(Request $request){
        
    }

    public function approvetestimony($id){
        $getTestimony=AdminInbox::where('id',$id)->first();
        $getTestimony->approval=1;
        $getTestimony->save();
        return Redirect::to('admin/inbox')->with('notification','testimony has been approved');
    }


}
