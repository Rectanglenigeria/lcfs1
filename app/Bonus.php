<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $table="bonuses";

      protected $fillable = [
        'type','user_id','amount'
    ];


    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

     public function rsmile()
    {
    	return $this->belongsTo('App\Rsmile', 'rsmile_id');
    }


    public function referee()
    {
    	return $this->belongsTo('App\User', 'referee_id');
    }
}




