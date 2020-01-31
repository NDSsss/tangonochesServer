<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonAnnounce extends Model
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
        'group_id',
        'address',
        'extra_info',
        'is_active',
    ];

    protected $casts = [
        'start_date'=>"date:Y-m-d H:i:s",
        'end_date'=>"date:Y-m-d H:i:s",
        'group_id'=>"integer",
        'is_active'=>"boolean",
    ];



    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
