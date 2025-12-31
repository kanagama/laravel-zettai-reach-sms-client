<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use InvalidArgumentException;

/**
 * ショート URL に変換するオリジナル URL
 */
final class LongUrl implements ValueObjectInterface
{
    /**
     * @param string $value
     */
    public function __construct(
        private readonly string $value,
    ) {
        // 1文字以上2000文字以下である
        $length = mb_strlen($this->value);
        if ($length < 1 || $length > 2048) {
            throw new InvalidArgumentException('longUrlは1文字以上2048文字以下である必要があります。');
        }
    }

    /**
     * @test
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
