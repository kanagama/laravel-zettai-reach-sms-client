<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1;

interface ZettaiReachSmsClientInterface
{
    /**
     * CommonMT 送信
     *
     * @param  string  $phoneNumbe
     * @param  string  $message
     * @param  string|null  $carrierId
     * @param  string|null  $clientTag
     * @param  string|null  $scheduleTime
     * @param  string|null  $groupTag
     * @return void
     */
    public function sendMethod(
        string $phoneNumber,
        string $message,
        ?string $carrierId = null,
        ?string $clientTag = null,
        ?string $scheduleTime = null,
        ?string $groupTag = null,
    ): array;
}
