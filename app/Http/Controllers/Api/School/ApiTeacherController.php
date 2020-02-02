<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Teacher\ApiStudentResource;
use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;

class ApiTeacherController extends Controller
{
    public function getAllStudents(){
        $studentsRepository = app(StudentsRepository::class);
        $students = $studentsRepository->getAllItems();
        return ApiStudentResource::collection($students);
    }
}
