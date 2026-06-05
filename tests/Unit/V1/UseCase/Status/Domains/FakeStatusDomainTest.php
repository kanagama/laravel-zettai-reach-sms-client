<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\Status\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\FakeStatusDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Domains\FakeStatusDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Status\Request\StatusRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class FakeStatusDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('StatusDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        $statusRequestMock = $this->createMock(StatusRequestInterface::class);

        /** @var FakeStatusDomain */
        $fakeStatusDomain = app()->make(FakeStatusDomainInterface::class);
        $response = $fakeStatusDomain->execute($statusRequestMock);

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
