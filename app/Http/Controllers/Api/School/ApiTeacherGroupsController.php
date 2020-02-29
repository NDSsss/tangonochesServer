<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Repositories\GroupsRepository;
use Illuminate\Http\Request;

class ApiTeacherGroupsController extends Controller
{
    public function getAllGroups(){
        $repository = app(GroupsRepository::class);
        return response()->json($repository->getAllItems());
    }
}
