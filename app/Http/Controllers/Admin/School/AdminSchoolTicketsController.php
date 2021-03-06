<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Requests\Admin\School\AdminSchoolTicketsRequest;
use App\Repositories\StudentsRepository;
use App\Repositories\TeachersRepository;
use App\Repositories\TicketCountTypesRepository;
use App\Repositories\TicketEventTypesRepository;
use App\Repositories\TicketsRepository;

class AdminSchoolTicketsController extends BaseSimpleAdminSchoolController
{

    /**
     * @var StudentsRepository
     */
    private $studentsRepository;
    /**
     * @var TeachersRepository
     */
    private $teachersRepository;
    /**
     * @var TicketEventTypesRepository
     */
    private $ticketEventTypesRepository;
    /**
     * @var TicketCountTypesRepository
     */
    private $ticketCountTypesRepository;

    /**
     * AdminSchoolGroupsController constructor.
     * @param TicketsRepository $repository
     * @param StudentsRepository $studentsRepository
     * @param TeachersRepository $teachersRepository
     * @param TicketEventTypesRepository $ticketEventTypesRepository
     * @param TicketCountTypesRepository $ticketCountTypesRepository
     *
     */
    public function __construct(
        TicketsRepository $repository,
        StudentsRepository $studentsRepository,
        TeachersRepository $teachersRepository,
        TicketEventTypesRepository $ticketEventTypesRepository,
        TicketCountTypesRepository $ticketCountTypesRepository
    )
    {
        parent::__construct(6);
        $this->repository = $repository;
        $this->studentsRepository = $studentsRepository;
        $this->teachersRepository = $teachersRepository;
        $this->ticketEventTypesRepository = $ticketEventTypesRepository;
        $this->ticketCountTypesRepository = $ticketCountTypesRepository;
    }

    public function create()
    {
        $item = $this->repository->createItem();
        $allStudents = $this->studentsRepository->getAllItems();
        $allTeachers = $this->teachersRepository->getAllItems();
        $allEventTypes = $this->ticketEventTypesRepository->getAllItems();
        $allCountTypes = $this->ticketCountTypesRepository->getAllItems();
        return view($this->currentPath . '.edit',
            compact('item',
                'allStudents',
                'allTeachers',
                'allEventTypes',
                'allCountTypes'
            )
        );
    }

    public function store(AdminSchoolTicketsRequest $request)
    {
        return parent::baseStore($request); // TODO: Change the autogenerated stub
    }


    public function edit($id)
    {
        $item = $this->repository->getItemById($id);
        if (empty($item)) {
            abort(404);
        }
        $allStudents = $this->studentsRepository->getAllItems();
        $allTeachers = $this->teachersRepository->getAllItems();
        $allEventTypes = $this->ticketEventTypesRepository->getAllItems();
        $allCountTypes = $this->ticketCountTypesRepository->getAllItems();
        return view($this->currentPath . '.edit',
            compact('item',
                'allStudents',
                'allTeachers',
                'allEventTypes',
                'allCountTypes'
            )
        );
    }

    public function update(AdminSchoolTicketsRequest $request, $id)
    {
//        return parent::baseUpdate($request, $id); // TODO: Change the autogenerated stub
    }


}
