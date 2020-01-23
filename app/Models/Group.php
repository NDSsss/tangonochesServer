<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'first_lesson_time',
        'second_lesson_time',
        'address'
    ];
}
