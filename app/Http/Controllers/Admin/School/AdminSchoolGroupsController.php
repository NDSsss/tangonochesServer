<?php

namespace App\Http\Controllers\Admin\School;

use App\Models\Item;
use App\Repositories\GroupsRepository;
use App\Repositories\TicketEventTypesRepository;

class AdminSchoolGroupsController extends BaseSimpleAdminSchoolController
{

    /**
     * @var TicketEventTypesRepository
     */
    private $ticketEventTypesRepository;
    /**
     * AdminSchoolGroupsController constructor.
     * @param GroupsRepository $groupsRepository
     * @param TicketEventTypesRepository $ticketEventTypesRepository
     */
    public function __construct(GroupsRepository $groupsRepository, TicketEventTypesRepository $ticketEventTypesRepository)
    {
        parent::__construct(2);
        $this->repository = $groupsRepository;
        $this->ticketEventTypesRepository = $ticketEventTypesRepository;
    }

    public function create()
    {
        $item = $this->repository->createItem();
        $allEventTypes = $this->ticketEventTypesRepository->getAllItems();
        return view($this->currentPath . '.edit', compact('item', 'allEventTypes'));
    }


    public function edit($id)
    {
        $item = $this->repository->getItemById($id);
        if (empty($item)) {
            abort(404);
        }
        $allEventTypes = $this->ticketEventTypesRepository->getAllItems();
        return view($this->currentPath . '.edit', compact('item', 'allEventTypes'));
    }


}
