<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Request;

use Kanagama\ZettaiReachSmsClient\Parameters\ClientId;
use Kanagama\ZettaiReachSmsClient\Parameters\ScheduleDate;
use Kanagama\ZettaiReachSmsClient\Parameters\SmsCode;
use Kanagama\ZettaiReachSmsClient\Parameters\Token;

/**
 * CommonMT 予約送信一括キャンセル
 */
final class CancelReservationAllRequest implements CancelReservationAllRequestInterface
{
    /**
     * @var Token
     */
    private readonly Token $token;

    /**
     * @var SmsCode
     */
    private readonly SmsCode $smsCode;

    /**
     * @var ClientId
     */
    private readonly ClientId $clientId;

    /**
     * @var ScheduleDate
     */
    private readonly ScheduleDate $scheduleDate;

    /**
     * @param string $scheduleDate
     */
    public function __construct(
        string $scheduleDate,
    ) {
        $this->token = new Token();
        $this->clientId = new ClientId();
        $this->smsCode = new SmsCode();

        $this->scheduleDate = new ScheduleDate($scheduleDate);
    }

    /**
     * @test
     * @return array
     */
    public function toAll(): array
    {
        return [
            'token'        => $this->token->value(),
            'smsCode'      => $this->smsCode->value(),
            'clientId'     => $this->clientId->value(),
            'scheduleDate' => $this->scheduleDate->value(),
        ];
    }

    /**
     * @test
     * @return array
     */
    public function toArray(): array
    {
        $result = $this->toAll();

        foreach ($result as $key => $value) {
            if ($value === null) {
                unset($result[$key]);
            }
        }

        return $result;
    }
}
