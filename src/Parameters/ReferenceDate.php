<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use Kanagama\ZettaiReachSmsClient\Validator\DateValidator;
use InvalidArgumentException;

/**
 * 判定を行う基準となる日
 */
final class ReferenceDate implements ValueObjectInterface
{
    /**
     * @param string $value
     */
    public function __construct(
        private readonly string $value,
    ) {
        if (!DateValidator::isYmdFormat($this->value)) {
            throw new InvalidArgumentException('ReferenceDateはyyyyMMdd形式である必要があります。');
        }

        if (!DateValidator::isYmdValidDate($this->value)) {
            throw new InvalidArgumentException('ReferenceDateは正しい日付である必要があります。');
        }

        if (!DateValidator::isNotBeforeTwoYearsAgo($this->value)) {
            throw new InvalidArgumentException('ReferenceDateは2年前から当日までの範囲である必要があります。');
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