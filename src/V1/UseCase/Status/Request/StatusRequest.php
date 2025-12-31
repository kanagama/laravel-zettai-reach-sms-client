<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Request;

use Kanagama\ZettaiReachSmsClient\Parameters\ClientId;
use Kanagama\ZettaiReachSmsClient\Parameters\ClientTag;
use Kanagama\ZettaiReachSmsClient\Parameters\SmsCode;
use Kanagama\ZettaiReachSmsClient\Parameters\Token;

/**
 * CommonMT ステータス取得
 */
final class StatusRequest implements StatusRequestInterface
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
     * @var ClientTag
     */
    private readonly ClientTag $clientTag;

    /**
     * @param string $clientTag
     */
    public function __construct(
        string $clientTag,
    ) {
        $this->token = new Token();
        $this->clientId = new ClientId();
        $this->smsCode = new SmsCode();

        $this->clientTag = new ClientTag($clientTag);
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
            'clientTag' => $this->clientTag->value(),
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
