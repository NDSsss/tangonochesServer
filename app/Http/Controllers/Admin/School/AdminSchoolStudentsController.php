<?php

namespace App\Http\Controllers\Admin\School;

use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminSchoolStudentsController extends BaseSimpleAdminSchoolController
{

    /**
     * StudentsController constructor.
     * @param StudentsRepository $studentsRepository
     */
    public function __construct(StudentsRepository $studentsRepository)
    {
        parent::__construct(0);
        $this->repository = $studentsRepository;
    }

    public function index()
    {
        $items = $this->repository->getAllItems();
        return view($this->currentPath . '.index', compact('items'));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $group = $this->repository->storeItem($data);
        if ($group) {
            return redirect()->route($this->currentPath . '.edit', [$group->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    protected function update(Request $request, $id)
    {
        $group = $this->repository->getItemById($id);
        if (empty($group)) {
            return back()
                ->withErrors(['msg' => "Запись с id={$id} не найден"])
                ->withInput();
        }
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $result = $this->repository->updateItem($data, $id);
        if ($result) {
            return redirect()
                ->route($this->currentPath . '.edit', $group->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }
}
