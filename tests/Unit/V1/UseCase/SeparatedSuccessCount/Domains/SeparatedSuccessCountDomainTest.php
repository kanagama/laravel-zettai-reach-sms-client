<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\UseCase\SeparatedSuccessCount\Domains;

use GuzzleHttp\Psr7\Response as Psr7Response;
use Illuminate\Http\Client\Response;
use Kanagama\ZettaiReachSmsClient\Http\ZettaiReachHttpInterface;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\SeparatedSuccessCountDomain;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Domains\SeparatedSuccessCountDomainInterface;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\V1\UseCase\SeparatedSuccessCount\Request\SeparatedSuccessCountRequestInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class SeparatedSuccessCountDomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('SeparatedSuccessCountDomain')]
    #[Group('execute')]
    public function 処理を正しく実行できる()
    {
        $psrResponse = new Psr7Response(
            200,
            ['Content-Type' => 'application/json'],
            json_encode([
                'responseCode'    => 0,
                'responseMessage' => 'Success.',
                'totalCount'      => 100,
                'separatedCount'  => [
                    [
                        'carrierId' => '101',
                        'count'     => 30
                    ],
                    [
                        'carrierId' => '103',
                        'count'     => 25
                    ],
                    [
                        'carrierId' => '105',
                        'count'     => 25
                    ],
                    [
                        'carrierId' => '106',
                        'count'     => 20
                    ]
                ]
            ]),
        );
        $response = new Response($psrResponse);

        $zettaiReachHttpMock = $this->createMock(ZettaiReachHttpInterface::class);
        $zettaiReachHttpMock->expects($this->once())
            ->method('get')
            ->willReturn($response);
        $this->instance(ZettaiReachHttpInterface::class, $zettaiReachHttpMock);

        $separatedSuccessCountRequestMock = $this->createMock(SeparatedSuccessCountRequestInterface::class);
        $separatedSuccessCountRequestMock->expects($this->once())
            ->method('toArray')
            ->willReturn([
                'token'     => 'abcdefghijklmnopqrstuvwxyz012345',
                'smsCode'   => '123456',
                'clientId'  => '98765',
                'startDate' => '20251201',
                'endDate'   => '20251231',
            ]);

        /** @var SeparatedSuccessCountDomain */
        $separatedSuccessCountDomain = app()->make(SeparatedSuccessCountDomainInterface::class);
        $response = $separatedSuccessCountDomain->execute($separatedSuccessCountRequestMock);
    }
}
