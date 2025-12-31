<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\CheckReservation\Domains;

use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\CheckReservationDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Domains\CheckReservationDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\CheckReservation\Request\CheckReservationRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class CheckReservationDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('CheckReservationDomain')]
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
                'status'          => [
                    [
                        'clientTag'    => '12345678',
                        'phoneNumber'  => '+819012345678',
                        'smsMessage'   => 'example message',
                        'scheduleTime' => '2025-12-31 15:30',
                    ]
                ]
            ]),
        );
        $response = new Response($psrResponse);

        $zettaiReachHttpMock = $this->createMock(ZettaiReachHttpInterface::class);
        $zettaiReachHttpMock->expects($this->once())
            ->method('get')
            ->willReturn($response);
        $this->instance(ZettaiReachHttpInterface::class, $zettaiReachHttpMock);

        $checkReservationRequestMock = $this->createMock(CheckReservationRequestInterface::class);
        $checkReservationRequestMock->expects($this->once())
            ->method('toArray')
            ->willReturn([
                'token'     => 'abcdefghijklmnopqrstuvwxyz012345',
                'smsCode'   => '123456',
                'clientId'  => '98765',
                'clientTag' => '12345678',
            ]);

        /** @var CheckReservationDomain */
        $checkReservationDomain = app()->make(CheckReservationDomainInterface::class);
        $response = $checkReservationDomain->execute($checkReservationRequestMock);
    }
}
