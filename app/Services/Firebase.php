<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use PushNotification;

class Firebase
{
    public static function send($notification_id, $title, $message, $tokens)
    {
        //Log::info("Firebase");
        PushNotification::setService('fcm')
            ->setMessage([
                'notification' => [
                    'title' => $title,
                    'body' => $message,
                    'sound' => 'default'
                ],
                'data' => [
                    'message_title' => $title,
                    'message_body' => $message,
                    'notification_id' => $notification_id,
                    'type' => 'general',
                    'object' => null,
                ],
                'content-available' => true,
                'content-mutable' => true,
            ])
            ->setApiKey(config('pushnotification.fcm.apiKey'))
            ->setDevicesToken($tokens)
            ->send();
    }
}