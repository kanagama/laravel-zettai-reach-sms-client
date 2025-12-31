<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\ShortenUrl\Request;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Config;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Request\ShortenUrlRequest;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class ShortenUrlRequestTest extends TestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        CarbonImmutable::setTestNow(
            CarbonImmutable::create(2025, 12, 25, 12, 0, 0)
        );

        Config::set('zettai-reach-sms.token', 'abcdefghijklmnopqrstuvwxyz012345');
        Config::set('zettai-reach-sms.client_id', '98765');
        Config::set('zettai-reach-sms.sms_code', '123456');
    }

    #[Test]
    #[Group('unit')]
    #[Group('ShortenUrlRequest')]
    #[Group('toAll')]
    public function toAllが正しく配列を返す(): void
    {
        $shortenUrlRequest = new ShortenUrlRequest(
            longUrl: 'https://example.com/very/long/url/path',
            domain: 'short.example.com'
        );

        $this->assertSame([
            'token'    => 'abcdefghijklmnopqrstuvwxyz012345',
            'clientId' => '98765',
            'longUrl'  => 'https://example.com/very/long/url/path',
            'domain'   => 'short.example.com',
        ], $shortenUrlRequest->toAll());
    }

    #[Test]
    #[Group('unit')]
    #[Group('ShortenUrlRequest')]
    #[Group('toArray')]
    public function toArrayが正しく配列を返す(): void
    {
        $shortenUrlRequest = new ShortenUrlRequest(
            longUrl: 'https://example.com/very/long/url/path',
        );

        $this->assertSame([
            'token'    => 'abcdefghijklmnopqrstuvwxyz012345',
            'clientId' => '98765',
            'longUrl'  => 'https://example.com/very/long/url/path',
        ], $shortenUrlRequest->toArray());
    }
}
