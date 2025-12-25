<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\Parameters\CarrierId;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use ReflectionClass;

final class CarrierIdTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('carrierId')]
    #[Group('value')]
    #[DataProvider('objectProvider')]
    public function オブジェクト化出来る(
        string $value,
    ) {
        $objectCarrierId = new CarrierId($value);

        $this->assertSame($value, $objectCarrierId->value());
    }

    /**
     * @return array
     */
    public static function objectProvider(): array
    {
        return [
            'au' => [
                'value' => CarrierId::getAu(),
            ],
            'ドコモ' => [
                'value' => CarrierId::getDocomo(),
            ],
            'ソフトバンク' => [
                'value' => CarrierId::getSoftbank(),
            ],
            '楽天' => [
                'value' => CarrierId::getRakuten(),
            ],
        ];
    }

    #[Test]
    #[Group('unit')]
    #[Group('carrierId')]
    #[Group('getAu')]
    public function auの値を取得できる()
    {
        $this->assertSame('101', CarrierId::getAu());
    }

    #[Test]
    #[Group('unit')]
    #[Group('carrierId')]
    #[Group('getDocomo')]
    public function docomoの値を取得できる()
    {
        $this->assertSame('103', CarrierId::getDocomo());
    }

    #[Test]
    #[Group('unit')]
    #[Group('carrierId')]
    #[Group('getSoftbank')]
    public function softbankの値を取得できる()
    {
        $this->assertSame('105', CarrierId::getSoftbank());
    }

    #[Test]
    #[Group('unit')]
    #[Group('carrierId')]
    #[Group('getRakuten')]
    public function 楽天の値を取得できる()
    {
        $this->assertSame('106', CarrierId::getRakuten());
    }

    #[Test]
    #[Group('unit')]
    #[Group('carrierId')]
    #[Group('toArray')]
    public function 配列の要素数と定数の数が一致する()
    {
        // 定数の数を取得する
        $reflection = new ReflectionClass(CarrierId::class);

        $this->assertSame(
            count($reflection->getConstants()),
            count(CarrierId::toArray()),
        );
    }

    #[Test]
    #[Group('unit')]
    #[Group('carrierId')]
    #[Group('toArray')]
    public function toArrayの内容が正しい()
    {
        $this->assertSame([
            CarrierId::getAu()       => 'au',
            CarrierId::getDocomo()   => 'ドコモ',
            CarrierId::getSoftbank() => 'ソフトバンク',
            CarrierId::getRakuten()  => '楽天',
        ], CarrierId::toArray());
    }
}