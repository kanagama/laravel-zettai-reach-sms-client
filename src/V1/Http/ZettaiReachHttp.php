<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\Http;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;

final class ZettaiReachHttp implements ZettaiReachHttpInterface
{
    /**
     * @var Request
     */
    private readonly Request $http;

    /**
     * @param HttpFactory $httpFactory
     */
    public function __construct(
        HttpFactory $httpFactory,
    ) {
        $this->http = $httpFactory->asForm()
            ->timeout(config('zettai-reach-sms-client.timeout', 10));
    }

    /**
     * POST送信
     *
     * @param  string $url
     * @param  array $params
     * @return Response
     */
    public function postForm(
        string $url,
        array $params
    ): Response {
        return $this->http->post($url, $params);
    }

    /**
     * GET
     *
     * @param string $url
     * @param array $query
     * @return Response
     */
    public function get(
        string $url,
        array $query,
    ): Response {
        return $this->http->get($url, $query);
    }
}
