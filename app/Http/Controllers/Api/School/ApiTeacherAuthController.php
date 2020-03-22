<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\Teacher\GetTokenRequest;
use Illuminate\Http\Response;

class ApiTeacherAuthController extends BaseApiController
{

    public function getToken(GetTokenRequest $request)
    {
        if (\Auth::attempt($request->input())) {
            return Response::create(['api_token' => \Auth::user()->api_token], 200);
        } else {
            return Response::create(['error' => true], 401);
        }
    }
}
