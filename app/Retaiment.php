<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retaiment extends Model
{
    //

     protected $table="retaiments";

      protected $fillable = [
        'user_id','amount'
    ];


    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

     public function rsmile()
    {
    	return $this->belongsTo('App\Rsmile', 'rsmile_id');
    }


    
}
