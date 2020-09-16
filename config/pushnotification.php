<?php
/**
 * @see https://github.com/Edujugon/PushNotification
 */

return [
    'gcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'My_ApiKey',
    ],
    'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'AAAAIrALqH0:APA91bFiotGaPtGC6kNEjBWGRFZq8jJkSDUH_kqOcYAB582EufnrjMJa71IYQRDPPz1GHmt3l4xQHLt-lccva0i-ITQiRrUCDqc-w7oBJZJZZr4Rkt-4TrW5bSXTrD0O_JJgjkpKzfme',
    ],
    'apn' => [
        'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
        'passPhrase' => 'secret', //Optional
        'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
        'dry_run' => true,
    ],
];
