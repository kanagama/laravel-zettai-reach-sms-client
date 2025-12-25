<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1;

use Kanagama\ZettaiReachSmsClient\V1\Dto\SendDto;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttp;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponseInterface;

final class ZettaiReachSmsClient implements ZettaiReachSmsClientInterface
{
    /**
     * CommonMT 送信
     *
     * @param ZettaiReachHttp $http
     * @param ZettaiReachResponse $response
     */
    public function __construct(
        private readonly ZettaiReachHttpInterface $http,
        private readonly ZettaiReachResponseInterface $response,
    ) {
    }

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
    public function send(
        string $phoneNumber,
        string $message,
        ?string $carrierId = null,
        ?string $clientTag = null,
        ?string $scheduleTime = null,
        ?string $groupTag = null,
    ): array {
        $sendDto = new SendDto(
            phoneNumber: $phoneNumber,
            message: $message,
            carrierId: $carrierId,
            clientTag: $clientTag,
            scheduleTime: $scheduleTime,
            groupTag: $groupTag,
        );

        $response = $this->http->postForm(
            url: 'https://sms-api.aossms.com/p5/api/mt.json',
            params: $sendDto->toArray(),
        );

        return $this->response->handle($response);
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
    public function checkReservation(
        ?string $clientTag = null,
        ?string $scheduleTime = null,
        ?string $scheduleDate = null,
        ?string $groupTag = null,
    ): array {
        return [];
    }
}
