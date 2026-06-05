<?php
declare(strict_types=1);

namespace Tests\Unit\Http;

use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttp;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Group;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

final class ZettaiReachHttpTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('http')]
    public function コンストラクタがasFormとtimeoutを呼ぶ(): void
    {
        $pendingRequest = $this->createMock(PendingRequest::class);
        $pendingRequest->expects($this->once())
            ->method('asForm')
            ->willReturnSelf();
        $pendingRequest->expects($this->once())
            ->method('timeout')
            ->with(10)
            ->willReturnSelf();

        $httpFactory = $this->createMock(HttpFactory::class);
        $httpFactory->expects($this->once())
            ->method('createPendingRequest')
            ->willReturn($pendingRequest);

        new ZettaiReachHttp($httpFactory);
    }

    #[Test]
    #[Group('unit')]
    #[Group('http')]
    public function postFormがpendingRequestに委譲して値を返す(): void
    {
        $pendingRequest = $this->createMock(PendingRequest::class);
        $pendingRequest->expects($this->once())
            ->method('asForm')
            ->willReturnSelf();
        $pendingRequest->expects($this->once())
            ->method('timeout')
            ->with(10)
            ->willReturnSelf();

        $httpFactory = $this->createMock(HttpFactory::class);
        $httpFactory->expects($this->once())
            ->method('createPendingRequest')
            ->willReturn($pendingRequest);

        $expected = $this->createMock(Response::class);

        $pendingRequest->expects($this->once())
            ->method('post')
            ->with('https://example.test/api', ['foo' => 'bar'])
            ->willReturn($expected);

        $client = new ZettaiReachHttp($httpFactory);

        $this->assertSame($expected, $client->postForm('https://example.test/api', ['foo' => 'bar']));
    }

    #[Test]
    #[Group('unit')]
    #[Group('http')]
    public function getがpendingRequestに委譲して値を返す(): void
    {
        $pendingRequest = $this->createMock(PendingRequest::class);
        $pendingRequest->expects($this->once())
            ->method('asForm')
            ->willReturnSelf();
        $pendingRequest->expects($this->once())
            ->method('timeout')
            ->with(10)
            ->willReturnSelf();

        $httpFactory = $this->createMock(HttpFactory::class);
        $httpFactory->expects($this->once())
            ->method('createPendingRequest')
            ->willReturn($pendingRequest);

        $expected = $this->createMock(Response::class);

        $pendingRequest->expects($this->once())
            ->method('get')
            ->with('https://example.test/status', ['q' => 'v'])
            ->willReturn($expected);

        $client = new ZettaiReachHttp($httpFactory);

        $this->assertSame($expected, $client->get('https://example.test/status', ['q' => 'v']));
    }
}
