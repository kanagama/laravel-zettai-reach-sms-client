<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Request;

use Kanagama\ZettaiReachSmsClient\Parameters\ClientId;
use Kanagama\ZettaiReachSmsClient\Parameters\SmsCode;
use Kanagama\ZettaiReachSmsClient\Parameters\Token;

/**
 * CommonMT 登録済み定型文取得
 */
final class TemplateRequest implements TemplateRequestInterface
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

    public function __construct()
    {
        $this->token = new Token();
        $this->clientId = new ClientId();
        $this->smsCode = new SmsCode();
    }

    /**
     * @return array
     */
    public function toAll(): array
    {
        return [
            'token'    => $this->token->value(),
            'smsCode'  => $this->smsCode->value(),
            'clientId' => $this->clientId->value(),
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
