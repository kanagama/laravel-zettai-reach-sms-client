<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

use InvalidArgumentException;

/**
 * 予約確認・一括キャンセル用の任意識別文字列
 */
final class GroupTag implements ValueObjectInterface
{
    /**
     * @param string $value
     */
    public function __construct(
        private readonly string $value
    ) {
        // 1文字から200文字の半角英数字、記号（制御文字や改行は除外）
        if (!preg_match('/^[\x20-\x7E]{1,200}$/', $this->value) || preg_match('/[\x00-\x1F\x7F]/', $this->value)) {
            throw new InvalidArgumentException('clientTagは1文字から200文字の半角英数字、記号である必要があります。');
        }
    }

    /**
     * @test
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}