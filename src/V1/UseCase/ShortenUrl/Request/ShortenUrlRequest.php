<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Request;

use Kanagama\ZettaiReachSmsClient\Parameters\ClientId;
use Kanagama\ZettaiReachSmsClient\Parameters\Domain;
use Kanagama\ZettaiReachSmsClient\Parameters\LongUrl;
use Kanagama\ZettaiReachSmsClient\Parameters\Token;

/**
 * ショート URL 登録
 */
final class ShortenUrlRequest implements ShortenUrlRequestInterface
{
    /**
     * @var Token
     */
    private readonly Token $token;

    /**
     * @var ClientId
     */
    private readonly ClientId $clientId;

    /**
     * @var LongUrl
     */
    private readonly LongUrl $longUrl;

    /**
     * @var Domain|null
     */
    private readonly ?Domain $domain;

    /**
     * @param string $longUrl
     * @param string|null $domain
     */
    public function __construct(
        string $longUrl,
        ?string $domain = null,
    ) {
        $this->token = new Token();
        $this->clientId = new ClientId();

        $this->longUrl = new LongUrl($longUrl);

        $this->domain = ($domain)
            ? new Domain($domain)
            : null;
    }

    /**
     * @test
     * @return array
     */
    public function toAll(): array
    {
        return [
            'token'    => $this->token->value(),
            'clientId' => $this->clientId->value(),
            'longUrl'  => $this->longUrl->value(),
            'domain'   => $this->domain?->value(),
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
