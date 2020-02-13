<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Teacher\ApiTeacherGetLessonByIdRequest;
use App\Http\Requests\Api\Teacher\BaseApiTeacherPaginationRequest;
use App\Http\Requests\Api\Teacher\TeacherBaseDeleteRequest;
use App\Http\Requests\Api\Teacher\TeacherRegisterLessonRequest;
use App\Http\Requests\Api\Teacher\TeacherUpdateLessonRequest;
use App\Http\Resources\Api\Teacher\ApiTeacherLessonFullResource;
use App\Http\Resources\Api\Teacher\ApiTeacherLessonRessource;
use App\Repositories\LessonsRepository;
use Illuminate\Http\Response;

class ApiTeacherLessonsController extends BaseApiController
{

    public function allLessons(BaseApiTeacherPaginationRequest $request)
    {
        $lessonsRepository = app(LessonsRepository::class);
        $page = $request->input('page');
        $countOnPage = $request->input('count_on_page');
        return ApiTeacherLessonRessource::collection($lessonsRepository->getAllItemsApiPaginated($page, $countOnPage));
    }

    public function lessonById(ApiTeacherGetLessonByIdRequest $request){
        $lessonRepository= app(LessonsRepository::class);
        $lesson = $lessonRepository->getItemById($request->input('id'));
        return new ApiTeacherLessonFullResource($lesson);
    }

    public function registerLesson(TeacherRegisterLessonRequest $request)
    {
//        dd($request);
        $lessonsRepository = app(LessonsRepository::class);
        $result = $lessonsRepository->storeItem($request->input());
        return Response::create($result);
    }

    public function updateLesson(TeacherUpdateLessonRequest $request)
    {
        $lessonsRepository = app(LessonsRepository::class);
        $result = $lessonsRepository->updateLesson($request->input('id'), $request->input());
        if ($result) {
            return Response::create($result);
        } else {
            return Response::create(['error' => true], 400);
        }
    }

    public function deleteLesson(ApiTeacherGetLessonByIdRequest $request)
    {
        $lessonsRepository = app(LessonsRepository::class);
        $result = $lessonsRepository->destroyItem($request->input('id'));
        if ($result) {
            return Response::create(['error' => false]);
        } else {
            return Response::create(['error' => true], 400);
        }
    }
}
