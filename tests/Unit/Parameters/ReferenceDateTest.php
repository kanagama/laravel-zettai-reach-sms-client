<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Kanagama\ZettaiReachSmsClient\Parameters\ReferenceDate;;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use InvalidArgumentException;

final class ReferenceDateTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ReferenceDate')]
    #[DataProvider('validReferenceDateProvider')]
    public function ReferenceDateが正しく生成できる(
        string $value,
    ): void {
        $referenceDate = new ReferenceDate($value);
        $this->assertSame($value, $referenceDate->value());
    }

    /**
     * @return array
     */
    public static function validReferenceDateProvider(): array
    {
        return [
            '今日の日付' => [
                'value' => date('Ymd'),
            ],
            '2年前の日付' => [
                'value' => date('Ymd', strtotime('-2 years')),
            ],
        ];
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ReferenceDate')]
    #[DataProvider('invalidReferenceDateProvider')]
    public function ReferenceDateが正しく例外を投げる(
        string $value,
    ): void {
        $this->expectException(InvalidArgumentException::class);

        new ReferenceDate($value);
    }

    /**
     * @return array
     */
    public static function invalidReferenceDateProvider(): array
    {
        return [
            '形式が不正（ハイフンあり）' => [
                'value' => '2024-01-01',
            ],
            '形式が不正（7桁）' => [
                'value' => '2024010',
            ],
            '形式が不正（9桁）' => [
                'value' => '202401011',
            ],
            '存在しない日付' => [
                'value' => '20240230',
            ],
            '2年前より前の日付' => [
                'value' => date('Ymd', strtotime('-2 years -1 day')),
            ],
            '未来の日付' => [
                'value' => date('Ymd', strtotime('+1 day')),
            ],
        ];
    }
}
