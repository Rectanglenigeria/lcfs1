<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Cconfirmation;
class Message extends Model
{
     use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='messages';

    protected $fillable = [
        'name','type','user_id', 'title','body', 'email','attachment_link'
    ];


}
