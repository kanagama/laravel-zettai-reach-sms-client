<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Kanagama\ZettaiReachSmsClient\Parameters\GroupTag;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use InvalidArgumentException;

final class GroupTagTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('GroupTag')]
    public function 正しい形式の場合、例外が発生しない(): void
    {
        $this->expectNotToPerformAssertions();

        new GroupTag('ValidTag123!@#');
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('GroupTag')]
    #[Group('error')]
    public function 不正な形式の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new GroupTag("InvalidTag\n");
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('GroupTag')]
    #[Group('value')]
    public function valueメソッドが正しく動作する(): void
    {
        $groupTag = new GroupTag('TestTag');

        $this->assertSame('TestTag', $groupTag->value());
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('GroupTag')]
    public function 文字数が200を超える場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $longTag = str_repeat('a', 201);
        new GroupTag($longTag);
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('GroupTag')]
    public function 空文字の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new GroupTag('');
    }
}
