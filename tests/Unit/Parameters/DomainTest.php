<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use Kanagama\ZettaiReachSmsClient\Parameters\Domain;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;

final class DomainTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('Domain')]
    #[Group('value')]
    public function valueメソッドが正しく動作する(): void
    {
        $domain = new Domain('example.com');

        $this->assertSame('example.com', $domain->value());
    }
}
