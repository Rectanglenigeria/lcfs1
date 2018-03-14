<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Cconfirmation;
class Matchuser extends Model
{
     use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='matchusers';

    protected $fillable = [
        'gsmile_user_id','rsmile_user_id','user_id', 'amount'
    ];


    public function gsmile_user()
    {
    	return $this->belongsTo('App\User','gsmile_user_id');
    }

    public function rsmile_user()
    {
    	return $this->belongsTo('App\User','rsmile_user_id');
    }

    public function gsmile()
    {
    	return $this->belongsTo('App\Gsmile','gsmile_id');
    }


    public function rsmile()
    {
    	return $this->belongsTo('App\Rsmile','rsmile_id');
    }

     public function confirmation()
    {
    	return $this->hasOne('App\Cconfirmation','match_id');
    }


}
