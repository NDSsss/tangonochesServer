<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

abstract class BaseSimpleAdminSchoolController extends BaseAdminSchoolController
{
    /**
     * @var BaseRepository
     */
    protected $repository;

    abstract function getModelPath():string;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->repository->getAllItemsPaginated();

        return view('admin.school..'.$this->getModelPath().'..index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = $this->repository->createItem();
        $AllItems = $this->repository->getAllItems();
        return view('admin.school.'.$this->getModelPath().'.edit', compact('item', 'AllItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = $this->repository->storeItem($request->input());
        if ($group) {
            return redirect()->route('admin.school.'.$this->getModelPath().'.edit', [$group->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id, __METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->repository->getItemById($id);
        if (empty($item)) {
            abort(404);
        }
        $AllItems = $this->repository->getAllItems();
        return view('admin.school.'.$this->getModelPath().'.edit', compact('item', 'AllItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = $this->repository->getItemById($id);
        if (empty($group)) {
            return back()
                ->withErrors(['msg' => "Преподователь с id={$id} не найден"])
                ->withInput();
        }

        $data = $request->all();
        $result = $group->update($data);
        if ($result) {
            return redirect()
                ->route('admin.school.'.$this->getModelPath().'.edit', $group->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->repository->destroyItem($id);
        if ($result) {
            return redirect()
                ->route('admin.school.'.$this->getModelPath().'.index')
                ->with(['success' => "Преподователь id[$id] удален"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
