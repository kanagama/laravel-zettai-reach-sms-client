<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\Exceptions;

use RuntimeException;
use Throwable;

final class ApiException extends RuntimeException
{
    /**
     * @param integer $responseCode
     * @param string $responseMessage
     * @param Throwable|null $previous
     */
    public function __construct(
        int $responseCode,
        string $responseMessage,
        ?Throwable $previous = null
    ) {
        parent::__construct("ZettaiReachSms API error: {$responseCode} {$responseMessage}", 0, $previous);
    }
}