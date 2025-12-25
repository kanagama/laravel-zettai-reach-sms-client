<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Kanagama\ZettaiReachSmsClient\Parameters\Month;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use InvalidArgumentException;

final class MonthTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('Month')]
    public function 不正な形式の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Month('2024-01');
    }

    #[Test]
    #[Group('unit')]
    #[Group('Month')]
    public function 存在しない年月の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Month('202413');
    }

    #[Test]
    #[Group('unit')]
    #[Group('Month')]
    public function 将来の年月の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $nextMonth = now()->addMonth()->format('Ym');
        new Month($nextMonth);
    }

    #[Test]
    #[Group('unit')]
    #[Group('Month')]
    #[Group('value')]
    public function valueメソッドが正しく動作する(): void
    {
        $month = new Month('202401');

        $this->assertSame('202401', $month->value());
    }
}
