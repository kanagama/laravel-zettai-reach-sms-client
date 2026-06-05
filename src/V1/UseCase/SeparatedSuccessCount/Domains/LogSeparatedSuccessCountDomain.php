<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\FakeSeparatedSuccessCountDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\FakeSeparatedSuccessCountDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Request\SeparatedSuccessCountRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Request\SeparatedSuccessCountRequestInterface;

final class LogSeparatedSuccessCountDomain implements SeparatedSuccessCountDomainInterface, LogSeparatedSuccessCountDomainInterface
{
    /**
     * @param  FakeSeparatedSuccessCountDomain  $fakeSeparatedSuccessCountDomain
     */
    public function __construct(
        private readonly FakeSeparatedSuccessCountDomainInterface $fakeSeparatedSuccessCountDomain,
    ) {
    }

    /**
     * @param  SeparatedSuccessCountRequest  $request
     * @return array
     */
    public function execute(SeparatedSuccessCountRequestInterface $request): array
    {
        Log::info('zettaiReachSms separatedSuccessCount() Skipped.');

        return $this->fakeSeparatedSuccessCountDomain->execute($request);
    }
}
