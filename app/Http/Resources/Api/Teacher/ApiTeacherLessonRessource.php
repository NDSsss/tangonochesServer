<?php

namespace App\Http\Resources\Api\Teacher;

use App\Repositories\LessonsRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiTeacherLessonRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        $lessonsRepository = app(LessonsRepository::class);
//        $teachers = $lessonsRepository->getTeacherIdsOfLesson($this->id);
//        $students = $lessonsRepository->getStudentIdsOfLesson($this->id);
        return [
            'name'=>$this->name,
            'group_id'=>$this->group_id,
//            'teachers'=>$teachers,
//            'students'=>$students,
//            'teachers'=>\DB::table('lessons_teachers')->select(['teacher_id'])->where('lesson_id','=',$this->id)->get(),
//            'students'=>\DB::table('lessons_students')->select(['student_id'])->where('lesson_id','=',$this->id)->get(),
        ];
    }
}
