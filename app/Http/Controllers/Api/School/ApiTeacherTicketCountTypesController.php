<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Repositories\TicketCountTypesRepository;
use Illuminate\Http\Request;

class ApiTeacherTicketCountTypesController extends Controller
{
    public function getAllTicketCountTypes(){
        $repository = app(TicketCountTypesRepository::class);
        return response()->json($repository->getAllItems());
    }
}
