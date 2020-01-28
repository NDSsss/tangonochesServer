<?php

namespace App\Http\Controllers\Admin\School;

use App\Repositories\GroupsRepository;
use App\Repositories\LessonsRepository;
use App\Repositories\StudentsRepository;
use App\Repositories\TeachersRepository;
use Illuminate\Http\Request;


class AdminSchoolLessonsController extends BaseSimpleAdminSchoolController
{


    /**
     * @var GroupsRepository
     */
    private $groupsRepository;
    /**
     * @var StudentsRepository
     */
    private $studentsRepository;
    /**
     * @var TeachersRepository
     */
    private $teachersRepository;

    /**
     * AdminSchoolGroupsController constructor.
     * @param LessonsRepository $lessonsRepository
     * @param GroupsRepository $groupsRepository
     * @param StudentsRepository $studentsRepository
     * @param TeachersRepository $teachersRepository
     */
    public function __construct(LessonsRepository $lessonsRepository,GroupsRepository $groupsRepository,StudentsRepository $studentsRepository,TeachersRepository $teachersRepository)
    {
        parent::__construct(5);
        $this->repository = $lessonsRepository;
        $this->groupsRepository = $groupsRepository;
        $this->studentsRepository = $studentsRepository;
        $this->teachersRepository = $teachersRepository;
    }

    public function create()
    {

        $item = $this->repository->createItem();
        $students = $this->studentsRepository->getAllItems();
        $teachers = $this->teachersRepository->getAllItems();
        $groups = $this->groupsRepository->getAllItems();
        return view($this->currentPath . '.edit',  compact('item', 'students','teachers','groups'));
    }

    public function store(Request $request)
    {
        $group = $this->repository->storeItem($request->input());
        if ($group) {
            return redirect()->route($this->currentPath . '.edit', [$group->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }


    public function edit($id)
    {
        $item = $this->repository->getItemById($id);
        if (empty($item)) {
            abort(404);
        }
        $students = $this->repository->getAllStudentsOfLesson($id);
        $teachers = $this->repository->getAllTeachersOfLesson($id);
        $groups = $this->groupsRepository->getAllItems();
        return view($this->currentPath . '.edit', compact('item', 'students','teachers','groups'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->repository->updateLesson($id,$request->all());
        if ($result) {
            return redirect()
                ->route($this->currentPath . '.edit', $id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }


}
