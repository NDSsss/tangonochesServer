<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Item;
use App\Repositories\GroupsRepository;
use Illuminate\Http\Request;

class AdminSchoolGroupsController extends Controller
{

    /**
     * @var GroupsRepository
     */
    private $groupsRepository;

    /**
     * AdminSchoolGroupsController constructor.
     * @param GroupsRepository $groupsRepository
     */
    public function __construct(GroupsRepository $groupsRepository)
    {
        $this->groupsRepository = $groupsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->groupsRepository->getAllItemsPaginated();

        return view('admin.school.groups.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Group::make();
        $AllItems = $this->groupsRepository->getAllItems();
        return view('admin.school.groups.edit', compact('item','AllItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = $this->groupsRepository->storeItem($request->input());
        if ($group) {
            return redirect()->route('admin.school.groups.edit', [$group->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id, __METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->groupsRepository->getItemById($id);
        if(empty($item)){
            abort(404);
        }
        $AllItems = $this->groupsRepository->getAllItems();
        return view('admin.school.groups.edit', compact('item','AllItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $group = $this->groupsRepository->getItemById($id);
        if(empty($group)){
            return back()
                ->withErrors(['msg'=>"Преподователь с id={$id} не найден"])
                ->withInput();
        }

        $data = $request->all();
        $result = $group->update($data);
        if($result){
            return redirect()
                ->route('admin.school.groups.edit',$group->id)
                ->with(['success'=>'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg'=>'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->groupsRepository->destroyItem($id);
        if ($result) {
            return redirect()
                ->route('admin.school.groups.index')
                ->with(['success' => "Преподователь id[$id] удален"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
