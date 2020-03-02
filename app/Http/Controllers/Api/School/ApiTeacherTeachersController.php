<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Repositories\TeachersRepository;
use Illuminate\Http\Request;

class ApiTeacherTeachersController extends Controller
{
    function getAllTeachers(){
        $repository = app(TeachersRepository::class);
        return response()->json($repository->getAllItems());
    }
}
