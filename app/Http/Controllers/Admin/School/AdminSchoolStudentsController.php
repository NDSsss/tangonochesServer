<?php

namespace App\Http\Controllers\Admin\School;

use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        return parent::baseStore($request);
    }

    protected function update(Request $request, $id)
    {
        return parent::baseUpdate($request, $id);
    }
}
