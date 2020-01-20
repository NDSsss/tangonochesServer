<?php

namespace App\Http\Controllers\vk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VkApiController extends BaseVkController
{

    public function confirmCode()
    {
        return env('VK_CONFIRM_CODE');
    }

    public function postRequest(Request $request)
    {
        switch ($request->type) {
            case 'group_join':
                return $this->confirmCode();
            case 'message_new':
                $request_params = array(
                    'user_id' => $request->object['user_id'],
                    //'message' => getPersonNameById(4),
                    'message' => 'ok',
                    'access_token' => env('VK_ACCESS_TOKEN'),
                    'v' => '5.69'
                );
                file_get_contents("https://api.vk.com/method/messages.send?" . http_build_query($request_params));
                echo 'ok';
            default:
                dd($request);
        }
    }
}
