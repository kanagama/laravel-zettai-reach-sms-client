<?php
declare(strict_types=1);

return [
    'token'           => env('ZETTAI_REACH_SMS_TOKEN', ''),
    'client_id'       => env('ZETTAI_REACH_SMS_CLIENT_ID', ''),
    'timeout_seconds' => (int) env('ZETTAI_REACH_SMS_TIMEOUT_SECONDS', 10),
];
