<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\School\AdminSchoolEventAnnounceRequest;
use App\Repositories\EventAnnouncesRepository;
use Illuminate\Http\Request;

class AdminSchoolEventAnnouncesController extends BaseSimpleAdminSchoolController
{

    /**
     * AdminSchoolLessonAnnounceController2 constructor.
     * @param EventAnnouncesRepository $eventAnnouncesRepository
     */
    public function __construct(EventAnnouncesRepository $eventAnnouncesRepository)
    {
        parent::__construct(9);
        $this->repository = $eventAnnouncesRepository;
    }


    public function store(AdminSchoolEventAnnounceRequest $request)
    {
        return parent::baseStore($request);
    }


    protected function update(AdminSchoolEventAnnounceRequest $request, $id)
    {
        return parent::baseUpdate($request, $id);
    }


}
