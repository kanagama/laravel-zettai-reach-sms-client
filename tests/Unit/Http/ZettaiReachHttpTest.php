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
    public function コンストラクタがasFormとtimeoutを呼ぶ()
    {
        $factory = $this->createMock(HttpFactory::class);
        $pending = $this->getMockBuilder(PendingRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $factory->expects($this->once())
            ->method('asForm')
            ->willReturn($pending);

        $pending->expects($this->once())
            ->method('timeout')
            ->with(10)
            ->willReturn($pending);

        new ZettaiReachHttp($factory);
    }

    #[Test]
    #[Group('unit')]
    #[Group('http')]
    public function postFormがpendingRequestに委譲して値を返す()
    {
        $factory = $this->createMock(HttpFactory::class);
        $pending = $this->getMockBuilder(PendingRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $factory->method('asForm')->willReturn($pending);
        $pending->method('timeout')->willReturn($pending);

        $expected = $this->createMock(Response::class);

        $pending->expects($this->once())
            ->method('post')
            ->with('https://example.test/api', ['foo' => 'bar'])
            ->willReturn($expected);

        $client = new ZettaiReachHttp($factory);

        $this->assertSame($expected, $client->postForm('https://example.test/api', ['foo' => 'bar']));
    }

    #[Test]
    #[Group('unit')]
    #[Group('http')]
    public function getが_endingRequestに委譲して値を返す()
    {
        $factory = $this->createMock(HttpFactory::class);
        $pending = $this->getMockBuilder(PendingRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $factory->method('asForm')->willReturn($pending);
        $pending->method('timeout')->willReturn($pending);

        $expected = $this->createMock(Response::class);

        $pending->expects($this->once())
            ->method('get')
            ->with('https://example.test/status', ['q' => 'v'])
            ->willReturn($expected);

        $client = new ZettaiReachHttp($factory);

        $this->assertSame($expected, $client->get('https://example.test/status', ['q' => 'v']));
    }
}
