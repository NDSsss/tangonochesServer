<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Requests\Api\School\ApiGetStudentRequest;
use App\Http\Resources\School\StudentTicketsResource;
use App\Repositories\StudentsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiStudentController extends BaseApiController
{
    private $studentsRepository;

    public function __construct(StudentsRepository $studentsRepository)
    {
        $this->studentsRepository = $studentsRepository;
    }

    public function login (Request $request)
    {
        $password = $request->get('password');
        $bar_code = $request->get('bar_code');
        if($password && $bar_code){
            $student = $this->studentsRepository->getStudentByBarcodeId($bar_code);
            if(isset($student) && $student->password !== null && Hash::check($password, $student->password)){
                $api_token = Str::random(60);
                $this->studentsRepository->updateField($student->id, 'api_token', $api_token);
                return response()->json(['api_token' => $api_token], 200);
            }
            else return response()->json(['message' => 'Неправильные логин или пароль !'], 401);
        }else
            return response()->json(['message' => 'Неправильные логин или пароль !'], 401);
    }

    public function getNotification(Request $request, $id)
    {
        $push_token = $request->get("push_token");
        $platform = $request->get("platform");

        $student = $this->studentsRepository->getStudentByBarcodeId($id);
        if(isset($student) && $push_token && $platform){
            $this->studentsRepository->updateField($student->id, 'push_token', $push_token);
            $this->studentsRepository->updateField($student->id, 'platform', $platform);
            return response()->json(['message' => "Успешно !"], 200);
        }else return response()->json(['message' => 'Неверный запрос !'], 400);
    }

    public function getStudentByTicketId(ApiGetStudentRequest $request)
    {
        $studentsRepository = app(StudentsRepository::class);
        $barcodeId = (int)$request->input('barcode_id');
        $student = $studentsRepository->getStudentByBarcodeId($barcodeId);
        $result = StudentTicketsResource::collection($student->lessonsLeft);
        return $result;
    }

    public function getStudentInfoByTicketId(ApiGetStudentRequest $request)
    {
        $studentsRepository = app(StudentsRepository::class);
        $barcodeId = (int)$request->input('barcode_id');
        $student = $studentsRepository->getStudentByBarcodeId($barcodeId);
        $tickets = StudentTicketsResource::collection($student->lessonsLeft);
        $points = $student->points;
        $result = [];
        $result['tickets'] = $tickets;
        $result['points'] = $points;
        $resultObject = (object)$result;
        return response()->json($resultObject);
    }
}
