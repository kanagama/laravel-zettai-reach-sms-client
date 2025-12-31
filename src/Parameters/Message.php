<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use InvalidArgumentException;

/**
 * 送信メッセージ
 */
final class Message implements ValueObjectInterface
{
    /**
     * @param string $value
     */
    public function __construct(
        private readonly string $value,
    ) {
        $length = mb_strlen($this->value, 'UTF-8');
        if ($length < 1 || $length > 660) {
            throw new InvalidArgumentException('messageは1文字から660文字までである必要があります。');
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
