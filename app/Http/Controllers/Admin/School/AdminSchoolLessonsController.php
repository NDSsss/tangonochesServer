<?php

namespace App\Http\Controllers\Admin\School;

use App\Repositories\GroupsRepository;
use App\Repositories\LessonsRepository;
use Illuminate\Http\Request;


class AdminSchoolLessonsController extends BaseSimpleAdminSchoolController
{


    /**
     * @var GroupsRepository
     */
    private $groupsRepository;

    /**
     * AdminSchoolGroupsController constructor.
     * @param LessonsRepository $lessonsRepository
     * @param GroupsRepository $groupsRepository
     */
    public function __construct(LessonsRepository $lessonsRepository,GroupsRepository $groupsRepository)
    {
        parent::__construct(5);
        $this->repository = $lessonsRepository;
        $this->groupsRepository = $groupsRepository;
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
        $presentTeachers = $request->all()['present_teachers'];
        $presentStudents = $request->all()['present_students'];
        $result = $this->repository->updateLesson($id,$request->all(),$presentTeachers, $presentStudents);
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
