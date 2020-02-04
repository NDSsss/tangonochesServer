<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Repositories\StudentsLessonsLeftRepository;
use App\Repositories\StudentsRepository;
use App\Repositories\TicketEventTypesRepository;
use Illuminate\Http\Request;

class StudentsLessonsLeftController extends BaseAdminSchoolController
{
    /**
     * @var StudentsLessonsLeftRepository
     */
    private $studentsLessonsLeftRepository;
    /**
     * @var StudentsRepository
     */
    private $studentsRepository;
    /**
     * @var TicketEventTypesRepository
     */
    private $ticketEventTypeRepository;


    private $currentPath = 'admin.school.studentsLessonsLeft';

    /**
     * StudentsLessonsLeftController constructor.
     * @param StudentsLessonsLeftRepository $studentsLessonsLeftRepository
     * @param StudentsRepository $studentsRepository
     * @param TicketEventTypesRepository $ticketEventTypeRepository
     */
    public function __construct(
        StudentsLessonsLeftRepository $studentsLessonsLeftRepository,
        StudentsRepository $studentsRepository,
        TicketEventTypesRepository $ticketEventTypeRepository
    )
    {
        $this->studentsLessonsLeftRepository = $studentsLessonsLeftRepository;
        $this->studentsRepository = $studentsRepository;
        $this->ticketEventTypeRepository = $ticketEventTypeRepository;
        parent::__construct();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = $this->studentsLessonsLeftRepository->getAllItemsPaginated();
        return view($this->currentPath . '.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = $this->studentsLessonsLeftRepository->createItem();
        $allStudents = $this->studentsRepository->getAllItems();
        $allEventTypes = $this->ticketEventTypeRepository->getAllItems();
        return view($this->currentPath . '.edit', compact('item', 'allStudents','allEventTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = $this->studentsLessonsLeftRepository->storeItem($request->input());
        if ($group) {
            return redirect()->route($this->currentPath . '.edit', [$group->id])
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
        $item = $this->studentsLessonsLeftRepository->getItemById($id);
        if (empty($item)) {
            abort(404);
        }
        $allStudents = $this->studentsRepository->getAllItems();
        $allEventTypes = $this->ticketEventTypeRepository->getAllItems();
        return view($this->currentPath . '.edit', compact('item', 'allStudents','allEventTypes'));
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
        $group = $this->studentsLessonsLeftRepository->getItemById($id);
        if (empty($group)) {
            return back()
                ->withErrors(['msg' => "Запись с id={$id} не найден"])
                ->withInput();
        }
        $data = $request->all();
        $result = $this->studentsLessonsLeftRepository->updateItem($data, $id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->studentsLessonsLeftRepository->destroyItem($id);
        if ($result) {
            return redirect()
                ->route($this->currentPath . '.index')
                ->with(['success' => "Преподователь id[$id] удален"]);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
