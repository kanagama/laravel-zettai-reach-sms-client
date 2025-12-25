<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use Kanagama\ZettaiReachSmsClient\Validator\DateValidator;
use InvalidArgumentException;

/**
 * 予約送信時間
 */
final class ScheduleTime implements ValueObjectInterface
{
    /**
     * @param string $value
     */
    public function __construct(
        private readonly string $value,
    ) {
        // YYYY-mm-dd H:i 形式である
        if (!DateValidator::isYmdHiFormat($this->value)) {
            throw new InvalidArgumentException('scheduleTimeはYYYY-mm-dd H:i形式である必要があります。');
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