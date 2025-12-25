<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use Kanagama\ZettaiReachSmsClient\Validator\DateValidator;
use InvalidArgumentException;

/**
 * SMS 送信日
 */
final class Date implements ValueObjectInterface
{
    /**
     * @param string $value
     */
    public function __construct(
        private readonly string $value,
    ) {
        if (!DateValidator::isYmdFormat($this->value)) {
            throw new InvalidArgumentException('DateはyyyyMMdd形式である必要があります。');
        }
        if (!DateValidator::isYmdValidDate($this->value)) {
            throw new InvalidArgumentException('Dateは正しい日付である必要があります。');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}