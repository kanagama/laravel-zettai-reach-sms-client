<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\CancelReservationAll\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\LogCancelReservationAllDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\LogCancelReservationAllDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Request\CancelReservationAllRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class LogCancelReservationAllDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('CancelReservationAllDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        Log::spy();

        $cancelReservationAllRequestMock = $this->createMock(CancelReservationAllRequestInterface::class);

        /** @var LogCancelReservationAllDomain */
        $logCancelReservationAllDomain = app()->make(LogCancelReservationAllDomainInterface::class);
        $response = $logCancelReservationAllDomain->execute($cancelReservationAllRequestMock);

        Log::shouldHaveReceived('info')
            ->once()
            ->with('zettaiReachSms cancelReservationAll() Skipped.');

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
