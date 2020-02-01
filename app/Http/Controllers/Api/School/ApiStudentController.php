<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\School\ApiGetStudentRequest;
use App\Http\Resources\School\StudentResource;
use App\Http\Resources\School\StudentTicketsResource;
use App\Models\Ticket;
use App\Repositories\StudentsLessonsLeftRepository;
use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;

class ApiStudentController extends BaseApiController
{
    public function getStudentByTicketId(ApiGetStudentRequest $request){
        $studentsRepository = app(StudentsRepository::class);
        $barcodeId = (int)$request->input('barcode_id');
        $student = $studentsRepository->getStudentByBarcodeId($barcodeId);
        return StudentTicketsResource::collection($student->lessonsLeft);
    }
}
