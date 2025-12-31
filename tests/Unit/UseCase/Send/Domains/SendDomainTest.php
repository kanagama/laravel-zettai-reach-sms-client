<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\Send\Domains;

use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\SendDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\SendDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Request\SendRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class SendDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('SendDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる()
    {
        $psrResponse = new Psr7Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode([
                'responseCode'    => 0,
                'responseMessage' => 'Success.',
                'phoneNumber'     => '09012345678',
                'smsMessage'      => 'example message'
            ]),
        );
        $response = new Response($psrResponse);

        $zettaiReachHttpMock = $this->createMock(ZettaiReachHttpInterface::class);
        $zettaiReachHttpMock->expects($this->once())
            ->method('postForm')
            ->willReturn($response);
        $this->instance(ZettaiReachHttpInterface::class, $zettaiReachHttpMock);

        $sendRequestMock = $this->createMock(SendRequestInterface::class);
        $sendRequestMock->expects($this->once())
            ->method('toArray')
            ->willReturn([
                'token'       => 'abcdefghijklmnopqrstuvwxyz012345',
                'smsCode'     => '123456',
                'clientId'    => '98765',
                'message'     => 'test',
                'phoneNumber' => '09012345678',
            ]);

        /** @var SendDomain */
        $sendDomain = app()->make(SendDomainInterface::class);
        $response = $sendDomain->execute($sendRequestMock);
    }
}
