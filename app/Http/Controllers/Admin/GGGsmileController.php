<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Gsmile;
use App\Rsmile;
use App\Matchuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class GGGsmileController extends Controller
{
    public function list()
    {
        $achievedSmiles=Gsmile::orderBy('id', 'desc')->paginate(500);
        $achievedSmilesNo=Gsmile::all()->count();
        return view('admin.gsmile.list',['achievedSmiles'=>$achievedSmiles, 'achievedSmilesNo'=>$achievedSmilesNo]);
    }


    public function view($id)
    {
        $smile=Gsmile::where('id', $id)->first();
        //echo json_encode($match);
        return view('admin.gsmile.gsmile_view',['smile'=>$smile]);
    }


    public function delete($id)
    {
        $smile=Gsmile::where('id', $id)->delete();
        //echo json_encode($match);
        return Redirect::to('admin/gsmile/list')->with('notification','Request succefully cancelled');
    }
}
