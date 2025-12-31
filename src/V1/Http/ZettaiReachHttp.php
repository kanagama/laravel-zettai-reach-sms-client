<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\Http;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Response;

final class ZettaiReachHttp implements ZettaiReachHttpInterface
{
    /**
     * @var HttpFactory
     */
    private readonly HttpFactory $http;

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
     * @return Response|PromiseInterface
     */
    public function postForm(
        string $url,
        array $params
    ): Response|PromiseInterface {
        return $this->http->post($url, $params);
    }

    /**
     * GET
     *
     * @param string $url
     * @param array $query
     * @return Response|PromiseInterface
     */
    public function get(
        string $url,
        array $query,
    ): Response|PromiseInterface {
        return $this->http->get($url, $query);
    }
}
