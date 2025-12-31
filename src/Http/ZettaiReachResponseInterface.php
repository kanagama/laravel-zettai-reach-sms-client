<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Http;

use Illuminate\Http\Client\Response;

interface ZettaiReachResponseInterface
{
    /**
     * @param  Response  $response
     * @return array
     */
    public function handle(Response $response): array;
}
