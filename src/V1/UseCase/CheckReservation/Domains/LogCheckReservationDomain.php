<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\FakeCheckReservationDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\FakeCheckReservationDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Request\CheckReservationRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Request\CheckReservationRequestInterface;

final class LogCheckReservationDomain implements CheckReservationDomainInterface, LogCheckReservationDomainInterface
{
    /**
     * @param  FakeCheckReservationDomain  $fakeCheckReservationDomain
     */
    public function __construct(
        private readonly FakeCheckReservationDomainInterface $fakeCheckReservationDomain,
    ) {
    }

    /**
     * @param  CheckReservationRequest  $request
     * @return array
     */
    public function execute(CheckReservationRequestInterface $request): array
    {
        Log::info('zettaiReachSms checkReservation() Skipped.');

        return $this->fakeCheckReservationDomain->execute($request);
    }
}
