<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Kanagama\ZettaiReachSmsClient\Parameters\PhoneNumber;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use InvalidArgumentException;

final class PhoneNumberTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('PhoneNumber')]
    #[DataProvider('phoneNumberProvider')]
    public function 正しい電話番号が設定できる(
        string $value,
    ): void {
        $phoneNumber = new PhoneNumber($value);

        $this->assertSame($value, $phoneNumber->value());
    }

    /**
     * @return array
     */
    public static function phoneNumberProvider(): array
    {
        return [
            '070xxxxxxxx形式' => [
                'value' => '07012345678',
            ],
            '080xxxxxxxx形式' => [
                'value' => '08012345678',
            ],
            '090xxxxxxxx形式' => [
                'value' => '09012345678',
            ],
            '国際電話番号形式' => [
                'value' => '+819012345678',
            ],
        ];
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('PhoneNumber')]
    #[DataProvider('invalidPhoneNumberProvider')]
    public function 不正な電話番号が設定された場合例外が投げられる(
        string $value,
    ): void {
        $this->expectException(InvalidArgumentException::class);

        new PhoneNumber($value);
    }

    /**
     * @return array
     */
    public static function invalidPhoneNumberProvider(): array
    {
        return [
            '英字混在' => [
                'value' => '070abcd5678',
            ],
            '記号混在' => [
                'value' => '080-1234-5678',
            ],
            '桁数不足' => [
                'value' => '090123456',
            ],
            '桁数超過' => [
                'value' => '070123456789',
            ],
            '国際電話番号形式で桁数不足' => [
                'value' => '+81901234567',
            ],
            '国際電話番号形式で桁数超過' => [
                'value' => '+8190123456789',
            ],
        ];
    }
}
