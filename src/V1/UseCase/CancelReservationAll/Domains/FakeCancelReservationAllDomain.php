<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains;

use GuzzleHttp\Psr7\Response as PsrResponse;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponseInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Request\CancelReservationAllRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Request\CancelReservationAllRequestInterface;

final class FakeCancelReservationAllDomain implements CancelReservationAllDomainInterface, FakeCancelReservationAllDomainInterface
{
    /**
     * @param  ZettaiReachResponse  $response
     */
    public function __construct(
        private readonly ZettaiReachResponseInterface $response,
    ) {
    }

    /**
     * @param  CancelReservationAllRequest  $request
     * @return array
     */
    public function execute(CancelReservationAllRequestInterface $request): array
    {
        $response = new Response(
            new PsrResponse(
                200,
                [],
                json_encode([
                    'responseCode'    => 0,
                    'responseMessage' => 'Success',
                ]),
            ),
        );

        return $this->response->handle($response);
    }
}
