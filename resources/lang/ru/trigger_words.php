<?php

use App\Enums\StatesNamesEnum;

return [
    'start_1' => 'Начало',
    'start_2' => 'Начало',
    'start_3' => 'Начать',
    'start_4' => 'Start',
    'start_5' => 'начало',
    'start_6' => 'начало',
    'start_7' => 'начать',
    'start_8' => 'start',

    StatesNamesEnum::$REMINDER => 'Памятка о коронавирусе',
    StatesNamesEnum::$VOLUNTEERS => 'Волонтерам',
    StatesNamesEnum::$SUBSCRIBE_INIT => 'Подписаться',

    StatesNamesEnum::$SUBSCRIBE_INIT_ACCEPT => 'Подписаться',
    StatesNamesEnum::$SUBSCRIBE_INIT_UN_SUBSCRIBING_REQUEST => 'Отписаться',
    StatesNamesEnum::$SUBSCRIBE_INIT_SUBSCRIBING_REQUEST => 'Подписаться',

    StatesNamesEnum::$HELP => 'Ближайшие чаты',
    StatesNamesEnum::$HELP_USER_ADDRESS_INPUT => 'Ввести адрес текстом',

    StatesNamesEnum::$HELP_CHAT_WAIT_LINK => 'Добавить ссылку на чат',

    StatesNamesEnum::$HELP_USER_ADDRESS_INPUT_USER_ACCEPT => 'Все верно',
];
