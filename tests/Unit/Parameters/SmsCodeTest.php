<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Illuminate\Support\Facades\Config;
use InvalidArgumentException;
use Kanagama\ZettaiReachSmsClient\Parameters\SmsCode;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class SmsCodeTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('SmsCode')]
    #[Group('value')]
    public function valueメソッドが正しく動作する(): void
    {
        Config::set('zettai-reach-sms.sms_code', '12345');

        $smsCode = new SmsCode();
        $this->assertSame('12345', $smsCode->value());
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('SmsCode')]
    public function 設定が見つからない場合例外を投げる(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Config::set('zettai-reach-sms.sms_code', null);

        new SmsCode();
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('SmsCode')]
    #[DataProvider('exceptionProvider')]
    public function 指定文字数でない場合例外を投げる(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);

        Config::set('zettai-reach-sms.sms_code', $value);

        new SmsCode();
    }

    /**
     * @return array
     */
    public static function exceptionProvider(): array
    {
        return [
            '4文字' => [
                '1234',
            ],
            '7文字' => [
                '1234567'
            ],
            '文字列' => [
                'abcde',
            ],
            '混在' => [
                '12a45',
            ],
        ];
    }
}
