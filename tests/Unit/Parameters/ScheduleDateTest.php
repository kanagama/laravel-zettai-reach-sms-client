<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use InvalidArgumentException;
use Kanagama\ZettaiReachSmsClient\Parameters\ScheduleDate;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;

final class ScheduleDateTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ScheduleDate')]
    public function 不正な形式の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ScheduleDate('2024-01-01');
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ScheduleDate')]
    public function 不正な日付の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ScheduleDate('20240230');
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ScheduleDate')]
    #[Group('value')]
    public function valueメソッドが正しく動作する(): void
    {
        $scheduleDate = new ScheduleDate('20240101');

        $this->assertSame('20240101', $scheduleDate->value());
    }
}
