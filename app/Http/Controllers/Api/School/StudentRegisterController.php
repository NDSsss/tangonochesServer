<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;

class StudentRegisterController extends Controller
{
    function registerStudent(Request $request){
        $studentsRepository = app(StudentsRepository::class);
        $newStudentId = $studentsRepository->createStudentByEmail($request->input('email'));
        return json_encode(['barcode_id'=>$newStudentId]);
    }
}
