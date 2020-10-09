<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'uid', 'phone', 'school', 'school_year', 'college', 'college_year', 'university', 'university_year', 'address',
    ];
}
