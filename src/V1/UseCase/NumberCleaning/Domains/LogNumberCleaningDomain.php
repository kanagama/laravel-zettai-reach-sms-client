<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\FakeNumberCleaningDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\FakeNumberCleaningDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Request\NumberCleaningRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Request\NumberCleaningRequestInterface;

final class LogNumberCleaningDomain implements NumberCleaningDomainInterface, LogNumberCleaningDomainInterface
{
    /**
     * @param  FakeNumberCleaningDomain  $fakeNumberCleaningDomain
     */
    public function __construct(
        private readonly FakeNumberCleaningDomainInterface $fakeNumberCleaningDomain,
    ) {
    }

    /**
     * @param  NumberCleaningRequest  $request
     * @return array
     */
    public function execute(NumberCleaningRequestInterface $request): array
    {
        Log::info('zettaiReachSms numberCleaning() Skipped.');

        return $this->fakeNumberCleaningDomain->execute($request);
    }
}
