<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\Status\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\LogStatusDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\LogStatusDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Request\StatusRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class LogStatusDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('StatusDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        Log::spy();

        $statusRequestMock = $this->createMock(StatusRequestInterface::class);

        /** @var LogStatusDomain */
        $logStatusDomain = app()->make(LogStatusDomainInterface::class);
        $response = $logStatusDomain->execute($statusRequestMock);

        Log::shouldHaveReceived('info')
            ->once()
            ->with('zettaiReachSms status() Skipped.');

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
