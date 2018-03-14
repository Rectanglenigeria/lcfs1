<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Gsmile;
use App\Rsmile;
use App\Cconfirmation;
class Insurance extends Model
{
     use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='insurances';

    protected $fillable = [
        'pioneer_id', 'count'
    ];
}
