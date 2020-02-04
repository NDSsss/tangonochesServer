<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Teacher\GetTokenRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiTeacherAuthController extends Controller
{

    public function getToken(GetTokenRequest $request){
        if(\Auth::attempt($request->input())){
            return Response::create(['api_token'=>\Auth::user()->api_token], 200);
        } else {
            return Response::create(['error'=>true], 401);
        }
    }
}
