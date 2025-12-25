<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\V1;

use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClient;
use Kanagama\ZettaiReachSmsClient\V1\ZettaiReachSmsClientInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class ZettaiReachSmsClientTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('ZettaiReachSmsClient')]
    #[Group('send')]
    public function SMS送信処理が正常終了する()
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

        /** @var ZettaiReachSmsClient */
        $http = app()->make(ZettaiReachSmsClientInterface::class);

        $response = $http->send(
            phoneNumber: '09028550632',
            message: 'ユニットテストメッセージ',
        );

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success.',
            'phoneNumber'     => '09012345678',
            'smsMessage'      => 'example message'
        ], $response);
    }
}
