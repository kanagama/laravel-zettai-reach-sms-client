<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Request\SendRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\SendDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\SendDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Request\CheckReservationRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\CheckReservationDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\CheckReservationDomainInterface;

/**
 * @package Kanagama\ZettaiReachSmsClient\V1
 *
 * @method array send(string $phoneNumber, string $message, ?string $carrierId = null, ?string $clientTag = null, ?string $scheduleTime = null, ?string $groupTag = null) CommonMT 送信
 * @method static array send(string $phoneNumber, string $message, ?string $carrierId = null, ?string $clientTag = null, ?string $scheduleTime = null, ?string $groupTag = null) CommonMT 送信
 * @method array checkReservation(?string $clientTag = null, ?string $scheduleTime = null, ?string $scheduleDate = null, ?string $groupTag = null) CommonMT 予約送信確認
 * @method static array checkReservation(?string $clientTag = null, ?string $scheduleTime = null, ?string $scheduleDate = null, ?string $groupTag = null) CommonMT 予約送信確認
 */
final class ZettaiReachSmsClient implements ZettaiReachSmsClientInterface
{
    /**
     * @param  SendDomain  $sendDomain
     * @param  CheckReservationDomain  $checkReservationDomain
     */
    public function __construct(
        private readonly SendDomainInterface $sendDomain,
        private readonly CheckReservationDomainInterface $checkReservationDomain,
    ) {
    }

    /**
     * 静的呼び出しハンドラ
     *
     * @param  string  $name
     * @param  array  $arguments
     * @return array
     */
    public static function __callStatic(string $name, array $arguments): array
    {
        /** @var ZettaiReachSmsClient */
        $instance = app()->make(ZettaiReachSmsClientInterface::class);

        return $instance->{$name . 'Method'}(...$arguments);
    }

    /**
     * 動的呼び出しハンドラ
     *
     * @param  string  $name
     * @param  array  $arguments
     * @return array
     */
    public function __call(string $name, array $arguments): array
    {
        return self::__callStatic($name, $arguments);
    }

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
    ): array {
        $sendRequest = new SendRequest(
            phoneNumber: $phoneNumber,
            message: $message,
            carrierId: $carrierId,
            clientTag: $clientTag,
            scheduleTime: $scheduleTime,
            groupTag: $groupTag,
        );

        return $this->sendDomain->execute($sendRequest);
    }

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
    ): array {
        $checkReservationRequest = new CheckReservationRequest(
            clientTag: $clientTag,
            scheduleTime: $scheduleTime,
            scheduleDate: $scheduleDate,
            groupTag: $groupTag,
        );

        return $this->checkReservationDomain->execute($checkReservationRequest);
    }
}
