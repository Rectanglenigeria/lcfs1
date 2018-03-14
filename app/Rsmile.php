<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Rsmile;
use App\User;
use App\Cconfirmation;

class Rsmile extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='rsmiles';

    protected $fillable = [
        'user_id', 'amount','has_received'
    ];


    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }


    public function confirmation()
    {
        return $this->hasMany('App\Cconfirmation' ,'rsmile_id');
    }

    public function gsmile()
    {
    	return $this->belongsTo('App\Gsmile','gsmile_id');
    }

}
