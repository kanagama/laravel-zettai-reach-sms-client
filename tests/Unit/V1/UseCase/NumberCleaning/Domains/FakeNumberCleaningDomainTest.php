<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\NumberCleaning\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\FakeNumberCleaningDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\FakeNumberCleaningDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Request\NumberCleaningRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class FakeNumberCleaningDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('NumberCleaningDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        $numberCleaningRequestMock = $this->createMock(NumberCleaningRequestInterface::class);

        /** @var FakeNumberCleaningDomain */
        $fakeNumberCleaningDomain = app()->make(FakeNumberCleaningDomainInterface::class);
        $response = $fakeNumberCleaningDomain->execute($numberCleaningRequestMock);

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
