<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use InvalidArgumentException;

/**
 * キャリアID
 */
final class CarrierId implements ValueObjectInterface
{
    /**
     * au
     *
     * @var string
     */
    private const AU = '101';

    /**
     * ドコモ
     *
     * @var string
     */
    private const DOCOMO = '103';

    /**
     * ソフトバンク
     *
     * @var string
     */
    private const SOFTBANK = '105';

    /**
     * 楽天
     *
     * @var string
     */
    private const RAKUTEN = '106';

    /**
     * @param string $value
     */
    public function __construct(
        private readonly string $value
    ) {
        if (!in_array((int) $this->value, array_keys(self::toArray()), true)) {
            throw new InvalidArgumentException('CarrierId が不正です。' . $this->value);
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
     * au の値を取得
     *
     * @test
     * @return string
     */
    public static function getAu(): string
    {
        return self::AU;
    }

    /**
     * ドコモ の値を取得
     *
     * @test
     * @return string
     */
    public static function getDocomo(): string
    {
        return self::DOCOMO;
    }

    /**
     * ソフトバンク の値を取得
     *
     * @test
     * @return string
     */
    public static function getSoftbank(): string
    {
        return self::SOFTBANK;
    }

    /**
     * 楽天 の値を取得
     *
     * @test
     * @return string
     */
    public static function getRakuten(): string
    {
        return self::RAKUTEN;
    }

    /**
     * @test
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::getAu()       => 'au',
            self::getDocomo()   => 'ドコモ',
            self::getSoftbank() => 'ソフトバンク',
            self::getRakuten()  => '楽天',
        ];
    }
}
