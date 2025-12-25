<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Kanagama\ZettaiReachSmsClient\Parameters\LongUrl;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use InvalidArgumentException;

final class LongUrlTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('LongUrl')]
    public function 文字数が2048を超える場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $longUrl = 'https://example.com/' . str_repeat('a', 2040);
        new LongUrl($longUrl);
    }

    #[Test]
    #[Group('unit')]
    #[Group('LongUrl')]
    public function 空文字の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new LongUrl('');
    }

    #[Test]
    #[Group('unit')]
    #[Group('LongUrl')]
    #[Group('value')]
    public function valueメソッドが正しく動作する(): void
    {
        $longUrl = new LongUrl('https://example.com/test');

        $this->assertSame('https://example.com/test', $longUrl->value());
    }
}