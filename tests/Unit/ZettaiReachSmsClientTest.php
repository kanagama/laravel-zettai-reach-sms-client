<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\V1;

use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\SendDomainInterface;
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
        $sendDomainMock = $this->createMock(SendDomainInterface::class);
        $sendDomainMock->expects($this->once())
            ->method('execute')
            ->willReturn([
                'responseCode'    => 0,
                'responseMessage' => 'Success.',
                'phoneNumber'     => '09012345678',
                'smsMessage'      => 'example message'
            ]);
        $this->instance(SendDomainInterface::class, $sendDomainMock);

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

    #[Test]
    #[Group('unit')]
    #[Group('ZettaiReachSmsClient')]
    #[Group('send')]
    public function 静的呼び出しでもSMS送信処理が正常終了する()
    {
        $sendDomainMock = $this->createMock(SendDomainInterface::class);
        $sendDomainMock->expects($this->once())
            ->method('execute')
            ->willReturn([
                'responseCode'    => 0,
                'responseMessage' => 'Success.',
                'phoneNumber'     => '09012345678',
                'smsMessage'      => 'example message'
            ]);
        $this->instance(SendDomainInterface::class, $sendDomainMock);

        $response = ZettaiReachSmsClient::send(
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
