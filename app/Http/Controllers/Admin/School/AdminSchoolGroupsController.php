<?php

namespace App\Http\Controllers\Admin\School;

use App\Models\Item;
use App\Repositories\GroupsRepository;

class AdminSchoolGroupsController extends BaseSimpleAdminSchoolController
{

    /**
     * AdminSchoolGroupsController constructor.
     * @param GroupsRepository $groupsRepository
     */
    public function __construct(GroupsRepository $groupsRepository)
    {
        $this->repository = $groupsRepository;
    }

    function getModelPath(): string
    {
        return 'groups';
    }
}
