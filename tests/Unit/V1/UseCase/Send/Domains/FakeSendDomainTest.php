<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\Send\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\FakeSendDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Domains\FakeSendDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Send\Request\SendRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class FakeSendDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('SendDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        $sendRequestMock = $this->createMock(SendRequestInterface::class);

        /** @var FakeSendDomain */
        $fakeSendDomain = app()->make(FakeSendDomainInterface::class);
        $response = $fakeSendDomain->execute($sendRequestMock);

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
