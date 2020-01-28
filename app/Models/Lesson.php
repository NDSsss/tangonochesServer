<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{

    protected $fillable = [
        'name',
        'group_id',
    ];
    //

    public function students()
    {
        return $this->belongsToMany(Student::class, 'lessons_students', 'lesson_id', 'student_id')->select(['id', 'name']);
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'lessons_teachers', 'lesson_id', 'teacher_id')->select(['id', 'name']);
    }


}
