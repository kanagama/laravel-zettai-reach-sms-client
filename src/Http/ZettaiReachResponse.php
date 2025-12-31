<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Http;

use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Exceptions\ApiException;
use RuntimeException;

final class ZettaiReachResponse implements ZettaiReachResponseInterface
{
    /**
     * @param  Response  $response
     * @return array
     */
    public function handle(Response $response): array
    {
        $response->throw();

        $json = $response->json();
        if (!is_array($json)) {
            throw new RuntimeException('Invalid JSON response.');
        }

        $code = (int) ($json['responseCode'] ?? -1);
        $message = (string) ($json['responseMessage'] ?? '');

        // 200でも失敗あり :contentReference[oaicite:2]{index=2}
        if ($code !== 0) {
            throw new ApiException($code, $message);
        }

        return $json;
    }
}
