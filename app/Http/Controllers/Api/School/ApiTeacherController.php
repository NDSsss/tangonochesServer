<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\Api\Teacher\ApiStudentResource;
use App\Http\Resources\Api\teacher\ApiTeacherGroupResource;
use App\Http\Resources\Api\teacher\ApiTeacherTeacherResource;
use App\Http\Resources\School\TicketCountTypeResource;
use App\Http\Resources\School\TicketEventTypeResource;
use App\Repositories\GroupsRepository;
use App\Repositories\StudentsRepository;
use App\Repositories\TeachersRepository;
use App\Repositories\TicketCountTypesRepository;
use App\Repositories\TicketEventTypesRepository;

class ApiTeacherController extends BaseApiController
{
    public function getAllStudents()
    {
        $studentsRepository = app(StudentsRepository::class);
        $students = $studentsRepository->getAllItems();
        return ApiStudentResource::collection($students);
    }

    public function getInitData()
    {
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
            'students' => ApiStudentResource::collection($students),
            'teachers' => ApiTeacherTeacherResource::collection($teachers),
            'groups' => ApiTeacherGroupResource::collection($groups),
            'ticketEventTypes' => TicketEventTypeResource::collection($ticketEventTypes),
            'ticketCountTypes' => TicketCountTypeResource::collection($ticketCountTypes),
        ];
        return json_encode($result);
    }
}
