<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\CheckReservation\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\LogCheckReservationDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\LogCheckReservationDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Request\CheckReservationRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class LogCheckReservationDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('CheckReservationDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        Log::spy();

        $checkReservationRequestMock = $this->createMock(CheckReservationRequestInterface::class);

        /** @var LogCheckReservationDomain */
        $logCheckReservationDomain = app()->make(LogCheckReservationDomainInterface::class);
        $response = $logCheckReservationDomain->execute($checkReservationRequestMock);

        Log::shouldHaveReceived('info')
            ->once()
            ->with('zettaiReachSms checkReservation() Skipped.');

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
