<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Kanagama\ZettaiReachSmsClient\Parameters\Message;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use InvalidArgumentException;

final class MessageTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('Message')]
    public function 文字数が660を超える場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $longMessage = str_repeat('あ', 661);
        new Message($longMessage);
    }

    #[Test]
    #[Group('unit')]
    #[Group('Message')]
    public function 空文字の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Message('');
    }

    #[Test]
    #[Group('unit')]
    #[Group('Message')]
    #[Group('value')]
    public function valueメソッドが正しく動作する(): void
    {
        $message = new Message('テストメッセージ');

        $this->assertSame('テストメッセージ', $message->value());
    }
}
