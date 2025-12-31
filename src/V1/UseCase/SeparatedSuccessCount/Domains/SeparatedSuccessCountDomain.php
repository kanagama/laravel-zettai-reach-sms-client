<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains;

use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttp;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponseInterface;
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
