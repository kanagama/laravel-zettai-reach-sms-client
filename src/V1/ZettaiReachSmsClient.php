<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Request\SendRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\SendDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\SendDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Request\CheckReservationRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\CheckReservationDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\CheckReservationDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Request\CancelReservationRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\CancelReservationDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\CancelReservationDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Request\CancelReservationAllRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\CancelReservationAllDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\CancelReservationAllDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Request\StatusRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\StatusDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\StatusDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Request\ShortenUrlRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\ShortenUrlDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\ShortenUrlDomainInterface;

/**
 * @package Kanagama\ZettaiReachSmsClient\V1
 *
 * @method array send(string $phoneNumber, string $message, ?string $carrierId = null, ?string $clientTag = null, ?string $scheduleTime = null, ?string $groupTag = null) CommonMT 送信
 * @method static array send(string $phoneNumber, string $message, ?string $carrierId = null, ?string $clientTag = null, ?string $scheduleTime = null, ?string $groupTag = null) CommonMT 送信
 * @method array checkReservation(?string $clientTag = null, ?string $scheduleTime = null, ?string $scheduleDate = null, ?string $groupTag = null) CommonMT 予約送信確認
 * @method static array checkReservation(?string $clientTag = null, ?string $scheduleTime = null, ?string $scheduleDate = null, ?string $groupTag = null) CommonMT 予約送信確認
 * @method array cancelReservation(?string $clientTag = null, ?string $scheduleTime = null, ?string $scheduleDate = null, ?string $groupTag = null) CommonMT 予約送信キャンセル
 * @method static array cancelReservation(?string $clientTag = null, ?string $scheduleTime = null, ?string $scheduleDate = null, ?string $groupTag = null) CommonMT 予約送信キャンセル
 * @method array cancelReservationAll(string $scheduleDate) CommonMT 予約送信一括キャンセル
 * @method static array cancelReservationAll(string $scheduleDate) CommonMT 予約送信一括キャンセル
 * @method array status(string $clientTag) CommonMT ステータス取得
 * @method static array status(string $clientTag) CommonMT ステータス取得
 * @method array shortenUrl(string $longUrl, ?string $domain = null) ショート URL 登録
 * @method static array shortenUrl(string $longUrl, ?string $domain = null) ショート URL 登録
 */
final class ZettaiReachSmsClient implements ZettaiReachSmsClientInterface
{
    /**
     * CommonMT 送信
     * CommonMT 予約送信確認
     * CommonMT 予約送信キャンセル
     * CommonMT 予約送信一括キャンセル
     * CommonMT ステータス取得
     * ショート URL 登録
     *
     * @param  SendDomain  $sendDomain
     * @param  CheckReservationDomain  $checkReservationDomain
     * @param  CancelReservationDomain  $cancelReservationDomain
     * @param  CancelReservationAllDomain  $cancelReservationAllDomain
     * @param  StatusDomain  $statusDomain
     * @param  ShortenUrlDomain  $shortenUrlDomain
     */
    public function __construct(
        private readonly SendDomainInterface $sendDomain,
        private readonly CheckReservationDomainInterface $checkReservationDomain,
        private readonly CancelReservationDomainInterface $cancelReservationDomain,
        private readonly CancelReservationAllDomainInterface $cancelReservationAllDomain,
        private readonly StatusDomainInterface $statusDomain,
        private readonly ShortenUrlDomainInterface $shortenUrlDomain,
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

    /**
     * CommonMT 予約送信キャンセル
     *
     * @param  string|null  $clientTag
     * @param  string|null  $scheduleTime
     * @param  string|null  $scheduleDate
     * @param  string|null  $groupTag
     * @return array
     */
    public function cancelReservationMethod(
        ?string $clientTag = null,
        ?string $scheduleTime = null,
        ?string $scheduleDate = null,
        ?string $groupTag = null,
    ): array {
        $cancelReservationRequest = new CancelReservationRequest(
            clientTag: $clientTag,
            scheduleTime: $scheduleTime,
            scheduleDate: $scheduleDate,
            groupTag: $groupTag,
        );

        return $this->cancelReservationDomain->execute($cancelReservationRequest);
    }

    /**
     * CommonMT 予約送信一括キャンセル
     *
     * @param  string  $scheduleDate
     * @return array
     */
    public function cancelReservationAllMethod(
        string $scheduleDate,
    ): array {
        $cancelReservationAllRequest = new CancelReservationAllRequest(
            scheduleDate: $scheduleDate,
        );

        return $this->cancelReservationAllDomain->execute($cancelReservationAllRequest);
    }

    /**
     * CommonMT ステータス取得
     *
     * @param  string  $clientTag
     * @return array
     */
    public function statusMethod(
        string $clientTag,
    ): array {
        $statusRequest = new StatusRequest(
            clientTag: $clientTag,
        );

        return $this->statusDomain->execute($statusRequest);
    }

    /**
     * ショート URL 登録
     *
     * @param  string  $longUrl
     * @param  string|null  $domain
     * @return array
     */
    public function shortenUrlMethod(
        string $longUrl,
        ?string $domain = null,
    ): array {
        $shortenUrlRequest = new ShortenUrlRequest(
            longUrl: $longUrl,
            domain: $domain,
        );

        return $this->shortenUrlDomain->execute($shortenUrlRequest);
    }
}
