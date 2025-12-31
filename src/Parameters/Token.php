<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use InvalidArgumentException;

/**
 * アカウント登録時に発行されるアクセスキー
 */
final class Token implements ValueObjectInterface
{
    /**
     * @var string
     */
    private readonly string $value;

    /**
     *
     */
    public function __construct()
    {
        if (empty(config('zettai-reach-sms.token'))) {
            throw new InvalidArgumentException('tokenの設定が見つかりません。');
        }

        $this->value = config('zettai-reach-sms.token');

        // 32文字の英数字であることを確認
        if (!preg_match('/^[a-zA-Z0-9]{32}$/', $this->value)) {
            throw new InvalidArgumentException('tokenは32文字の英数字である必要があります。');
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
}
