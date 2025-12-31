<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Request\CheckReservationRequestInterface;

interface CheckReservationDomainInterface
{
    /**
     * @param  CheckReservationRequestInterface $request
     * @return array
     */
    public function execute(CheckReservationRequestInterface $request): array;
}
