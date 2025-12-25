<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

/**
 * ショート URL に変換する際のドメイン
 */
final class Domain implements ValueObjectInterface
{
    /**
     * @param string $value
     */
    public function __construct(
        private readonly string $value,
    ) {
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
