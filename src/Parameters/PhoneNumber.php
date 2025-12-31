<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use InvalidArgumentException;

/**
 * 送信先電話番号
 */
final class PhoneNumber implements ValueObjectInterface
{
    /**
     * @param string $value
     */
    public function __construct(
        private readonly string $value,
    ) {
        // 半角数字とハイフンのみで構成されていることを確認
        if (!preg_match('/(\+81|0)(([26789]0[1-9][0-9]{7}$)|(20[1-9][0-9]{10}$))/', $this->value)) {
            throw new InvalidArgumentException('phoneNumberは日本国内形式(070xxxxxxxx/080xxxxxxxx/090xxxxxxxx)、国際電話番号形式のどちらかを指定する必要があります。');
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
