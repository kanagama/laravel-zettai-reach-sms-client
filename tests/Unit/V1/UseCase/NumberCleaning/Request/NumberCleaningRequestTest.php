<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\NumberCleaning\Request;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Config;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Request\NumberCleaningRequest;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class NumberCleaningRequestTest extends TestCase
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
    #[Group('NumberCleaningRequest')]
    #[Group('toAll')]
    public function toAllが正しく配列を返す(): void
    {
        $numberCleaningRequest = new NumberCleaningRequest(
            phoneNumber: '09012345678',
        );

        $this->assertSame([
            'token'       => 'abcdefghijklmnopqrstuvwxyz012345',
            'clientId'    => '98765',
            'phoneNumber' => '09012345678',
        ], $numberCleaningRequest->toAll());
    }

    #[Test]
    #[Group('unit')]
    #[Group('NumberCleaningRequest')]
    #[Group('toArray')]
    public function toArrayが正しく配列を返す(): void
    {
        $numberCleaningRequest = new NumberCleaningRequest(
            phoneNumber: '09012345678',
        );

        $this->assertSame([
            'token'       => 'abcdefghijklmnopqrstuvwxyz012345',
            'clientId'    => '98765',
            'phoneNumber' => '09012345678',
        ], $numberCleaningRequest->toArray());
    }
}
