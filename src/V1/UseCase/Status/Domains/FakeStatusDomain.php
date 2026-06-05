<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains;

use GuzzleHttp\Psr7\Response as PsrResponse;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponseInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Request\StatusRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Request\StatusRequestInterface;

final class FakeStatusDomain implements StatusDomainInterface, FakeStatusDomainInterface
{
    /**
     * @param  ZettaiReachResponse  $response
     */
    public function __construct(
        private readonly ZettaiReachResponseInterface $response,
    ) {
    }

    /**
     * @param  StatusRequest  $request
     * @return array
     */
    public function execute(StatusRequestInterface $request): array
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
