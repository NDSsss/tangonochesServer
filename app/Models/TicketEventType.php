<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketEventType extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
}
