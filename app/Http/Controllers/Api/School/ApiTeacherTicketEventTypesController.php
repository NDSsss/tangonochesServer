<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Repositories\TicketEventTypesRepository;

class ApiTeacherTicketEventTypesController extends Controller
{
    public function getAllTicketEventTypes()
    {
        $repository = app(TicketEventTypesRepository::class);
        return response()->json($repository->getAllItems());
    }
}
