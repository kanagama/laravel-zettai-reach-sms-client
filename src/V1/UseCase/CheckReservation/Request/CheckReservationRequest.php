<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Request;

use Kanagama\ZettaiReachSmsClient\Parameters\ClientId;
use Kanagama\ZettaiReachSmsClient\Parameters\ClientTag;
use Kanagama\ZettaiReachSmsClient\Parameters\GroupTag;
use Kanagama\ZettaiReachSmsClient\Parameters\ScheduleDate;
use Kanagama\ZettaiReachSmsClient\Parameters\ScheduleTime;
use Kanagama\ZettaiReachSmsClient\Parameters\SmsCode;
use Kanagama\ZettaiReachSmsClient\Parameters\Token;

/**
 * CommonMT 予約送信確認
 */
final class CheckReservationRequest implements CheckReservationRequestInterface
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
     * @var ClientTag|null
     */
    private readonly ?ClientTag $clientTag;

    /**
     * @var ScheduleTime|null
     */
    private readonly ?ScheduleTime $scheduleTime;

    /**
     * @var ScheduleDate|null
     */
    private readonly ?ScheduleDate $scheduleDate;

    /**
     * @var GroupTag|null
     */
    private readonly ?GroupTag $groupTag;

    /**
     * @param string|null $clientTag
     * @param string|null $scheduleTime
     * @param string|null $scheduleDate
     * @param string|null $groupTag
     */
    public function __construct(
        ?string $clientTag = null,
        ?string $scheduleTime = null,
        ?string $scheduleDate = null,
        ?string $groupTag = null,
    ) {
        $this->token = new Token();
        $this->clientId = new ClientId();
        $this->smsCode = new SmsCode();

        $this->clientTag = ($clientTag)
            ? new ClientTag($clientTag)
            : null;

        $this->scheduleTime = ($scheduleTime)
            ? new ScheduleTime($scheduleTime)
            : null;

        $this->scheduleDate = ($scheduleDate)
            ? new ScheduleDate($scheduleDate)
            : null;

        $this->groupTag = ($groupTag)
            ? new GroupTag($groupTag)
            : null;
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
            'clientTag'    => $this->clientTag?->value(),
            'scheduleTime' => $this->scheduleTime?->value(),
            'scheduleDate' => $this->scheduleDate?->value(),
            'groupTag'     => $this->groupTag?->value(),
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
