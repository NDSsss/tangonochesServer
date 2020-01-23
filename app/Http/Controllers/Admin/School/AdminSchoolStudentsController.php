<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;

class AdminSchoolStudentsController extends Controller
{
    /**
     * @var StudentsRepository
     */
    private $studentsRepository;

    /**
     * StudentsController constructor.
     * @param StudentsRepository $studentsRepository
     */
    public function __construct(StudentsRepository $studentsRepository)
    {
        $this->studentsRepository = $studentsRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->studentsRepository->getAllStudentsPaginated();

        return view('admin.school.students.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Student::make();
        return view('admin.school.students.edit', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = $this->studentsRepository->storeStudent($request->input());
        if ($student) {
            return redirect()->route('admin.school.students.edit', [$student->id])
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
        $item = $this->studentsRepository->getStudentById($id);
        if(empty($item)){
            abort(404);
        }
        return view('admin.school.students.edit', compact('item'));
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
        $student = $this->studentsRepository->getStudentById($id);
        if(empty($student)){
            return back()
                ->withErrors(['msg'=>"Преподователь с id={$id} не найден"])
                ->withInput();
        }

        $data = $request->all();
        $result = $student->update($data);
        if($result){
            return redirect()
                ->route('admin.school.students.edit',$student->id)
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
        $result = student::destroy($id);
        if ($result) {
            return redirect()
                ->route('admin.school.students.index')
                ->with(['success' => "Преподователь id[$id] удален"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
