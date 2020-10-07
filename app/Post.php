<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'uid', 'content', 'image', 'posted_on'
    ];
}
