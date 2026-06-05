<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\FakeShortenUrlDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\FakeShortenUrlDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Request\ShortenUrlRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Request\ShortenUrlRequestInterface;

final class LogShortenUrlDomain implements ShortenUrlDomainInterface, LogShortenUrlDomainInterface
{
    /**
     * @param  FakeShortenUrlDomain  $fakeShortenUrlDomain
     */
    public function __construct(
        private readonly FakeShortenUrlDomainInterface $fakeShortenUrlDomain,
    ) {
    }

    /**
     * @param  ShortenUrlRequest  $request
     * @return array
     */
    public function execute(ShortenUrlRequestInterface $request): array
    {
        Log::info('zettaiReachSms shorterUrl() Skipped.');

        return $this->fakeShortenUrlDomain->execute($request);
    }
}
