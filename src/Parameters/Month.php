<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use Kanagama\ZettaiReachSmsClient\Validator\DateValidator;
use InvalidArgumentException;

/**
 * 取得する年月
 */
final class Month implements ValueObjectInterface
{
    /**
     * @param string $value
     */
    private function __construct(
        private readonly string $value,
    ) {
        if (!DateValidator::isYmFormat($this->value)) {
            throw new InvalidArgumentException('monthはyyyyMM形式である必要があります。');
        }

        if (!DateValidator::isYmValidDate($this->value)) {
            throw new InvalidArgumentException('Monthは正しい年月である必要があります。');
        }

        if (!DateValidator::isNotAfterThisMonth($this->value)) {
            throw new InvalidArgumentException('Monthは当月以前である必要があります。');
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

    /**
     * @param  string  $value
     * @return self
     */
    public static function create(string $value): self
    {
        return new self($value);
    }
}
