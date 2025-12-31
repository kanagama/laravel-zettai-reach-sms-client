<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Request\CancelReservationRequestInterface;

interface CancelReservationDomainInterface
{
    /**
     * @param  CancelReservationRequestInterface $request
     * @return array
     */
    public function execute(CancelReservationRequestInterface $request): array;
}
