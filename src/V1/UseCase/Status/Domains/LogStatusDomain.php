<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\FakeStatusDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\FakeStatusDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Request\StatusRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Request\StatusRequestInterface;

final class LogStatusDomain implements StatusDomainInterface, LogStatusDomainInterface
{
    /**
     * @param  FakeStatusDomain  $fakeStatusDomain
     */
    public function __construct(
        private readonly FakeStatusDomainInterface $fakeStatusDomain,
    ) {
    }

    /**
     * @param  StatusRequest  $request
     * @return array
     */
    public function execute(StatusRequestInterface $request): array
    {
        Log::info('zettaiReachSms status() Skipped.');

        return $this->fakeStatusDomain->execute($request);
    }
}
