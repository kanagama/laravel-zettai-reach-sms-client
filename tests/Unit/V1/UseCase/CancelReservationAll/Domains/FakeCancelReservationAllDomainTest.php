<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\CancelReservationAll\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\FakeCancelReservationAllDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\FakeCancelReservationAllDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Request\CancelReservationAllRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class FakeCancelReservationAllDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('CancelReservationAllDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        $cancelReservationAllRequestMock = $this->createMock(CancelReservationAllRequestInterface::class);

        /** @var FakeCancelReservationAllDomain */
        $fakeCancelReservationAllDomain = app()->make(FakeCancelReservationAllDomainInterface::class);
        $response = $fakeCancelReservationAllDomain->execute($cancelReservationAllRequestMock);

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
