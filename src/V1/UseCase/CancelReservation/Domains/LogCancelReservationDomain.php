<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Request\CancelReservationRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Request\CancelReservationRequestInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\FakeCancelReservationDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\FakeCancelReservationDomainInterface;

final class LogCancelReservationDomain implements CancelReservationDomainInterface, LogCancelReservationDomainInterface
{
    /**
     * @param  FakeCancelReservationDomain  $fakeCancelReservationDomain
     */
    public function __construct(
        private readonly FakeCancelReservationDomainInterface $fakeCancelReservationDomain,
    ) {
    }

    /**
     * @param  CancelReservationRequest  $request
     * @return array
     */
    public function execute(CancelReservationRequestInterface $request): array
    {
        Log::info('zettaiReachSms cancelReservation() Skipped.');

        return $this->fakeCancelReservationDomain->execute($request);
    }
}
