<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Repositories\TicketCountTypesRepository;
use App\Repositories\TicketEventTypesRepository;
use Illuminate\Http\Request;

class AdminSchoolTicketEventTypesController extends BaseSimpleAdminSchoolController
{

    /**
     * AdminSchoolGroupsController constructor.
     * @param TicketEventTypesRepository $groupsRepository
     */
    public function __construct(TicketEventTypesRepository $groupsRepository)
    {
        parent::__construct(4);
        $this->repository = $groupsRepository;
    }
}
