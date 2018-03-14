<?php

namespace App\Http\Controllers;

use App\User;
use App\Gsmile;
use App\Rsmile;
use App\Matchuser;
use App\Cconfirmation;
use App\Message;
use App\Insurance;
use App\Retaiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Response;

class DownloadController extends Controller
{
    public function create($fParam)
    {

$fileName=Cconfirmation::where('match_id', $fParam)->first()->teller_link;

$file = asset('public/uploads/'.$fileName);

$item->mimetype='image/jpeg';
$item->path=$file;
$item->title=$fileName;

//get the image full path
$file = $file;

//set the header
$headers = array('Content-Type' => $item->mimetype);


//return the image file
$response = Response::download($file,$item->title,$headers);
 ob_end_clean();
 return $response;



//return Redirect::to('/matches/view/'.$fParam);

    }
}
