<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\Http;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

interface ZettaiReachHttpInterface
{
    /**
     * @param  string $url
     * @param  array $params
     * @return Response|PromiseInterface
     */
    public function postForm(
        string $url,
        array $params
    ): Response|PromiseInterface;

    /**
     * @param string $url
     * @param array $query
     * @return Response|PromiseInterface
     */
    public function get(
        string $url,
        array $query,
    ): Response|PromiseInterface;
}
