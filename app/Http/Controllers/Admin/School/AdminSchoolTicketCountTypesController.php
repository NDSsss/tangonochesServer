<?php

namespace App\Http\Controllers\Admin\School;

use App\Repositories\TicketCountTypesRepository;
use Illuminate\Http\Request;

class AdminSchoolTicketCountTypesController extends BaseSimpleAdminSchoolController
{

    /**
     * AdminSchoolGroupsController constructor.
     * @param TicketCountTypesRepository $groupsRepository
     */
    public function __construct(TicketCountTypesRepository $groupsRepository)
    {
        parent::__construct(3);
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
