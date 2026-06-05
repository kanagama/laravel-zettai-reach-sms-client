<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains;

use GuzzleHttp\Psr7\Response as PsrResponse;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponseInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Request\ShortenUrlRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Request\ShortenUrlRequestInterface;

final class FakeShortenUrlDomain implements ShortenUrlDomainInterface, FakeShortenUrlDomainInterface
{
    /**
     * @param  ZettaiReachResponse  $response
     */
    public function __construct(
        private readonly ZettaiReachResponseInterface $response,
    ) {
    }

    /**
     * @param  ShortenUrlRequest  $request
     * @return array
     */
    public function execute(ShortenUrlRequestInterface $request): array
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
