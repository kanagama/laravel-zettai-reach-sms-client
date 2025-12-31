<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use InvalidArgumentException;

/**
 * 送信元 SMS コード
 */
final class SmsCode implements ValueObjectInterface
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
        if (empty(config('zettai-reach-sms.sms_code'))) {
            throw new InvalidArgumentException('smsCodeの設定が見つかりません。');
        }

        $this->value = config('zettai-reach-sms.sms_code');
        // 5文字もしくは6文字の数字
        if (!preg_match('/^[0-9]{5,6}$/', $this->value)) {
            throw new InvalidArgumentException('smsCodeは5文字もしくは6文字の数字である必要があります。');
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
