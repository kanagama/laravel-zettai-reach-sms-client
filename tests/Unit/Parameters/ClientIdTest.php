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
    #[Group('parameters')]
    #[Group('ClientId')]
    public function クライアントIDを取得出来ない(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Config::set('zettai-reach-sms.client_id', null);

        ClientId::create();
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ClientId')]
    public function クライアントIDが半角数字でない場合例外を投げる(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Config::set('zettai-reach-sms.client_id', 'abc123');

        ClientId::create();
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ClientId')]
    #[Group('value')]
    public function クライアントIDを取得出来る(): void
    {
        Config::set('zettai-reach-sms.client_id', '123456');

        $clientId = ClientId::create();

        $this->assertSame('123456', $clientId->value());
    }
}
