<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\CancelReservation\Domains;

use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\CancelReservationDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Domains\CancelReservationDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservation\Request\CancelReservationRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class CancelReservationDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('CancelReservationDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる()
    {
        $psrResponse = new Psr7Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode([
                'responseCode'    => 0,
                'responseMessage' => 'Success.',
                'count'           => 1,
            ]),
        );
        $response = new Response($psrResponse);

        $zettaiReachHttpMock = $this->createMock(ZettaiReachHttpInterface::class);
        $zettaiReachHttpMock->expects($this->once())
            ->method('postForm')
            ->willReturn($response);
        $this->instance(ZettaiReachHttpInterface::class, $zettaiReachHttpMock);

        $cancelReservationRequestMock = $this->createMock(CancelReservationRequestInterface::class);
        $cancelReservationRequestMock->expects($this->once())
            ->method('toArray')
            ->willReturn([
                'token'     => 'abcdefghijklmnopqrstuvwxyz012345',
                'smsCode'   => '123456',
                'clientId'  => '98765',
                'clientTag' => '12345678',
            ]);

        /** @var CancelReservationDomain */
        $cancelReservationDomain = app()->make(CancelReservationDomainInterface::class);
        $response = $cancelReservationDomain->execute($cancelReservationRequestMock);
    }
}
