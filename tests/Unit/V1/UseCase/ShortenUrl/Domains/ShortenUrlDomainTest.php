<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\ShortenUrl\Domains;

use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\ShortenUrlDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\ShortenUrlDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Request\ShortenUrlRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class ShortenUrlDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('ShortenUrlDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる()
    {
        $psrResponse = new Psr7Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode([
                'responseCode'    => 0,
                'responseMessage' => 'Success.',
                'shortUrl'        => 'https://short.example.com/abc123'
            ]),
        );
        $response = new Response($psrResponse);

        $zettaiReachHttpMock = $this->createMock(ZettaiReachHttpInterface::class);
        $zettaiReachHttpMock->expects($this->once())
            ->method('postForm')
            ->willReturn($response);
        $this->instance(ZettaiReachHttpInterface::class, $zettaiReachHttpMock);

        $shortenUrlRequestMock = $this->createMock(ShortenUrlRequestInterface::class);
        $shortenUrlRequestMock->expects($this->once())
            ->method('toArray')
            ->willReturn([
                'token'    => 'abcdefghijklmnopqrstuvwxyz012345',
                'clientId' => '98765',
                'longUrl'  => 'https://example.com/very/long/url/path',
            ]);

        /** @var ShortenUrlDomain */
        $shortenUrlDomain = app()->make(ShortenUrlDomainInterface::class);
        $response = $shortenUrlDomain->execute($shortenUrlRequestMock);
    }
}
