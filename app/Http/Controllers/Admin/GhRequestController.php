<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Ghelprequest;
use App\Helprequest;


class GhRequestController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function read(){
    	$ghrequests=Ghelprequest::orderBy('id', 'desc')->paginate(1000);
    	$countRequests=Ghelprequest::all()->count();
    	$sumRequestAmounts=Ghelprequest::all()->sum('amount');
    	$sumPaidOut=Helprequest::where('status','3')->sum('amount');
    	$netSumRequestAmounts = $sumRequestAmounts-$sumPaidOut;
    	return view('admin.ghrequest.index',
    		['ghrequests'=>$ghrequests,
    		'totalRequestsMade'=>$countRequests,
    		'totalAmountRequested'=>$sumRequestAmounts,
    		'netSumRequestAmounts'=>$netSumRequestAmounts]);
    }

    public function delete($id){
    	$deletedRows = Ghelprequest::where('id', $id)->delete();
    	return Redirect::to('admin/requests/gh')->with('notification','Request succefully deleted');
    }
}
