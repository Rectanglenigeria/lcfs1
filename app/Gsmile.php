<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Gsmile;
use App\Rsmile;
use App\Cconfirmation;


class Gsmile extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='gsmiles';

    protected $fillable = [
        'user_id', 'amount'
    ];


    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }


    public function confirmation()
    {
        return $this->hasMany('App\Cconfirmation' ,'gsmile_id');
    }

    public function rsmile()
    {
        return $this->hasOne('App\Rsmile' ,'gsmile_id');
    }

     public function gs_match()
    {
        return $this->hasMany('App\Matchuser' ,'gsmile_id');
    }



}
