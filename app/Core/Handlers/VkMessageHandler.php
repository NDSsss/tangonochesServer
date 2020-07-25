<?php


namespace App\Handlers;


use App\Enums\StatesNamesEnum;
use App\Enums\StateTypesEnum;
use App\Managers\PossibleStatesManager;
use App\Managers\StatesManager;
use App\Managers\TriggerWordsManager;
use App\Messenger\VkMessenger;
use App\Models\Student;
use App\MyLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class VkMessageHandler
{

    /**
     * @var StatesHandler
     */
    private $statesHandler;
    /**
     * @var VkMessenger
     */
    private $vkMessenger;
    /**
     * @var StatesManager
     */
    private $statesManager;
    /**
     * @var PossibleStatesManager
     */
    private $possibleStatesManager;
    /**
     * @var TriggerWordsManager
     */
    private $triggerWordsManager;

    /**
     * @var Student
     */
    private $student;

    /**
     * VkMessageHandler constructor.
     * @param StatesHandler $statesHandler
     * @param VkMessenger $vkMessenger
     * @param StatesManager $statesManager
     * @param PossibleStatesManager $possibleStatesManager
     * @param TriggerWordsManager $triggerWordsManager
     */
    public function __construct(
        StatesHandler $statesHandler,
        VkMessenger $vkMessenger,
        StatesManager $statesManager,
        PossibleStatesManager $possibleStatesManager,
        TriggerWordsManager $triggerWordsManager
    )
    {
        $this->statesHandler = $statesHandler;
        $this->vkMessenger = $vkMessenger;
        $this->statesManager = $statesManager;
        $this->possibleStatesManager = $possibleStatesManager;
        $this->triggerWordsManager = $triggerWordsManager;
    }


    function handleMessageRequest(Request $request)
    {
        $object = $request->input('object');
        $vkUserId = $object['message']['from_id'];
        $foundUser = User::query()->where('vk_user_id', $vkUserId)->get()->first();
        $message = $object['message'];
        if ($foundUser == null) {
            $newUser = new User();
            $newUser->vk_user_id = $vkUserId;
            if ($newUser->save()) {
                $foundUser = User::query()->where('vk_user_id', $vkUserId)->get()->first();
            }
        }
        MyLogger::LOG('$foundUser ' . MyLogger::JSON_ENCODE($foundUser));
        $this->user = $foundUser;
        if ($this->statesHandler->isStartTriggerWord($message['text'])) {
            $this->moveUserToState(StatesNamesEnum::$MAIN_SCREEN);
        } else {
            switch ($foundUser->state) {
                case StatesNamesEnum::$HELP:
                    if (key_exists('geo', $message)) {
                        $this->handleGeoMessage($message['geo']);
                        break;
                    }
                    $this->handleUserMessage($message);
                    break;
                case StatesNamesEnum::$HELP_CHAT_WAIT_LINK:
                    if (filter_var($message['text'], FILTER_VALIDATE_URL)) {
                        $this->saveChatLink($message['text']);
                    } else {
                        $this->moveUserToState(StatesNamesEnum::$HELP_CHAT_WAIT_LINK_VALIDATION_ERROR);
                    }
                    break;
                case StatesNamesEnum::$HELP_USER_ADDRESS_INPUT:
                    if (key_exists('geo', $message)) {
                        $this->handleGeoMessage($foundUser, $message['geo']);
                        break;
                    } else {
                        $this->handleTextAddressInput($message['text']);
                    }
                    break;
                default:
                    $this->handleUserMessage($message);
                    break;
            }
        }
    }

    function handleUserMessage($receivedMessage)
    {
        $receivedMessage = $receivedMessage['text'];
        MyLogger::LOG('handleUserMessage $vk_user_id ' . MyLogger::JSON_ENCODE($this->user->vk_user_id) . ' $receivedMessage ' . MyLogger::JSON_ENCODE($receivedMessage));
        $triggerWords = $this->generateTriggerWordsForState($this->user->state);
        $nexStates = $triggerWords->where('word', $receivedMessage);
        MyLogger::LOG('$triggerWords ' . MyLogger::JSON_ENCODE($triggerWords) . ' $nexState. ' . MyLogger::JSON_ENCODE($nexStates));
        if ($nexStates->isNotEmpty()) {
            $this->moveUserToState($nexStates->first()['state']);
        } else {
            MyLogger::LOG('handleUserMessage No next state trigger word $user' . MyLogger::JSON_ENCODE($this->user) . ' $receivedMessage ' . MyLogger::JSON_ENCODE($receivedMessage));
            $this->vkMessenger->sendMessageToUserWithKeyboard(
                $this->user,
                __('messages.unknown_command'),
                $this->generateTriggerWordsForState($this->user->state),
                $this->user->state != StatesNamesEnum::$MAIN_SCREEN
            );
        }
    }

    private function moveUserToState($newState, $messagesArgs = [])
    {
        MyLogger::LOG(
            'moveUserToState $vk_user_id ' . MyLogger::JSON_ENCODE($this->user->vk_user_id)
            .' $current_state' . MyLogger::JSON_ENCODE($this->user->state)
            . ' $newState ' . MyLogger::JSON_ENCODE($newState)
        );
        $newStateFull = $this->statesManager->getStates()->where('state', '=', $newState)->first();
        $stateMessages = $newStateFull['state_messages'];
        $stateMessagesCount = count($newStateFull['state_messages']);
        if ($stateMessagesCount > 1) {
            for ($i = 0; $i < $stateMessagesCount - 1; $i++) {
                $this->vkMessenger->sendMessageToUser($this->user, __('state_messages.' . $newStateFull['state_messages'][$i], $messagesArgs));
            }
            $messageResToSend = $newStateFull['state_messages'][$stateMessagesCount - 1];
        } else {
            $messageResToSend = $newStateFull['state_messages'][0];
        }
        switch ($newStateFull['state_type']) {
            case StateTypesEnum::$SEND_MESSAGE_AND_CHANGE_STATE:
                if ($this->vkMessenger->sendMessageToUserWithKeyboard(
                    $this->user,
                    __('state_messages.' . $messageResToSend, $messagesArgs),
                    $this->generateTriggerWordsForState($newState),
                    $newState != StatesNamesEnum::$MAIN_SCREEN)
                ) {
                    $this->user->state = $newState;
                    $this->user->save();
                };
                break;
            case StateTypesEnum::$SEND_MESSAGE_AND_GO_TO_MAIN:
                if ($this->vkMessenger->sendMessageToUserWithKeyboard(
                    $this->user,
                    __('state_messages.' . $messageResToSend, $messagesArgs),
                    $this->generateTriggerWordsForState(StatesNamesEnum::$MAIN_SCREEN),
                    false)
                ) {
                    $this->user->state = 'main_screen';
                    $this->user->save();
                };
                break;
            case StateTypesEnum::$JUST_SEND_MESSAGE:
                if ($this->vkMessenger->sendMessageToUser($this->user, __('state_messages.' . $messageResToSend, $messagesArgs))) {
                    $this->user->save();
                };
                break;
            case StateTypesEnum::$MAKE_SOME_ACTIONS:
                $this->handleMakeSomeActionState($newStateFull);
                break;
            default:
                $this->handleInnerError();
                break;
        }
    }

    private function generateTriggerWordsForState($state): Collection
    {
        $userPossibleStates = $this->possibleStatesManager->getPossibleStates()
            ->where('current_state', '=', $state)
            ->map(function ($item, $key) {
                return $item['possible_state'];
            })
            ->toArray();
        $triggerWords = $this->triggerWordsManager->getTriggerWords()
            ->whereIn('state', $userPossibleStates);
        return $triggerWords;
    }

    private function handleMakeSomeActionState($state)
    {
        switch ($state['state']) {
            case StatesNamesEnum::$SUBSCRIBE_INIT:

                break;
            default:
                $this->handleInnerError();
                break;
        }
    }

    private function handleInnerError()
    {
        $this->moveUserToState(StatesNamesEnum::$REQUEST_ERROR);
    }


}
