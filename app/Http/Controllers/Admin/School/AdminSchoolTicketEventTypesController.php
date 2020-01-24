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
        $this->repository = $groupsRepository;
    }

    function getModelPath(): string
    {
        return 'ticketEventTypes';
    }
}
