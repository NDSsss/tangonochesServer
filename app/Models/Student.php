<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    protected $attributes = [
        'name' => 'name def',
        'phone' => 'phone def',
        'vk_profile_link' => 'vk_profile_link def',
        'vk_profile_id' => 1,
        'facebook_profile_link' => 'facebook_profile_link def',
        'facebook_profile_id' => 1,
        'instagram_profile_link' => 'instagram_profile_link def',
        'instagram_profile_id' => 1,
        'photo_link' => 'photo_link def',
        'extra_info' => 'extra_info def',
        'push_token' => 'push_token def',
        'barcode_id' => 1,
    ];
    protected $fillable = [
        'name',
        'phone',
        'vk_profile_link',
        'vk_profile_id',
        'facebook_profile_link',
        'facebook_profile_id',
        'instagram_profile_link',
        'instagram_profile_id',
        'photo_link',
        'extra_info',
        'push_token',
        'barcode_id',
    ];
}
