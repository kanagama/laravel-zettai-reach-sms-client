<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains;

use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttp;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponseInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Request\StatusRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Request\StatusRequestInterface;

final class StatusDomain implements StatusDomainInterface
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
     * @param  StatusRequest  $request
     * @return array
     */
    public function execute(StatusRequestInterface $request): array
    {
        $response = $this->http->get(
            url: 'https://sms-api.aossms.com/p5/api/status.json',
            query: $request->toArray(),
        );

        return $this->response->handle($response);
    }
}
