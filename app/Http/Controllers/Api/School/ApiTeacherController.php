<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\School\AdminSchoolLessonsRequest;
use App\Http\Requests\Api\Teacher\TeacherBaseDeleteRequest;
use App\Http\Requests\Api\Teacher\TeacherRegisterLessonRequest;
use App\Http\Requests\Api\Teacher\TeacherRegisterTicketRequest;
use App\Http\Requests\Api\Teacher\TeacherUpdateLessonRequest;
use App\Http\Resources\Api\Teacher\ApiStudentResource;
use App\Http\Resources\Api\teacher\ApiTeacherGroupResource;
use App\Http\Resources\Api\teacher\ApiTeacherTeacherResource;
use App\Http\Resources\School\TicketCountTypeResource;
use App\Http\Resources\School\TicketEventTypeResource;
use App\Repositories\GroupsRepository;
use App\Repositories\LessonsRepository;
use App\Repositories\StudentsRepository;
use App\Repositories\TeachersRepository;
use App\Repositories\TicketCountTypesRepository;
use App\Repositories\TicketEventTypesRepository;
use App\Repositories\TicketsRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiTeacherController extends Controller
{
    public function getAllStudents(){
        $studentsRepository = app(StudentsRepository::class);
        $students = $studentsRepository->getAllItems();
        return ApiStudentResource::collection($students);
    }

    public function getInitData(){
        //Students
        $studentsRepository = app(StudentsRepository::class);
        $students = $studentsRepository->getAllItems();
        //Teachers
        $teachersRepository = app(TeachersRepository::class);
        $teachers = $teachersRepository->getAllItems();
        //Groups
        $groupsRepository = app(GroupsRepository::class);
        $groups = $groupsRepository->getAllItems();
        //TicketEventType
        $ticketEventTypesRepository = app(TicketEventTypesRepository::class);
        $ticketEventTypes = $ticketEventTypesRepository->getAllItems();
        //TicketCountType
        $ticketCountTypesRepository = app(TicketCountTypesRepository::class);
        $ticketCountTypes = $ticketCountTypesRepository->getAllItems();

        $result = [
          'students'=>ApiStudentResource::collection($students),
          'teachers'=>ApiTeacherTeacherResource::collection($teachers),
          'groups'=>ApiTeacherGroupResource::collection($groups),
          'ticketEventTypes'=>TicketEventTypeResource::collection($ticketEventTypes),
          'ticketCountTypes'=>TicketCountTypeResource::collection($ticketCountTypes),
        ];
        return json_encode($result);
    }

    public function registerLesson(TeacherRegisterLessonRequest $request){
//        dd($request);
        $lessonsRepository = app(LessonsRepository::class);
        $result = $lessonsRepository->storeItem($request->input());
        return Response::create($result);
    }

    public function updateLesson(TeacherUpdateLessonRequest $request){
        $lessonsRepository = app(LessonsRepository::class);
        $result = $lessonsRepository->updateLesson($request->input('id'),$request->input());
        if ($result) {
            return Response::create($result);
        } else {
            return Response::create(['error'=>true],400);
        }
    }

    public function deleteLesson(TeacherBaseDeleteRequest $request){
        $lessonsRepository = app(LessonsRepository::class);
        $result = $lessonsRepository->destroyItem($request->input('id'));
        if ($result){
            return Response::create(['error'=>false]);
        } else {
            return Response::create(['error'=>true],400);
        }
    }

    public function registerTicket(TeacherRegisterTicketRequest $request){
        $ticketsRepository = app(TicketsRepository::class);
        $result = $ticketsRepository->storeItem($request->input());
        if ($result) {
            return Response::create($result);
        } else {
            return Response::create(['error'=>true],400);
        }
    }

    public function deleteTicket(TeacherBaseDeleteRequest $request){
        $ticketsRepository = app(TicketsRepository::class);
        $result = $ticketsRepository->destroyItem($request->input('id'));
        if ($result){
            return Response::create(['error'=>false]);
        } else {
            return Response::create(['error'=>true],400);
        }
    }
}
