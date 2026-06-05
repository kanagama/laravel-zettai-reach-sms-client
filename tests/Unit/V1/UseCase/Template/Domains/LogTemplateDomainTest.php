<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\Template\Domains;

use Illuminate\Support\Facades\Log;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\LogTemplateDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\LogTemplateDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Request\TemplateRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class LogTemplateDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('TemplateDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        Log::spy();

        $templateRequestMock = $this->createMock(TemplateRequestInterface::class);

        /** @var LogTemplateDomain */
        $logTemplateDomain = app()->make(LogTemplateDomainInterface::class);
        $response = $logTemplateDomain->execute($templateRequestMock);

        Log::shouldHaveReceived('info')
            ->once()
            ->with('zettaiReachSms template() Skipped.');

        $this->assertSame([
            'responseCode'    => 0,
            'responseMessage' => 'Success',
        ], $response);
    }
}
