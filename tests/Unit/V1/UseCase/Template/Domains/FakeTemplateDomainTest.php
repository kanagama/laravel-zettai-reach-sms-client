<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\Template\Domains;

use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\FakeTemplateDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\FakeTemplateDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Request\TemplateRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class FakeTemplateDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('TemplateDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        $templateRequestMock = $this->createMock(TemplateRequestInterface::class);

        /** @var FakeTemplateDomain */
        $fakeTemplateDomain = app()->make(FakeTemplateDomainInterface::class);
        $response = $fakeTemplateDomain->execute($templateRequestMock);

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
