<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\NumberCleaning\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\LogNumberCleaningDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\LogNumberCleaningDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Request\NumberCleaningRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class LogNumberCleaningDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('NumberCleaningDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        Log::spy();

        $numberCleaningRequestMock = $this->createMock(NumberCleaningRequestInterface::class);

        /** @var LogNumberCleaningDomain */
        $logNumberCleaningDomain = app()->make(LogNumberCleaningDomainInterface::class);
        $response = $logNumberCleaningDomain->execute($numberCleaningRequestMock);

        Log::shouldHaveReceived('info')
            ->once()
            ->with('zettaiReachSms numberCleaning() Skipped.');

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);    }
}
