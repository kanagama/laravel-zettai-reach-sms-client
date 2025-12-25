<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Kanagama\ZettaiReachSmsClient\Parameters\EndDate;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use InvalidArgumentException;

final class EndDateTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('EndDate')]
    public function 不正な形式の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new EndDate('2024-01-01');
    }

    #[Test]
    #[Group('unit')]
    #[Group('EndDate')]
    public function 不正な日付の場合、例外が発生する(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new EndDate('20240230');
    }

    #[Test]
    #[Group('unit')]
    #[Group('EndDate')]
    #[Group('value')]
    public function valueメソッドが正しく動作する(): void
    {
        $endDate = new EndDate('20240101');

        $this->assertSame('20240101', $endDate->value());
    }
}
