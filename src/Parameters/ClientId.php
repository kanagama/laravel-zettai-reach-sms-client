<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use InvalidArgumentException;

/**
 * 契約クライアントID
 */
final class ClientId implements ValueObjectInterface
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
        if (empty(config('zettai-reach-sms.client_id'))) {
            throw new InvalidArgumentException('clientIdの設定が見つかりません。');
        }

        $this->value = config('zettai-reach-sms.client_id');

        if (!preg_match('/^[0-9]+$/', $this->value)) {
            throw new InvalidArgumentException('clientIdは半角数字である必要があります。');
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
