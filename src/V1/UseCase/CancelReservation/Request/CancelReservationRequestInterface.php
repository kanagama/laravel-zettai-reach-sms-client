<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Request;

interface CancelReservationRequestInterface
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
