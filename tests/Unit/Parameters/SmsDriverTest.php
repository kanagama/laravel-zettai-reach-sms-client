<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Illuminate\Support\Facades\Config;
use InvalidArgumentException;
use Kanagama\ZettaiReachSmsClient\Parameters\SmsDriver;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use ReflectionClass;

final class SmsDriverTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('SmsDriver')]
    #[Group('value')]
    #[DataProvider('objectProvider')]
    public function オブジェクト化出来る(
        string $value
    ): void {
        $smsDriver = SmsDriver::create($value);

        $this->assertSame($value, $smsDriver->value());
    }

    /**
     * @return array
     */
    public static function objectProvider(): array
    {
        return [
            'api' => [
                'value' => SmsDriver::getApi(),
            ],
            'fake' => [
                'value' => SmsDriver::getFake(),
            ],
            'log' => [
                'value' => SmsDriver::getLog(),
            ],
        ];
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('SmsDriver')]
    #[Group('getApi')]
    public function apiの値を取得できる(): void
    {
        $this->assertSame('api', SmsDriver::getApi());
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('SmsDriver')]
    #[Group('getFake')]
    public function fakeの値を取得できる(): void
    {
        $this->assertSame('fake', SmsDriver::getFake());
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('SmsDriver')]
    #[Group('getLog')]
    public function logの値を取得できる(): void
    {
        $this->assertSame('log', SmsDriver::getLog());
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('SmsDriver')]
    #[Group('toArray')]
    public function 配列の要素数と定数の数が一致する(): void
    {
        // 定数の数を取得する
        $reflection = new ReflectionClass(SmsDriver::class);

        $this->assertSame(
            count($reflection->getConstants()),
            count(SmsDriver::toArray()),
        );
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('SmsDriver')]
    #[Group('toArray')]
    public function toArrayの内容が正しい(): void
    {
        $this->assertSame([
            SmsDriver::getApi()  => 'api',
            SmsDriver::getFake() => 'fake',
            SmsDriver::getLog()  => 'log',
        ], SmsDriver::toArray());
    }
}
