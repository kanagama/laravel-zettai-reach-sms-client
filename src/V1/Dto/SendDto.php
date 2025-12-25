<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\Dto;

use Kanagama\ZettaiReachSmsClient\Parameters\CarrierId;
use Kanagama\ZettaiReachSmsClient\Parameters\ClientId;
use Kanagama\ZettaiReachSmsClient\Parameters\ClientTag;
use Kanagama\ZettaiReachSmsClient\Parameters\GroupTag;
use Kanagama\ZettaiReachSmsClient\Parameters\Message;
use Kanagama\ZettaiReachSmsClient\Parameters\PhoneNumber;
use Kanagama\ZettaiReachSmsClient\Parameters\ScheduleTime;
use Kanagama\ZettaiReachSmsClient\Parameters\SmsCode;
use Kanagama\ZettaiReachSmsClient\Parameters\Token;

/**
 * CommonMT 送信
 */
final class SendDto
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
     * @var Message
     */
    private readonly Message $message;

    /**
     * @var PhoneNumber
     */
    private readonly PhoneNumber $phoneNumber;

    /**
     * @var CarrierId|null
     */
    private readonly ?CarrierId $carrierId;

    /**
     * @var ClientTag|null
     */
    private readonly ?ClientTag $clientTag;

    /**
     * @var ScheduleTime|null
     */
    private readonly ?ScheduleTime $scheduleTime;

    /**
     * @var GroupTag|null
     */
    private readonly ?GroupTag $groupTag;

    /**
     * @param string $message
     * @param string $phoneNumber
     * @param string|null $carrierId
     * @param string|null $clientTag
     * @param string|null $scheduleTime
     * @param string|null $groupTag
     */
    public function __construct(
        string $message,
        string $phoneNumber,
        ?string $carrierId,
        ?string $clientTag,
        ?string $scheduleTime,
        ?string $groupTag,
    ) {
        $this->token = new Token();
        $this->clientId = new ClientId();
        $this->smsCode = new SmsCode();

        $this->message = new Message($message);
        $this->phoneNumber = new PhoneNumber($phoneNumber);

        $this->carrierId = ($carrierId)
            ? new CarrierId($carrierId)
            : null;

        $this->clientTag = ($clientTag)
            ? new ClientTag($clientTag)
            : null;

        $this->scheduleTime = ($scheduleTime)
            ? new ScheduleTime($scheduleTime)
            : null;

        $this->groupTag = ($groupTag)
            ? new GroupTag($groupTag)
            : null;
    }

    /**
     * @return array
     */
    public function toAll(): array
    {
        return [
            'token'        => $this->token->value(),
            'smsCode'      => $this->smsCode->value(),
            'clientId'     => $this->clientId->value(),
            'message'      => $this->message->value(),
            'phoneNumber'  => $this->phoneNumber->value(),
            'clientTag'    => $this->clientTag?->value(),
            'carrierId'    => $this->carrierId?->value(),
            'scheduleTime' => $this->scheduleTime?->value(),
            'groupTag'     => $this->groupTag?->value(),
        ];
    }

    /**
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
