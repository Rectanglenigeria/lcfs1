<?php

namespace App\Http\Controllers;


use App\User;
use App\Gsmile;
use App\Rsmile;
use App\Matchuser;
use App\Newsfeed;
use App\Referer;
use App\Bonus;
use App\Retaiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;


class WalletController extends Controller
{
    public function view()
    {
    	$rsmiles=Rsmile::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(30);
    	$retaiments=Retaiment::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(30);

    	return view('pages.auth_pages.wallet.view',['rsmiles'=>$rsmiles,'retaiments'=>$retaiments]);
    }
}
