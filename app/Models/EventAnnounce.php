<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventAnnounce extends Model
{
    use SoftDeletes;

    protected $attributes = [
        'address'=>"",
        'extra_info'=>"",
        'is_active'=>true,
    ];
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'address',
        'extra_info',
        'is_active',
    ];

    protected $casts = [
        'start_date'=>"date:Y-m-d H:i:s",
        'end_date'=>"date:Y-m-d H:i:s",
        'is_active'=>"boolean",
    ];
}
