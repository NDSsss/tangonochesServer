<?php

namespace App\Http\Resources\Api\Teacher;

use App\Repositories\LessonsRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiTeacherLessonFullResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $parentArray = parent::toArray($request);
        $lessonsRepository = app(LessonsRepository::class);
        $teachers = $lessonsRepository->getTeacherIdsOfLesson($this->id);
        $students = $lessonsRepository->getStudentIdsOfLesson($this->id);
        $additionalArray = [
            'teachers'=>$teachers,
            'students'=>$students
        ];

        $resultArray = array_merge($parentArray, $additionalArray);
        return $resultArray;
    }
}
