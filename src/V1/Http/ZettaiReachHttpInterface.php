<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\Http;

use Illuminate\Http\Client\Response;

interface ZettaiReachHttpInterface
{
    /**
     * @param  string $url
     * @param  array $params
     * @return Response
     */
    public function postForm(
        string $url,
        array $params
    ): Response;
}
