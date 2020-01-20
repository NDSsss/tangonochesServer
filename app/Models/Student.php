<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
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
}
