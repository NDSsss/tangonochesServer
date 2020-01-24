<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Models\Student;
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
        $this->repository = $studentsRepository;
    }

    function getModelPath(): string
    {
        return 'students';
    }
}
