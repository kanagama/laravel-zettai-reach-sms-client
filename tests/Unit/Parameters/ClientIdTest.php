<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Illuminate\Support\Facades\Config;
use InvalidArgumentException;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\Parameters\ClientId;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class ClientIdTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('clientId')]
    public function クライアントIDを取得出来ない()
    {
        $this->expectException(InvalidArgumentException::class);

        Config::set('zettai-reach-sms.client_id', null);

        new ClientId();
    }

    #[Test]
    #[Group('unit')]
    #[Group('clientId')]
    public function クライアントIDが半角数字でない場合例外を投げる()
    {
        $this->expectException(InvalidArgumentException::class);

        Config::set('zettai-reach-sms.client_id', 'abc123');

        new ClientId();
    }

    #[Test]
    #[Group('unit')]
    #[Group('clientId')]
    public function クライアントIDを取得出来る()
    {
        Config::set('zettai-reach-sms.client_id', '123456');

        $clientId = new ClientId();

        $this->assertSame('123456', $clientId->value());
    }
}
