<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Kanagama\ZettaiReachSmsClient\Parameters\Date;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use InvalidArgumentException;

final class DateTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('Date')]
    #[Group('__construct')]
    public function 正しい形式と日付の場合、例外が発生しない(): void
    {
        $this->expectNotToPerformAssertions();

        new Date('20240101');
    }

    #[Test]
    #[Group('unit')]
    #[Group('Date')]
    public function 不正な形式の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Date('2024-01-01');
    }

    #[Test]
    #[Group('unit')]
    #[Group('Date')]
    public function 不正な日付の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Date('20240230');
    }

    #[Test]
    #[Group('unit')]
    #[Group('Date')]
    #[Group('value')]
    public function valueメソッドが正しく動作する(): void
    {
        $date = new Date('20240101');

        $this->assertSame('20240101', $date->value());
    }
}
