<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\School\TeacherCreateRequest;
use App\Models\Teacher;
use App\Repositories\TeachersRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminSchoolTeachersController extends BaseAdminSchoolController
{

    /**
     * @var TeachersRepository
     */
    private $teachersRepository;

    /**
     * AdminSchoolTeachersController constructor.
     * @param TeachersRepository $teachersRepository
     */
    public function __construct(TeachersRepository $teachersRepository)
    {
        $this->teachersRepository = $teachersRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $paginator = $this->teachersRepository->getAllTeachersPaginated();

        return view('admin.school.teachers.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $item = Teacher::make();
        $allTeachers = $this->teachersRepository->getAllTeachers();
        return view('admin.school.teachers.edit', compact('item','allTeachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherCreateRequest $request
     * @return RedirectResponse
     */
    public function store(TeacherCreateRequest $request)
    {
        $teacher = $this->teachersRepository->storeTeacher($request->input());
        if ($teacher) {
            return redirect()->route('admin.school.teachers.edit', [$teacher->id])
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->teachersRepository->getTeacherById($id);
        if(empty($item)){
            abort(404);
        }
        $allTeachers = $this->teachersRepository->getAllTeachers();
        return view('admin.school.teachers.edit', compact('item','allTeachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $teacher = $this->teachersRepository->getTeacherById($id);
        if(empty($teacher)){
            return back()
                ->withErrors(['msg'=>"Преподователь с id={$id} не найден"])
                ->withInput();
        }

        $data = $request->all();
        $result = $teacher->update($data);
        if($result){
            return redirect()
                ->route('admin.school.teachers.edit',$teacher->id)
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
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $result = Teacher::destroy($id);
        if ($result) {
            return redirect()
                ->route('admin.school.teachers.index')
                ->with(['success' => "Преподователь id[$id] удален"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
