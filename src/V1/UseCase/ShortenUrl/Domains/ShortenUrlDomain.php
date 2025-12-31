<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains;

use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttp;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponseInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Request\ShortenUrlRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Request\ShortenUrlRequestInterface;

final class ShortenUrlDomain implements ShortenUrlDomainInterface
{
    /**
     * @param  ZettaiReachHttp  $http
     * @param  ZettaiReachResponse  $response
     */
    public function __construct(
        private readonly ZettaiReachHttpInterface $http,
        private readonly ZettaiReachResponseInterface $response,
    ) {
    }

    /**
     * @param  ShortenUrlRequest  $request
     * @return array
     */
    public function execute(ShortenUrlRequestInterface $request): array
    {
        $response = $this->http->postForm(
            url: 'https://sms-api.aossms.com/p1/api/shortenurl.json',
            params: $request->toArray(),
        );

        return $this->response->handle($response);
    }
}
