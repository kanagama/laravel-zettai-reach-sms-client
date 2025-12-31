<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Kanagama\ZettaiReachSmsClient\Parameters\StartDate;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use InvalidArgumentException;

final class StartDateTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('StartDate')]
    public function 不正な形式の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new StartDate('2024-01-01');
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('StartDate')]
    public function 不正な日付の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new StartDate('20240230');
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('StartDate')]
    #[Group('value')]
    public function valueメソッドが正しく動作する(): void
    {
        $startDate = new StartDate('20240101');

        $this->assertSame('20240101', $startDate->value());
    }
}
