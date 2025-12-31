<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains;

use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttp;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponseInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Request\SeparatedSuccessCountRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Request\SeparatedSuccessCountRequestInterface;

final class SeparatedSuccessCountDomain implements SeparatedSuccessCountDomainInterface
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
     * @param  SeparatedSuccessCountRequest  $request
     * @return array
     */
    public function execute(SeparatedSuccessCountRequestInterface $request): array
    {
        $response = $this->http->get(
            url: 'https://sms-api.aossms.com/p5/api/separatedsuccesscount.json',
            query: $request->toArray(),
        );

        return $this->response->handle($response);
    }
}
