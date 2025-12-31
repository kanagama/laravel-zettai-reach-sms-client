<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use InvalidArgumentException;
use Kanagama\ZettaiReachSmsClient\Parameters\ScheduleTime;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class ScheduleTimeTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ScheduleTime')]
    public function 不正な形式の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ScheduleTime('2024/01/01 12:00');
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ScheduleTime')]
    public function 不正な日付の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ScheduleTime('2024-02-30 12:00');
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ScheduleTime')]
    #[Group('value')]
    public function valueメソッドが正しく動作する(): void
    {
        $scheduleTime = new ScheduleTime('2024-01-01 12:00');

        $this->assertSame('2024-01-01 12:00', $scheduleTime->value());
    }
}
