<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Request;

interface StatusRequestInterface
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
