<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains;

use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttp;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponseInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Request\CancelReservationRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Request\CancelReservationRequestInterface;

final class CancelReservationDomain implements CancelReservationDomainInterface
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
     * @param  CancelReservationRequest  $request
     * @return array
     */
    public function execute(CancelReservationRequestInterface $request): array
    {
        $response = $this->http->postForm(
            url: 'https://sms-api.aossms.com/p5/api/cancelreservation.json',
            params: $request->toArray(),
        );

        return $this->response->handle($response);
    }
}
