<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Http\Resources\School\EventAnnounceResource;
use App\Repositories\EventAnnouncesRepository;
use App\Repositories\LessonAnnouncesRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function showAnnounces(){
        $lessonAnnouncesRepository = app(LessonAnnouncesRepository::class);
        $eventAnnouncesRepository = app(EventAnnouncesRepository::class);

        $lessonAnnounces = $lessonAnnouncesRepository->getAllItems();
        $eventAnnounces = $eventAnnouncesRepository->getAllItems();

        return view('home',compact('lessonAnnounces','eventAnnounces'));
    }
}
