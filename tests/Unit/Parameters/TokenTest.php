<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Illuminate\Support\Facades\Config;
use InvalidArgumentException;
use Kanagama\ZettaiReachSmsClient\Parameters\Token;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class TokenTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('Token')]
    #[Group('value')]
    public function valueメソッドが正しく動作する(): void
    {
        $valueToken = 'abcdefghijklmnopqrstuvwxzy123456';

        Config::set('zettai-reach-sms.token', $valueToken);

        $token = new Token();
        $this->assertSame($valueToken, $token->value());
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('Token')]
    public function 設定が見つからない場合例外を投げる()
    {
        $this->expectException(InvalidArgumentException::class);

        Config::set('zettai-reach-sms.token', null);

        new Token();
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('Token')]
    #[DataProvider('exceptionProvider')]
    public function 指定文字数でない場合例外を投げる(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);

        Config::set('zettai-reach-sms.token', $value);

        new Token();
    }

    /**
     * @return array
     */
    public static function exceptionProvider(): array
    {
        return [
            '31文字' => [
                'abcdefghijklmnopqrstuvwxzy12345',
            ],
            '33文字' => [
                'abcdefghijklmnopqrstuvwxzy1234567',
            ],
            '特殊文字含む' => [
                'abcd!fghij@lmnopqr$tuvwxzy123456',
            ],
        ];
    }
}
