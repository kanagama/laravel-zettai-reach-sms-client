<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains;

use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttp;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponseInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Request\SendRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Request\SendRequestInterface;

final class SendDomain implements SendDomainInterface
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
     * @param  SendRequest  $request
     * @return array
     */
    public function execute(SendRequestInterface $request): array
    {
        $response = $this->http->postForm(
            url: 'https://sms-api.aossms.com/p5/api/mt.json',
            params: $request->toArray(),
        );

        return $this->response->handle($response);
    }
}
