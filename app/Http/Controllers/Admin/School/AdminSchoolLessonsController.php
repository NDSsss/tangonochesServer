<?php

namespace App\Http\Controllers\Admin\School;

use App\Repositories\LessonsRepository;


class AdminSchoolLessonsController extends BaseSimpleAdminSchoolController
{

    /**
     * AdminSchoolGroupsController constructor.
     * @param LessonsRepository $lessonsRepository
     */
    public function __construct(LessonsRepository $lessonsRepository)
    {
        parent::__construct(5);
        $this->repository = $lessonsRepository;
    }
}
