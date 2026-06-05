<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\NumberCleaning\Domains;

use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\ApiNumberCleaningDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Domains\ApiNumberCleaningDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\NumberCleaning\Request\NumberCleaningRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class ApiNumberCleaningDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('NumberCleaningDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる(): void
    {
        $psrResponse = new Psr7Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode([
                'responseCode'    => 0,
                'responseMessage' => 'Success.',
                'phoneNumber'     => '+819012345678',
                'carrierId'       => '101',
                'status'          => 'valid'
            ]),
        );
        $response = new Response($psrResponse);

        $zettaiReachHttpMock = $this->createMock(ZettaiReachHttpInterface::class);
        $zettaiReachHttpMock->expects($this->once())
            ->method('postForm')
            ->willReturn($response);
        $this->instance(ZettaiReachHttpInterface::class, $zettaiReachHttpMock);

        $numberCleaningRequestMock = $this->createMock(NumberCleaningRequestInterface::class);
        $numberCleaningRequestMock->expects($this->once())
            ->method('toArray')
            ->willReturn([
                'token'       => 'abcdefghijklmnopqrstuvwxyz012345',
                'clientId'    => '98765',
                'phoneNumber' => '09012345678',
            ]);

        /** @var ApiNumberCleaningDomain */
        $apiNumberCleaningDomain = app()->make(ApiNumberCleaningDomainInterface::class);
        $response = $apiNumberCleaningDomain->execute($numberCleaningRequestMock);
    }
}
