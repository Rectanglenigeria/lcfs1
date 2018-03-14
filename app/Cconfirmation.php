<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cconfirmation extends Model
{
    protected $table="cconfirmations";

      protected $fillable = [
        'gsmile_id', 'rsmile_id','match_id','payment_status','left_amount','remember_token',
        'teller_link','amount'
    ];
    
}
