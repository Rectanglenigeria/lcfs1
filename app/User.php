<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Gsmile;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone', 'email', 'password','name','account_name','account_no','bank','referer_link'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function gsmile()
    {
        return $this->hasMany('App\Gsmile','user_id');
    }

    public function referer()
    {
        return $this->hasMany('App\Referer', 'referer_user_id');
    }



    
}
