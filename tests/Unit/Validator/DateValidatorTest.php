<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Validator;

use Carbon\CarbonImmutable;
use Kanagama\ZettaiReachSmsClient\Validator\DateValidator;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class DateValidatorTest extends TestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // Carbonの現在日時を固定 (2025-12-25)
        CarbonImmutable::setTestNow(
            CarbonImmutable::create(2025, 12, 25, 0, 0, 0),
        );
    }

    #[Test]
    #[Group('unit')]
    #[Group('DateValidator')]
    #[Group('isYmdFormat')]
    #[DataProvider('isYmdFormatProvider')]
    public function isYmdFormatが正しく判定できる(
        string $value,
        bool $expected,
    ): void {
        $this->assertSame($expected, DateValidator::isYmdFormat($value));
    }

    /**
     * @return array
     */
    public static function isYmdFormatProvider(): array
    {
        return [
            '正しい日付' => [
                'value'    => '20240101',
                'expected' => true,
            ],
            '7桁' => [
                'value'    => '2024010',
                'expected' => false,
            ],
            '9桁' => [
                'value'    => '202401011',
                'expected' => false,
            ],
            'ハイフンあり' => [
                'value'    => '2024-01-01',
                'expected' => false,
            ],
        ];
    }

    #[Test]
    #[Group('unit')]
    #[Group('DateValidator')]
    #[Group('isYmFormat')]
    #[DataProvider('isYmFormatProvider')]
    public function isYmFormatが正しく判定できる(
        string $value,
        bool $expected,
    ): void {
        $this->assertSame($expected, DateValidator::isYmFormat($value));
    }

    /**
     * @return array
     */
    public static function isYmFormatProvider(): array
    {
        return [
            '正しい年月' => [
                'value'    => '202401',
                'expected' => true,
            ],
            '5桁' => [
                'value'    => '20240',
                'expected' => false,
            ],
            '7桁' => [
                'value'    => '2024011',
                'expected' => false,
            ],
            'ハイフンあり' => [
                'value'    => '2024-01',
                'expected' => false,
            ],
        ];
    }

    #[Test]
    #[Group('unit')]
    #[Group('DateValidator')]
    #[Group('isYmdHiFormat')]
    #[DataProvider('isYmdHiFormatProvider')]
    public function isYmdHiFormatが正しく判定できる(
        string $value,
        bool $expected,
    ): void {
        $this->assertSame($expected, DateValidator::isYmdHiFormat($value));
    }

    /**
     * @return array
     */
    public static function isYmdHiFormatProvider(): array
    {
        return [
            '正しい形式' => [
                'value'    => '2024-01-01 12:34',
                'expected' => true,
            ],
            '日付のみ' => [
                'value'    => '2024-01-01',
                'expected' => false,
            ],
            '時刻のみ' => [
                'value'    => '12:34',
                'expected' => false,
            ],
            '桁数不足' => [
                'value'    => '2024-1-1 2:4',
                'expected' => false,
            ],
            '区切り違い' => [
                'value'    => '2024/01/01 12:34',
                'expected' => false,
            ],
        ];
    }

    #[Test]
    #[Group('unit')]
    #[Group('DateValidator')]
    #[Group('isYmdHiValidDateTime')]
    #[DataProvider('isYmdHiValidDateTimeProvider')]
    public function isYmdHiValidDateTimeが正しく判定できる(
        string $value,
        bool $expected,
    ): void {
        $this->assertSame($expected, DateValidator::isYmdHiValidDateTime($value));
    }

    /**
     * @return array
     */
    public static function isYmdHiValidDateTimeProvider(): array
    {
        return [
            '正しい日時' => [
                'value'    => '2024-02-29 23:59', // うるう年
                'expected' => true,
            ],
            '不正な日付' => [
                'value'    => '2023-02-29 23:59', // うるう年でない
                'expected' => false,
            ],
            '不正な時刻' => [
                'value'    => '2024-01-31 24:00',
                'expected' => false,
            ],
            '形式不正' => [
                'value'    => '2024/01/01 12:00',
                'expected' => false,
            ],
        ];
    }

    #[Test]
    #[Group('unit')]
    #[Group('DateValidator')]
    #[Group('isNotBeforeTwoYearsAgo')]
    #[DataProvider('isNotBeforeTwoYearsAgoProvider')]
    public function isNotBeforeTwoYearsAgoが正しく判定できる(
        string $value,
        bool $expected,
    ): void {
        $this->assertSame($expected, DateValidator::isNotBeforeTwoYearsAgo($value));
    }

    /**
     * @return array
     */
    public static function isNotBeforeTwoYearsAgoProvider(): array
    {
        // 現在日付: 2025-12-25
        return [
            '現在日付' => [
                'value'    => '20251225',
                'expected' => true,
            ],
            '2年前の翌日' => [
                'value'    => '20231226',
                'expected' => true,
            ],
            '2年前当日' => [
                'value'    => '20231225',
                'expected' => true,
            ],
            '2年前より前' => [
                'value'    => '20231224',
                'expected' => false,
            ],
            '未来日付' => [
                'value'    => '20251226',
                'expected' => false,
            ],
            '不正な形式' => [
                'value'    => '2025-12-25',
                'expected' => false,
            ],
        ];
    }

    #[Test]
    #[Group('unit')]
    #[Group('DateValidator')]
    #[Group('isYmdValidDate')]
    #[DataProvider('isYmdValidDateProvider')]
    public function isYmdValidDateが正しく判定できる(
        string $value,
        bool $expected,
    ): void {
        $this->assertSame($expected, DateValidator::isYmdValidDate($value));
    }

    /**
     * @return array
     */
    public static function isYmdValidDateProvider(): array
    {
        return [
            '正しい日付' => [
                'value'    => '20240229', // うるう年
                'expected' => true,
            ],
            '不正な日付' => [
                'value'    => '20230229', // うるう年でない
                'expected' => false,
            ],
            '月不正' => [
                'value'    => '20241301',
                'expected' => false,
            ],
            '日不正' => [
                'value'    => '20240132',
                'expected' => false,
            ],
            '形式不正' => [
                'value'    => '2024-01-01',
                'expected' => false,
            ],
        ];
    }

    #[Test]
    #[Group('unit')]
    #[Group('DateValidator')]
    #[Group('isYmValidDate')]
    #[DataProvider('isYmValidDateProvider')]
    public function isYmValidDateが正しく判定できる(
        string $value,
        bool $expected,
    ): void {
        $this->assertSame($expected, DateValidator::isYmValidDate($value));
    }

    /**
     * @return array
     */
    public static function isYmValidDateProvider(): array
    {
        return [
            '正しい年月' => [
                'value'    => '202401',
                'expected' => true,
            ],
            '月不正' => [
                'value'    => '202413',
                'expected' => false,
            ],
            '形式不正' => [
                'value'    => '2024-01',
                'expected' => false,
            ],
            '年不正' => [
                'value'    => '000013',
                'expected' => false,
            ],
        ];
    }

    #[Test]
    #[Group('unit')]
    #[Group('DateValidator')]
    #[Group('isNotAfterThisMonth')]
    #[DataProvider('isNotAfterThisMonthProvider')]
    public function isNotAfterThisMonthが正しく判定できる(
        string $value,
        bool $expected,
    ): void {
        $this->assertSame($expected, DateValidator::isNotAfterThisMonth($value));
    }

    /**
     * @return array
     */
    public static function isNotAfterThisMonthProvider(): array
    {
        return [
            '当月' => [
                'value'    => '202512',
                'expected' => true,
            ],
            '過去月' => [
                'value'    => '202511',
                'expected' => true,
            ],
            '未来月' => [
                'value'    => '202601',
                'expected' => false,
            ],
            '形式不正' => [
                'value'    => '2025-12',
                'expected' => false,
            ],
        ];
    }
}
