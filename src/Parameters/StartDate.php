<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use Kanagama\ZettaiReachSmsClient\Validator\DateValidator;
use InvalidArgumentException;

/**
 * キャンセルする日付範囲の開始日付
 */
final class StartDate implements ValueObjectInterface
{
    /**
     * @param string $value
     */
    public function __construct(
        private readonly string $value,
    ) {
        if (!DateValidator::isYmdFormat($this->value)) {
            throw new InvalidArgumentException('StartDateはyyyyMMdd形式である必要があります。');
        }
        if (!DateValidator::isYmdValidDate($this->value)) {
            throw new InvalidArgumentException('StartDateは正しい日付である必要があります。');
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