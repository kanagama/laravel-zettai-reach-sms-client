<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use InvalidArgumentException;

final class SmsDriver implements ValueObjectInterface
{
    /**
     * API送信を行わない
     *
     * @static
     * @var string
     */
    private const FAKE = 'fake';

    /**
     * API送信を行う
     *
     * @static
     * @var string
     */
    private const API = 'api';

    /**
     * API送信を行わず、ログを出力する
     *
     * @static
     * @var string
     */
    private const LOG = 'log';

    /**
     * @param  string  $value
     * @return void
     */
    private function __construct(
        private readonly string $value,
    ) {
        if (!in_array($this->value, array_keys(self::toArray()), true)) {
            throw new InvalidArgumentException('SMS_DRIVERは "api" か "fake" を指定して下さい。');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public static function getApi(): string
    {
        return self::API;
    }

    /**
     * @return string
     */
    public static function getFake(): string
    {
        return self::FAKE;
    }

    /**
     * @return string
     */
    public static function getLog(): string
    {
        return self::LOG;
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return [
            self::getApi()  => 'api',
            self::getFake() => 'fake',
            self::getLog()  => 'log',
        ];
    }

    /**
     * @param  string  $value
     * @return self
     */
    public static function create(string $value): self
    {
        return new self($value);
    }

    /**
     * APIオブジェクトを生成する
     *
     * @return self
     */
    public static function createApi(): self
    {
        return new self(self::getApi());
    }

    /**
     * fake オブジェクトを生成する
     *
     * @return self
     */
    public static function createFake(): self
    {
        return new self(self::getFake());
    }

    /**
     * Log オブジェクトを生成する
     *
     * @return self
     */
    public static function createLog(): self
    {
        return new self(self::getLog());
    }
}
