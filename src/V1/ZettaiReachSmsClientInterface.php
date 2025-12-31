<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1;

interface ZettaiReachSmsClientInterface
{
    /**
     * CommonMT 送信
     *
     * @param  string  $phoneNumber
     * @param  string  $message
     * @param  string|null  $carrierId
     * @param  string|null  $clientTag
     * @param  string|null  $scheduleTime
     * @param  string|null  $groupTag
     * @return array
     */
    public function sendMethod(
        string $phoneNumber,
        string $message,
        ?string $carrierId = null,
        ?string $clientTag = null,
        ?string $scheduleTime = null,
        ?string $groupTag = null,
    ): array;

    /**
     * CommonMT 予約送信確認
     *
     * @param  string|null  $clientTag
     * @param  string|null  $scheduleTime
     * @param  string|null  $scheduleDate
     * @param  string|null  $groupTag
     * @return array
     */
    public function checkReservationMethod(
        ?string $clientTag = null,
        ?string $scheduleTime = null,
        ?string $scheduleDate = null,
        ?string $groupTag = null,
    ): array;
}
