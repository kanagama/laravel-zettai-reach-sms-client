<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Http;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

final class ZettaiReachHttp implements ZettaiReachHttpInterface
{
    /**
     * @var PendingRequest
     */
    private readonly PendingRequest $http;

    /**
     * @param HttpFactory $httpFactory
     */
    public function __construct(
        HttpFactory $httpFactory,
    ) {
        // PHP Intelephense の型推論が正しく働かないため、変数に代入してから型宣言する
        /** @var PendingRequest $http */
        $http = $httpFactory->asForm()
            ->timeout(config('zettai-reach-sms-client.timeout', 10));

        $this->http = $http;
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
