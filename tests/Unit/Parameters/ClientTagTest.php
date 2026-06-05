<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Tests\Unit\Parameters;

use InvalidArgumentException;
use Kanagama\ZettaiReachSmsClient\Tests\TestCase;
use Kanagama\ZettaiReachSmsClient\Parameters\ClientTag;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;

final class ClientTagTest extends TestCase
{
    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ClientTag')]
    public function 空の場合は例外を投げる(): void
    {
        $this->expectException(InvalidArgumentException::class);

        ClientTag::create('');
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ClientTag')]
    public function 文字数が200を超える場合は例外を投げる(): void
    {
        $this->expectException(InvalidArgumentException::class);

        ClientTag::create(str_repeat('a', 201));
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ClientTag')]
    public function 文字数が1の場合はオブジェクト化出来る(): void
    {
        $clientTag = ClientTag::create('a');

        $this->assertSame('a', $clientTag->value());
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ClientTag')]
    public function 文字数が200の場合はオブジェクト化出来る(): void
    {
        $value = str_repeat('a', 200);
        $clientTag = ClientTag::create($value);

        $this->assertSame($value, $clientTag->value());
    }

    #[Test]
    #[Group('unit')]
    #[Group('parameters')]
    #[Group('ClientTag')]
    public function 全角文字の場合は例外を投げる(): void
    {
        $this->expectException(InvalidArgumentException::class);

        ClientTag::create('あ');
    }
}
