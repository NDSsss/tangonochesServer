<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\School\AdminSchoolLessonAnnounceRequest;
use App\Repositories\GroupsRepository;
use App\Repositories\LessonAnnouncesRepository;
use Illuminate\Http\Request;

class AdminSchoolLessonAnnouncesController extends BaseSimpleAdminSchoolController
{
    /**
     * @var GroupsRepository
     */
    private $groupsRepository;

    /**
     * AdminSchoolLessonAnnounceController2 constructor.
     * @param LessonAnnouncesRepository $lessonAnnouncesRepository
     * @param GroupsRepository $lessonsRepository
     */
    public function __construct(LessonAnnouncesRepository $lessonAnnouncesRepository, GroupsRepository $groupsRepository)
    {
        parent::__construct(8);
        $this->groupsRepository = $groupsRepository;
        $this->repository = $lessonAnnouncesRepository;
    }

    public function create()
    {
        $item = $this->repository->createItem();
        $allGroups = $this->groupsRepository->getAllItems();
        return view($this->currentPath . '.edit', compact('item', 'allGroups'));
    }


    public function store(AdminSchoolLessonAnnounceRequest $request)
    {
        return parent::baseStore($request);
    }


    public function edit($id)
    {
        $item = $this->repository->getItemById($id);
        if (empty($item)) {
            abort(404);
        }
        $allGroups = $this->groupsRepository->getAllItems();
        return view($this->currentPath . '.edit', compact('item', 'allGroups'));
    }


    protected function update(AdminSchoolLessonAnnounceRequest $request, $id)
    {
        return parent::baseUpdate($request, $id);
    }


}
