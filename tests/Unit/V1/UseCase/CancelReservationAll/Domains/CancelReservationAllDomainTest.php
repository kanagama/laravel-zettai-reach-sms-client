<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\CancelReservationAll\Domains;

use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\CancelReservationAllDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Domains\CancelReservationAllDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CancelReservationAll\Request\CancelReservationAllRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class CancelReservationAllDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('CancelReservationAllDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる()
    {
        $psrResponse = new Psr7Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode([
                'responseCode'    => 0,
                'responseMessage' => 'Success.',
                'count'           => 5,
            ]),
        );
        $response = new Response($psrResponse);

        $zettaiReachHttpMock = $this->createMock(ZettaiReachHttpInterface::class);
        $zettaiReachHttpMock->expects($this->once())
            ->method('postForm')
            ->willReturn($response);
        $this->instance(ZettaiReachHttpInterface::class, $zettaiReachHttpMock);

        $cancelReservationAllRequestMock = $this->createMock(CancelReservationAllRequestInterface::class);
        $cancelReservationAllRequestMock->expects($this->once())
            ->method('toArray')
            ->willReturn([
                'token'        => 'abcdefghijklmnopqrstuvwxyz012345',
                'smsCode'      => '123456',
                'clientId'     => '98765',
                'scheduleDate' => '20251231',
            ]);

        /** @var CancelReservationAllDomain */
        $cancelReservationAllDomain = app()->make(CancelReservationAllDomainInterface::class);
        $response = $cancelReservationAllDomain->execute($cancelReservationAllRequestMock);
    }
}
