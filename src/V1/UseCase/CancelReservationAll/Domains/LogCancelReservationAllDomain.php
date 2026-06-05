<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\FakeCancelReservationAllDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\FakeCancelReservationAllDomainInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Request\CancelReservationAllRequest;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Request\CancelReservationAllRequestInterface;

final class LogCancelReservationAllDomain implements CancelReservationAllDomainInterface, LogCancelReservationAllDomainInterface
{
    /**
     * @param FakeCancelReservationAllDomain $fakeCancelReservationAllDomain
     */
    public function __construct(
        private readonly FakeCancelReservationAllDomainInterface $fakeCancelReservationAllDomain,
    ) {
    }

    /**
     * @param  CancelReservationAllRequest  $request
     * @return array
     */
    public function execute(CancelReservationAllRequestInterface $request): array
    {
        Log::info('zettaiReachSms cancelReservationAll() Skipped.');

        return $this->fakeCancelReservationAllDomain->execute($request);
    }
}
