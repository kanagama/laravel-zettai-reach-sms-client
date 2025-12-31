<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains;

use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttp;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponse;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachResponseInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Request\TemplateRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Request\TemplateRequestInterface;

final class TemplateDomain implements TemplateDomainInterface
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
     * @param  TemplateRequestInterface  $request
     * @return array
     */
    public function execute(TemplateRequestInterface $request): array
    {
        $response = $this->http->get(
            url: 'https://sms-api.aossms.com/p5/api/template.json',
            query: $request->toArray(),
        );

        return $this->response->handle($response);
    }
}
