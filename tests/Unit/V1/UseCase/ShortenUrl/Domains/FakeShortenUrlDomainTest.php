<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\ShortenUrl\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\FakeShortenUrlDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Domains\FakeShortenUrlDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\ShortenUrl\Request\ShortenUrlRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class FakeShortenUrlDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('ShortenUrlDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        $shortenUrlRequestMock = $this->createMock(ShortenUrlRequestInterface::class);

        /** @var FakeShortenUrlDomain */
        $fakeShortenUrlDomain = app()->make(FakeShortenUrlDomainInterface::class);
        $response = $fakeShortenUrlDomain->execute($shortenUrlRequestMock);

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
