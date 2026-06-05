<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\Send\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\LogSendDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\LogSendDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Request\SendRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class LogSendDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('SendDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        Log::spy();

        $sendRequestMock = $this->createMock(SendRequestInterface::class);

        /** @var LogSendDomain */
        $logSendDomain = app()->make(LogSendDomainInterface::class);
        $response = $logSendDomain->execute($sendRequestMock);

        Log::shouldHaveReceived('info')
            ->once()
            ->with('zettaiReachSms send() Skipped.');

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
