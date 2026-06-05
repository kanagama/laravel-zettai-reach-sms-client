<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\CancelReservation\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\LogCancelReservationDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\LogCancelReservationDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Request\CancelReservationRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class LogCancelReservationDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('CancelReservationDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        Log::spy();

        $cancelReservationRequestMock = $this->createMock(CancelReservationRequestInterface::class);

        /** @var LogCancelReservationDomain */
        $logCancelReservationDomain = app()->make(LogCancelReservationDomainInterface::class);
        $response = $logCancelReservationDomain->execute($cancelReservationRequestMock);

        Log::shouldHaveReceived('info')
            ->once()
            ->with('zettaiReachSms cancelReservation() Skipped.');

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
