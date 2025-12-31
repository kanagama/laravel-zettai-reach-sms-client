<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains;

use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttp;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponseInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Request\NumberCleaningRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Request\NumberCleaningRequestInterface;

final class NumberCleaningDomain implements NumberCleaningDomainInterface
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
     * @param  NumberCleaningRequest  $request
     * @return array
     */
    public function execute(NumberCleaningRequestInterface $request): array
    {
        $response = $this->http->postForm(
            url: 'https://sms-api.aossms.com/p5/api/numbercleaning.json',
            params: $request->toArray(),
        );

        return $this->response->handle($response);
    }
}
