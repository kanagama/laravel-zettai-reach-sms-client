<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\SeparatedSuccessCount\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\FakeSeparatedSuccessCountDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\FakeSeparatedSuccessCountDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Request\SeparatedSuccessCountRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class FakeSeparatedSuccessCountDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('SeparatedSuccessCountDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        $separatedSuccessCountRequest = $this->createMock(SeparatedSuccessCountRequestInterface::class);

        /** @var FakeSeparatedSuccessCountDomain */
        $fakeSeparatedSuccessCountDomain = app()->make(FakeSeparatedSuccessCountDomainInterface::class);
        $response = $fakeSeparatedSuccessCountDomain->execute($separatedSuccessCountRequest);

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
