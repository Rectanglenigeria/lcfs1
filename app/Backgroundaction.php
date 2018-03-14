<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Backgroundaction extends Model
{
    protected $table="backgroundactions";

      protected $fillable = [
        'action_name','interval', 'created_at','updated_at'
    ];
}
