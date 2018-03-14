<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Referer extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referer_user_id', 'referee_user_id','bonus'
    ];

	//defining inverse one to many relationship btw models User and Referer for referer
    public function referer_user()
    {
    	return $this->belongsTo('App\User','referer_user_id');
    }

    //defining inverse one to many relationship btw models User and Referer  for referee
    public function referee_user()
    {
    	return $this->belongsTo('App\User','referee_user_id');
    }

  
}
