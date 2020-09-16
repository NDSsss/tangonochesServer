<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
//    protected $attributes = [
//        'name' => 'name def',
//        'phone' => 'phone def',
//        'vk_profile_link' => 'vk_profile_link def',
//        'vk_profile_id' => 1,
//        'facebook_profile_link' => 'facebook_profile_link def',
//        'facebook_profile_id' => 1,
//        'instagram_profile_link' => 'instagram_profile_link def',
//        'instagram_profile_id' => 1,
//        'photo_link' => 'photo_link def',
//        'extra_info' => 'extra_info def',
//        'push_token' => 'push_token def',
//        'barcode_id' => 1,
//    ];
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
        'points',
        'platform',
        'password',
        'api_token'
    ];

    protected $hidden = [
        'password', 'api_token',
    ];

    public function lessonsLeft(){
        return $this->hasMany(StudentsTicketTypesLessonsLeft::class, 'student_id', 'id');
    }

    public function notifications(){
        return $this->belongsToMany(Notification::class, 'notifications_students', 'student_id', 'notification_id')->select(['id']);
    }
}
