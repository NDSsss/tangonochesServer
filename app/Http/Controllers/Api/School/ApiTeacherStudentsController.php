<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Teacher\ApiTeacherGetStudentByIdRequest;
use App\Http\Requests\Api\Teacher\BaseApiTeacherPaginationRequest;
use App\Http\Requests\Api\Teacher\TeacherRegisterStudentRequest;
use App\Http\Requests\Api\Teacher\TeacherUpdateStudentRequest;
use App\Http\Resources\Api\Teacher\ApiStudentResource;
use App\Http\Resources\Api\Teacher\ApiTeacherStudentFullResource;
use App\Repositories\StudentsRepository;
use Illuminate\Http\Response;

class ApiTeacherStudentsController extends BaseApiController
{
    public function getAllStudents(BaseApiTeacherPaginationRequest $request)
    {
        $studentsRepository = app(StudentsRepository::class);
        $page = $request->input('page');
        $countOnPage = $request->input('count_on_page');
        return ApiStudentResource::collection($studentsRepository->getAllItemsApiPaginated($page, $countOnPage));
    }

    public function studentById(ApiTeacherGetStudentByIdRequest $request){
        $studentsRepository = app(StudentsRepository::class);
        $student = $studentsRepository->getItemById($request->input('id'));
        return new ApiTeacherStudentFullResource($student);
    }

    public function registerStudent(TeacherRegisterStudentRequest $request){
        $studentsRepository = app(StudentsRepository::class);
        $result = $studentsRepository->storeItem($request->input());
        return new ApiTeacherStudentFullResource($result);
    }

    public function updateStudent(TeacherUpdateStudentRequest $request){
        $studentsRepository = app(StudentsRepository::class);
        $result = $studentsRepository->updateItem($request->input(), $request->input('id'));
        if ($result) {
            return Response::create(['error' => false]);
        } else {
            return Response::create(['error' => true], 400);
        }
    }

    public function deleteStudent(ApiTeacherGetStudentByIdRequest $request){

        $studentsRepository = app(StudentsRepository::class);
        $result = $studentsRepository->destroyItem($request->input('id'));
        if ($result) {
            return Response::create(['error' => false]);
        } else {
            return Response::create(['error' => true], 400);
        }
    }
}
