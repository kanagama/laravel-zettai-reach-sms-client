<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\ShortenUrl\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\LogShortenUrlDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\LogShortenUrlDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Request\ShortenUrlRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class LogShortenUrlDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('ShortenUrlDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        Log::spy();

        $shortenUrlRequestMock = $this->createMock(ShortenUrlRequestInterface::class);

        /** @var LogShortenUrlDomain */
        $logShortenUrlDomain = app()->make(LogShortenUrlDomainInterface::class);
        $response = $logShortenUrlDomain->execute($shortenUrlRequestMock);

        Log::shouldHaveReceived('info')
            ->once()
            ->with('zettaiReachSms shorterUrl() Skipped.');

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
