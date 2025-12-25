<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\Http;

use Illuminate\Http\Client\Response;

interface ZettaiReachResponseInterface
{
    /**
     * @param  Response  $response
     * @return array
     */
    public function handle(Response $response): array;
}
