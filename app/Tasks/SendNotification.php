<?php
/**
 * Created by PhpStorm.
 * User: Владислав
 * Date: 08.08.2020
 * Time: 17:27
 */

namespace App\Tasks;


use App\Models\Notification;
use App\Models\Student;
use Illuminate\Support\Facades\Log;

class SendNotification
{
    public static function execute()
    {
        $notifications = Notification::where("date", date("Y-m-d H:i"))->get();
        //Log::info($notifications->count());

        $chunk = 1000;
        $usersCount = Student::get()->count();

        if($notifications){
            //Log::info("notifications");
            foreach ($notifications as $notification){
                $notification['notification_id'] = $notification->id;
                for ($i = 1; $i <= $usersCount; $i += $chunk) {
                    if (($notification['platform'] == 'all' || $notification['platform'] == 'android')) {
                        $androidTokens = Student::whereBetween('id', [$i, $i+($chunk-1)])
                            ->whereHas('notifications', function ($query) use($notification) {
                                $query->where('notification_id', $notification->id);
                            })
                            ->where("platform", "android")
                            ->where('push_token', '!=', NULL)
                            ->where('push_token', '!=', '')
                            ->pluck('push_token')
                            ->chunk(100)
                            ->toArray();
                        //Log::debug('SendNotification', $androidTokens);
                        foreach ($androidTokens as $androidToken) {
                            \App\Jobs\SendNotification::dispatch($notification, $androidToken, 'fcm')->onQueue('notification');
                        }
                    }
                    if (($notification['platform'] == 'all' || $notification['platform'] == 'ios')) {
                        $iosTokens = Student::whereBetween('id', [$i, $i+($chunk-1)])
                            ->whereHas('notifications', function ($query) use($notification) {
                                $query->where('notification_id', $notification->id);
                            })
                            ->where("platform", "ios")
                            ->where('push_token', '!=', NULL)
                            ->where('push_token', '!=', '')
                            ->pluck('push_token')
                            ->chunk(100)
                            ->toArray();
                        foreach ($iosTokens as $iosToken) {
                            \App\Jobs\SendNotification::dispatch($notification, $iosToken, 'apns')->onQueue('notification');
                        }
                    }
                }
            }
        }
    }
}