<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\FakeSendDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\FakeSendDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Request\SendRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Request\SendRequestInterface;

final class LogSendDomain implements SendDomainInterface, LogSendDomainInterface
{
    /**
     * @param  FakeSendDomain  $fakeSendDomain
     */
    public function __construct(
        private readonly FakeSendDomainInterface $fakeSendDomain,
    ) {
    }

    /**
     * @param  SendRequest  $request
     * @return array
     */
    public function execute(SendRequestInterface $request): array
    {
        Log::info('zettaiReachSms send() Skipped.');

        return $this->fakeSendDomain->execute($request);
    }
}
