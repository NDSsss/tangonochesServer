<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'group_id',
    ];
    //

    public function students()
    {
        return $this->belongsToMany('App\Models\Student', 'lessons_students', 'lesson_id', 'student_id')->select(['id', 'name']);
    }
    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher', 'lessons_teachers', 'lesson_id', 'teacher_id')->select(['id', 'name']);
    }
}
