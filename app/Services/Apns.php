<?php

namespace App\Services;

//https://laracasts.com/discuss/channels/laravel/recommendation-please-recommend-the-best-notification-package?page=0
class Apns
{
    public static function send($notification_id, $title, $message, $tokens)
    {
        $url = "https://fcm.googleapis.com/fcm/send";
        $header = [
            'authorization: key=' . 'oR7sBORMfupWaPsh1pDC62tVgt1I2LDFOsJzMhy+E0U=',
            'content-type: application/json'
        ];

        $ch = curl_init();

        foreach ($tokens as $token) {
            $postdata = '{
                "to" : "' . $token . '",
                    "notification" : {
                        "title":"' . $title . '",
                        "text" : "' . $message . '"
                    },
                "data" : {
                    "id" : "'.$notification_id.'",
                    "title":"' . $title . '",
                    "description" : "' . $message . '",
                    "text" : "' . $message . '",
                    "is_read": 0
                  }
            }';
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

            curl_exec($ch);
        }

        curl_close($ch);
    }

}