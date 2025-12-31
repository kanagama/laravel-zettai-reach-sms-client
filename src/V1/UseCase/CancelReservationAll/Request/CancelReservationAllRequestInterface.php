<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Request;

interface CancelReservationAllRequestInterface
{
    /**
     * @return array
     */
    public function toAll(): array;

    /**
     * @return array
     */
    public function toArray(): array;
}
