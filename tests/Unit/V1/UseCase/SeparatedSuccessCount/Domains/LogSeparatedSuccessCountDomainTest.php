<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\SeparatedSuccessCount\Domains;

use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\LogSeparatedSuccessCountDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\LogSeparatedSuccessCountDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Request\SeparatedSuccessCountRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class LogSeparatedSuccessCountDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('SeparatedSuccessCountDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        Log::spy();

        $separatedSuccessCountRequest = $this->createMock(SeparatedSuccessCountRequestInterface::class);

        /** @var LogSeparatedSuccessCountDomain */
        $logSeparatedSuccessCountDomain = app()->make(LogSeparatedSuccessCountDomainInterface::class);
        $response = $logSeparatedSuccessCountDomain->execute($separatedSuccessCountRequest);

        Log::shouldHaveReceived('info')
            ->once()
            ->with('zettaiReachSms separatedSuccessCount() Skipped.');

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
