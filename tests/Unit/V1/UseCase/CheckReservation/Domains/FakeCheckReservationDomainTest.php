<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\CheckReservation\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\FakeCheckReservationDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\FakeCheckReservationDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Request\CheckReservationRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class FakeCheckReservationDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('CheckReservationDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        $checkReservationRequestMock = $this->createMock(CheckReservationRequestInterface::class);

        /** @var FakeCheckReservationDomain */
        $fakeCheckReservationDomain = app()->make(FakeCheckReservationDomainInterface::class);
        $response = $fakeCheckReservationDomain->execute($checkReservationRequestMock);

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
