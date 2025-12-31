<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains;

use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttp;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponseInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Request\CancelReservationAllRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Request\CancelReservationAllRequestInterface;

final class CancelReservationAllDomain implements CancelReservationAllDomainInterface
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
     * @param  CancelReservationAllRequest  $request
     * @return array
     */
    public function execute(CancelReservationAllRequestInterface $request): array
    {
        $response = $this->http->postForm(
            url: 'https://sms-api.aossms.com/p5/api/cancelreservationall.json',
            params: $request->toArray(),
        );

        return $this->response->handle($response);
    }
}
