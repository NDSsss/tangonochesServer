<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\School\ApiGetStudentRequest;
use App\Http\Resources\School\StudentTicketsResource;
use App\Repositories\StudentsRepository;

class ApiStudentController extends BaseApiController
{
    public function getStudentByTicketId(ApiGetStudentRequest $request)
    {
        $studentsRepository = app(StudentsRepository::class);
        $barcodeId = (int)$request->input('barcode_id');
        $student = $studentsRepository->getStudentByBarcodeId($barcodeId);
        $result = StudentTicketsResource::collection($student->lessonsLeft);
        return $result;
    }
}
