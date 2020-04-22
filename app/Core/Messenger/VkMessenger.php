<?php


namespace App\Messenger;


use App\MyLogger;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class VkMessenger
{

    public function sendMessageToUser($user, $message)
    {
        return $this->sendMessage($user, $message);
    }

    public function sendMessageToUserWithKeyboard($user, $message, $triggerWords, $addMainScreenButton = true)
    {
        return $this->sendMessage($user, $message, $this->generateKeyboardJson($triggerWords, $addMainScreenButton));
    }

    private function sendMessage($user, $message, $keyboardJson = null)
    {
        $randomId = $user->random_id;
        $gluszzClient = new Client([
            'base_uri' => 'https://api.vk.com/method/',
        ]);
        $query = [
            'query' => [
                'access_token' => env('VK_GROUP_TOKEN'),
                'v' => '5.103',
                'random_id' => $randomId,
                'user_id' => $user->vk_user_id,
                'message' => $message,
            ]
        ];
        if ($keyboardJson != null) {
            $query['query']['keyboard'] = $keyboardJson;
        }
        $get = $gluszzClient->get('messages.send', $query);
        MyLogger::LOG('VK MESSENGER after get $vk_user_id' . MyLogger::JSON_ENCODE($user->vk_user_id)
                .' query = '.MyLogger::JSON_ENCODE($query)
                .' CODE = '.$get->getStatusCode()
            . ' $get->getBody()->getContents() ' . MyLogger::JSON_ENCODE($get->getBody()->getContents()));
        if ($get->getStatusCode() == 200) {
            $user->update(['random_id' => $user->random_id + 1]);
            return true;
        } else {
            return false;
        }
    }


    private function generateKeyboardJson(Collection $triggerWords, $addMainScreenButton = true)
    {
        $possibleStates = $triggerWords->filter(function ($value, $key) {
            return $value['state'] != 'main_screen';
        });
        $buttons = [];
        foreach ($possibleStates as $currState) {
            switch ($currState['type']) {
                case 'text':
                    $buttons[] = [[
                        'action' => [
                            'type' => $currState['type'],
                            'label' => $currState['word']
                        ],
                        'color' => 'secondary'
                    ]];
                    break;
                case 'location':
                    $buttons[] = [[
                        'action' => [
                            'type' => $currState['type']
                        ]
                    ]];
                    break;
            }

        }
        if ($addMainScreenButton) {
            $buttons[] = [[
                'action' => [
                    'type' => 'text',
                    'label' => __('trigger_words.start_1')
                ],
                'color' => 'secondary'
            ]];
        }
        $buttonsObject = [
            'one_time' => false,
            'buttons' => $buttons,
            'inline' => false
        ];
        $preparedBtnsJson = MyLogger::JSON_ENCODE($buttonsObject);
        MyLogger::LOG('generateKeyboardJson $preparedBtnsJson' . $preparedBtnsJson);
        return $preparedBtnsJson;
    }
}
