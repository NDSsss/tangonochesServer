<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Resources\School\EventAnnounceResource;
use App\Http\Resources\School\LessonAnnounceResource;
use App\Repositories\EventAnnouncesRepository;
use App\Repositories\LessonAnnouncesRepository;

class ApiAnnouncesController extends BaseApiController
{
    public function lessonAnnounces()
    {
        $lessonAnnouncesRepository = app(LessonAnnouncesRepository::class);
        $announces = $lessonAnnouncesRepository->getAllEvents();
        return LessonAnnounceResource::collection($announces);
    }

    public function eventAnnounces()
    {
        $eventAnnouncesRepository = app(EventAnnouncesRepository::class);
        $announces = $eventAnnouncesRepository->getAllAnnounces();
        return EventAnnounceResource::collection($announces);
    }
}
