<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\SeparatedSuccessCount\Request;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Config;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Request\SeparatedSuccessCountRequest;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class SeparatedSuccessCountRequestTest extends TestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        CarbonImmutable::setTestNow(
            CarbonImmutable::create(2025, 12, 25, 12, 0, 0)
        );

        Config::set('zettai-reach-sms.token', 'abcdefghijklmnopqrstuvwxyz012345');
        Config::set('zettai-reach-sms.client_id', '98765');
        Config::set('zettai-reach-sms.sms_code', '123456');
    }

    #[Test]
    #[Group('unit')]
    #[Group('SeparatedSuccessCountRequest')]
    #[Group('toAll')]
    public function toAllが正しく配列を返す(): void
    {
        $separatedSuccessCountRequest = new SeparatedSuccessCountRequest(
            startDate: '20251201',
            endDate: '20251231'
        );

        $this->assertSame([
            'token'     => 'abcdefghijklmnopqrstuvwxyz012345',
            'smsCode'   => '123456',
            'clientId'  => '98765',
            'startDate' => '20251201',
            'endDate'   => '20251231',
        ], $separatedSuccessCountRequest->toAll());
    }

    #[Test]
    #[Group('unit')]
    #[Group('SeparatedSuccessCountRequest')]
    #[Group('toArray')]
    public function toArrayが正しく配列を返す(): void
    {
        $separatedSuccessCountRequest = new SeparatedSuccessCountRequest(
            startDate: '20251201',
            endDate: '20251231'
        );

        $this->assertSame([
            'token'     => 'abcdefghijklmnopqrstuvwxyz012345',
            'smsCode'   => '123456',
            'clientId'  => '98765',
            'startDate' => '20251201',
            'endDate'   => '20251231',
        ], $separatedSuccessCountRequest->toArray());
    }
}
