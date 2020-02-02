<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Resources\School\EventAnnounceResource;
use App\Http\Resources\School\LessonAnnounceResource;
use App\Repositories\EventAnnouncesRepository;
use App\Repositories\LessonAnnouncesRepository;
use Illuminate\Http\Request;

class ApiAnnouncesController extends Controller
{
    public function lessonAnnounces(){
        $lessonAnnouncesRepository = app(LessonAnnouncesRepository::class);
        $announces = $lessonAnnouncesRepository->getAllEvents();
        return LessonAnnounceResource::collection($announces);
    }

    public function eventAnnounces(){
        $eventAnnouncesRepository = app(EventAnnouncesRepository::class);
        $announces = $eventAnnouncesRepository->getAllAnnounces();
        return EventAnnounceResource::collection($announces);
    }
}
