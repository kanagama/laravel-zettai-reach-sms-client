<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Request\CancelReservationAllRequestInterface;

interface CancelReservationAllDomainInterface
{
    /**
     * @param  CancelReservationAllRequestInterface $request
     * @return array
     */
    public function execute(CancelReservationAllRequestInterface $request): array;
}
