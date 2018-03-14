<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Helprequest;
//use App\User;

class PhRequestController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function read(){
    	$phrequests=Helprequest::orderBy('id', 'desc')->paginate(1000);
    	$countRequests=Helprequest::all()->count();
    	$sumRequestAmounts=Helprequest::all()->sum('amount');
    	$sumPaidOut=Helprequest::where('status','3')->sum('amount');
    	$netSumRequestAmounts = $sumRequestAmounts-$sumPaidOut;
    	return view('admin.phrequest.index',
    		['phrequests'=>$phrequests, 
    		'totalRequestsMade'=>$countRequests,
    		'totalAmountPledged'=>$sumRequestAmounts,
    		'netSumRequestAmounts'=>$netSumRequestAmounts]
    		);
    }

    public function delete($id){
    	$deletedRows = Helprequest::where('id', $id)->delete();
    	return Redirect::to('admin/requests/ph')->with('notification','Request succefully deleted');
    }

    public function complete($id){
    	$phrequests=Helprequest::where('id',$id)->first();
    	$phrequests->status='3';
    	$phrequests->save();

    	return Redirect::to('admin/requests/ph')->with('notification','GH access succefully granted');
    }

}
