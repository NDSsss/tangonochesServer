<?php

namespace App\Http\Controllers\Admin\School;


use App\Repositories\NotificationRepo;
use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;

class AdminSchoolNotificationController extends BaseSimpleAdminSchoolController
{
    private $studentsRepository;

    public function __construct(NotificationRepo $notification, StudentsRepository $studentsRepository)
    {
        parent::__construct(10);
        $this->repository = $notification;
        $this->studentsRepository = $studentsRepository;
    }

    public function create()
    {
        $item = $this->repository->createItem();
        $allNotifications = $this->repository->getAllItems();
        $students = $this->studentsRepository->getAllItems();
        return view($this->currentPath . '.edit', compact('item', 'allNotifications', 'students'));
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
        //return parent::baseStore($request);
    }

    public function edit($id)
    {
        $item = $this->repository->getItemById($id);
        if (empty($item)) {
            abort(404);
        }
        $allNotifications = $this->repository->getAllItems();
        $students = $this->repository->getAllStudentsOfNotification($id);
        return view($this->currentPath . '.edit', compact('item', 'allNotifications', 'students'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->repository->update($id, $request->all());
        if ($result) {
            return redirect()
                ->route($this->currentPath . '.edit', $id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
        //return parent::baseUpdate($request, $id);
    }

}