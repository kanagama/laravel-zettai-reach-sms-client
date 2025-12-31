<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\Template\Domains;

use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\TemplateDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Domains\TemplateDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\Template\Request\TemplateRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class TemplateDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('TemplateDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる()
    {
        $psrResponse = new Psr7Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode([
                'responseCode'    => 0,
                'responseMessage' => 'Success.',
                'count'           => 2,
                'templates'       => [
                    ['id' => '1', 'message' => 'テンプレート1'],
                    ['id' => '2', 'message' => 'テンプレート2']
                ]
            ]),
        );
        $response = new Response($psrResponse);

        $zettaiReachHttpMock = $this->createMock(ZettaiReachHttpInterface::class);
        $zettaiReachHttpMock->expects($this->once())
            ->method('get')
            ->willReturn($response);
        $this->instance(ZettaiReachHttpInterface::class, $zettaiReachHttpMock);

        $templateRequestMock = $this->createMock(TemplateRequestInterface::class);
        $templateRequestMock->expects($this->once())
            ->method('toArray')
            ->willReturn([
                'token'    => 'abcdefghijklmnopqrstuvwxyz012345',
                'smsCode'  => '123456',
                'clientId' => '98765',
            ]);

        /** @var TemplateDomain */
        $templateDomain = app()->make(TemplateDomainInterface::class);
        $response = $templateDomain->execute($templateRequestMock);
    }
}
