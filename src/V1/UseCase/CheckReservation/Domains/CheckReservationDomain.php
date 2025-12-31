<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains;

use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttp;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponseInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Request\CheckReservationRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Request\CheckReservationRequestInterface;

final class CheckReservationDomain implements CheckReservationDomainInterface
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
     * @param  CheckReservationRequest  $request
     * @return array
     */
    public function execute(CheckReservationRequestInterface $request): array
    {
        $response = $this->http->get(
            url: 'https://sms-api.aossms.com/p5/api/checkreservation.json',
            query: $request->toArray(),
        );

        return $this->response->handle($response);
    }
}
