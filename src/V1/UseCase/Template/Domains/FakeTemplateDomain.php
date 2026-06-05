<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains;

use GuzzleHttp\Psr7\Response as PsrResponse;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachResponseInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Request\TemplateRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Request\TemplateRequestInterface;

final class FakeTemplateDomain implements TemplateDomainInterface, FakeTemplateDomainInterface
{
    /**
     * @param  ZettaiReachResponse  $response
     */
    public function __construct(
        private readonly ZettaiReachResponseInterface $response,
    ) {
    }

    /**
     * @param  TemplateRequest  $request
     * @return array
     */
    public function execute(TemplateRequestInterface $request): array
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
