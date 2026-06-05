<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Request;

use Kanagama\ZettaiReachSmsClient\Parameters\ClientId;
use Kanagama\ZettaiReachSmsClient\Parameters\EndDate;
use Kanagama\ZettaiReachSmsClient\Parameters\SmsCode;
use Kanagama\ZettaiReachSmsClient\Parameters\StartDate;
use Kanagama\ZettaiReachSmsClient\Parameters\Token;

/**
 * CommonMT 通数集計
 */
final class SeparatedSuccessCountRequest implements SeparatedSuccessCountRequestInterface
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
     * @var StartDate
     */
    private readonly StartDate $startDate;

    /**
     * @var EndDate
     */
    private readonly EndDate $endDate;

    /**
     * @param string $startDate
     * @param string $endDate
     */
    public function __construct(
        string $startDate,
        string $endDate,
    ) {
        $this->token = Token::create();
        $this->clientId = ClientId::create();
        $this->smsCode = SmsCode::create();

        $this->startDate = StartDate::create($startDate);
        $this->endDate = EndDate::create($endDate);
    }

    /**
     * @test
     * @return array
     */
    public function toAll(): array
    {
        return [
            'token'     => $this->token->value(),
            'smsCode'   => $this->smsCode->value(),
            'clientId'  => $this->clientId->value(),
            'startDate' => $this->startDate->value(),
            'endDate'   => $this->endDate->value(),
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
