<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\CancelReservation\Request;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Config;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Request\CancelReservationRequest;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class CancelReservationRequestTest extends TestCase
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
    #[Group('CancelReservationRequest')]
    #[Group('toAll')]
    public function toAllが正しく配列を返す(): void
    {
        $cancelReservationRequest = new CancelReservationRequest(
            clientTag: '12345678',
            scheduleTime: '2025-12-31 15:30',
            scheduleDate: '20251231',
            groupTag: 'group1'
        );

        $this->assertSame([
            'token'        => 'abcdefghijklmnopqrstuvwxyz012345',
            'smsCode'      => '123456',
            'clientId'     => '98765',
            'clientTag'    => '12345678',
            'scheduleTime' => '2025-12-31 15:30',
            'scheduleDate' => '20251231',
            'groupTag'     => 'group1',
        ], $cancelReservationRequest->toAll());
    }

    #[Test]
    #[Group('unit')]
    #[Group('CancelReservationRequest')]
    #[Group('toArray')]
    public function toArrayが正しく配列を返す(): void
    {
        $cancelReservationRequest = new CancelReservationRequest(
            clientTag: '12345678',
        );

        $this->assertSame([
            'token'    => 'abcdefghijklmnopqrstuvwxyz012345',
            'smsCode'  => '123456',
            'clientId' => '98765',
            'clientTag' => '12345678',
        ], $cancelReservationRequest->toArray());
    }
}
