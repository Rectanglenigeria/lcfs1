<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Backgroundaction;
use Illuminate\Support\Facades\Redirect;

class AutomatchController extends Controller
{
    public function stop(){

    		Backgroundaction::where('action_name','pause_automatch')->update(['interval'=>0]);
    		return Redirect::to('/admin/dashboard')->with('notification','Automatching bot deactivated.');
    }

    public function start(){

    		Backgroundaction::where('action_name','pause_automatch')->update(['interval'=>1]);
    		return Redirect::to('/admin/dashboard')->with('notification','Automatching bot activated.');
    }


    

}
