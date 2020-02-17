<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friedns extends Model
{
    protected $fillable = [
        'friend_one', 'friend_two', 'status'
    ];
}
