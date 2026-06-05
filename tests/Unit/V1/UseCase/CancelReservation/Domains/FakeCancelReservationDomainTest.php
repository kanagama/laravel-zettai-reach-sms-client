<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\CancelReservation\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\FakeCancelReservationDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\FakeCancelReservationDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Request\CancelReservationRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class FakeCancelReservationDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('CancelReservationDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        $cancelReservationRequestMock = $this->createMock(CancelReservationRequestInterface::class);

        /** @var FakeCancelReservationDomain */
        $fakeCancelReservationDomain = app()->make(FakeCancelReservationDomainInterface::class);
        $response = $fakeCancelReservationDomain->execute($cancelReservationRequestMock);

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
