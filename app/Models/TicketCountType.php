<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCountType extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'price',
        'lessons_count'
    ];
}
