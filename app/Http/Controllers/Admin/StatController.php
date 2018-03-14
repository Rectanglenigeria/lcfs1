<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Gsmile;
use App\Rsmile;
use App\Matchuser;
use App\Cconfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;


class StatController extends Controller
{
    public function view()
    {
    	//users
    	//total users
    	$totalUsers=(User::orderBy('id', 'desc')->count())-2;

    	$totalBlockedUsers=User::where('is_block', '1')->orderBy('id', 'desc')->count();

    	$totalPioneers=User::where('is_pioneer', '1')->orderBy('id', 'desc')->count();

    	$totalTeamLead=User::where('is_teamlead', '1')->orderBy('id', 'desc')->count();

    	$totalOrdinaryParts=$totalUsers - $totalPioneers;

    	$totalVerifiedParts=User::where('is_active', '1')->orderBy('id', 'desc')->count();

    	//$totalOrdinaryParts=User::where('is_pioneer', '0')->orderBy('id', 'desc')->count();

    	//GS section

    	$totalGsmiles=Gsmile::orderBy('id', 'desc')->count();

    	$totalGsmilesAmount=Gsmile::orderBy('id', 'desc')->sum('amount');

    	$totalGsmilesLeftAmount=Gsmile::orderBy('id', 'desc')->sum('left_amount');

    	$totalGsmilesMatchedAmount=$totalGsmilesAmount - $totalGsmilesLeftAmount;


    	 //RS section

    	$totalRsmiles=Rsmile::orderBy('id', 'desc')->count();

    	$totalRsmilesAmount=Rsmile::orderBy('id', 'desc')->sum('amount');

    	$totalRsmilesLeftAmount=Rsmile::orderBy('id', 'desc')->sum('left_amount');

    	$totalRsmilesMatchedAmount=$totalRsmilesAmount - $totalRsmilesLeftAmount;


    	//Matching section

    	$totalMatches=Matchuser::orderBy('id', 'desc')->count();

    	$totalMatchesAmount=Matchuser::orderBy('id', 'desc')->sum('amount');

    	$totalPaidAmount=Matchuser::where('payment_status','3')->orderBy('id', 'desc')->sum('amount');


    	$totalConfirmation=Matchuser::where('payment_status','3')->count();



    


    	return view('admin.stats.view', ['totalConfirmation'=>$totalConfirmation, 'totalPaidAmount'=>$totalPaidAmount, 'totalMatchesAmount'=>$totalMatchesAmount,'totalMatches'=>$totalMatches,'totalRsmilesMatchedAmount'=>$totalRsmilesMatchedAmount, 'totalRsmilesLeftAmount'=>$totalRsmilesLeftAmount, 'totalRsmilesAmount'=>$totalRsmilesAmount, 'totalRsmiles'=>$totalRsmiles,'totalGsmilesMatchedAmount'=>$totalGsmilesMatchedAmount, 'totalGsmilesLeftAmount'=>$totalGsmilesLeftAmount, 'totalGsmilesAmount'=>$totalGsmilesAmount, 'totalGsmiles'=>$totalGsmiles,'totalUsers'=>$totalUsers, 'totalBlockedUsers'=>$totalBlockedUsers,'totalPioneers'=>$totalPioneers,'totalTeamLead'=>$totalTeamLead,'totalOrdinaryParts'=>$totalOrdinaryParts, 'totalVerifiedParts'=>$totalVerifiedParts, '']);


    }
}
