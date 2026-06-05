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
    #[Group('parameters')]
    #[Group('Date')]
    public function 正しい形式と日付の場合、例外が発生しない(): void
    {
        $this->expectNotToPerformAssertions();

        Date::create('20240101');
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('Date')]
    public function 不正な形式の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Date::create('2024-01-01');
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('Date')]
    public function 不正な日付の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Date::create('20240230');
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('Date')]
    #[Group('value')]
    public function valueメソッドが正しく動作する(): void
    {
        $date = Date::create('20240101');

        $this->assertSame('20240101', $date->value());
    }
}
