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

class RsmileController extends Controller
{

    public function list()
    {
        $achievedSmiles=Rsmile::orderBy('id', 'desc')->paginate(500);

        $achievedSmilesNo=Rsmile::all()->count();
        return view('admin.rsmile.list',['achievedSmiles'=>$achievedSmiles, 'achievedSmilesNo'=>$achievedSmilesNo]);
    }


    public function view($id)
    {
        $smile=Rsmile::where('id', $id)->first();
        //echo json_encode($match);
        return view('admin.rsmile.rsmile_view',['smile'=>$smile]);
    }


    public function delete($id)
    {
        $smile=Rsmile::where('id', $id)->delete();
        //echo json_encode($match);
        return Redirect::to('admin/rsmile/list')->with('notification','Request succefully cancelled');
    }


}
