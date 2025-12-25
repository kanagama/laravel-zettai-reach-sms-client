<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use Kanagama\ZettaiReachSmsClient\Validator\DateValidator;
use InvalidArgumentException;

/**
 * 予約送信日
 */
final class ScheduleDate implements ValueObjectInterface
{
    /**
     * @param string $value
     */
    public function __construct(
        private readonly string $value,
    ) {
        // yyyyMMdd 形式である
        if (!DateValidator::isYmdFormat($this->value)) {
            throw new InvalidArgumentException('scheduleDateはyyyyMMdd形式である必要があります。');
        }

        // 正しい日付である
        if (!DateValidator::isYmdValidDate($this->value)) {
            throw new InvalidArgumentException('ScheduleDateは正しい日付である必要があります。');
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