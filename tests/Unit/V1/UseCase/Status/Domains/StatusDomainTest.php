<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\Status\Domains;

use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\StatusDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\StatusDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Request\StatusRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class StatusDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('StatusDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる()
    {
        $psrResponse = new Psr7Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode([
                'responseCode'    => 0,
                'responseMessage' => 'Success.',
                'clientTag'       => '12345678',
                'phoneNumber'     => '+819012345678',
                'smsMessage'      => 'example message',
                'sendStatus'      => 2,
                'carrierStatus'   => 0,
                'sendTime'        => '2025-12-31 15:30:00',
                'receiveTime'     => '2025-12-31 15:30:10'
            ]),
        );
        $response = new Response($psrResponse);

        $zettaiReachHttpMock = $this->createMock(ZettaiReachHttpInterface::class);
        $zettaiReachHttpMock->expects($this->once())
            ->method('get')
            ->willReturn($response);
        $this->instance(ZettaiReachHttpInterface::class, $zettaiReachHttpMock);

        $statusRequestMock = $this->createMock(StatusRequestInterface::class);
        $statusRequestMock->expects($this->once())
            ->method('toArray')
            ->willReturn([
                'token'     => 'abcdefghijklmnopqrstuvwxyz012345',
                'smsCode'   => '123456',
                'clientId'  => '98765',
                'clientTag' => '12345678',
            ]);

        /** @var StatusDomain */
        $statusDomain = app()->make(StatusDomainInterface::class);
        $response = $statusDomain->execute($statusRequestMock);
    }
}
