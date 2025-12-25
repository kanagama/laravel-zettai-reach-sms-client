<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

interface ValueObjectInterface
{
    /**
     * @return string
     */
    public function value(): string;
}
