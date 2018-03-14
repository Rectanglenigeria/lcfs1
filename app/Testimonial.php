<?php

namespace App;

use App\User;
use App\Rsmile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use Notifiable;

    protected $table="testimonials";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'gsmile_id','message','video_link','has_video'
    ];

	//defining inverse one to many relationship btw models User and Testimonial
    public function user()
    {
    	return $this->belongsTo('App\User','user_id');
    }

    //defining inverse one to many relationship btw models Gsmile and Testimonial  
    public function gsmile()
    {
    	return $this->belongsTo('App\Gsmile','gsmile_id');
    }

    public function rsmile()
    {
    	return $this->belongsTo('App\Rsmile','rsmile_id');
    }
}
