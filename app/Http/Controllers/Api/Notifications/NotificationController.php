<?php

namespace App\Http\Controllers\Api\Notifications;

use App\Http\Controllers\Controller;
use App\Repositories\NotificationRepo;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function create(Request $request)
    {
        $requestData = $request->all();

        $notificationData = [
            'title' => $requestData['title'],
            'prev_text' => strip_tags($requestData['prev_text']),
            'text' => strip_tags($requestData['text']),
            'date' => $requestData['date'],
            'platform' => $requestData['platform']
        ];
        //'object' => null,
        //'push_object' => null,

        NotificationRepo::create($notificationData);
    }
}