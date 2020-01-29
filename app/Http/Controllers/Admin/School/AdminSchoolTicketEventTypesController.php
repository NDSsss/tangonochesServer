<?php

namespace App\Http\Controllers\Admin\School;

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

    public function store(Request $request)
    {
        return parent::baseStore($request);
    }

    protected function update(Request $request, $id)
    {
        return parent::baseUpdate($request, $id);
    }
}
