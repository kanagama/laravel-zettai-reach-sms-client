<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Parameters;

/**
 * 予約確認・一括キャンセル用の任意識別文字列
 */
final class ClientTag implements ValueObjectInterface
{
    /**
     * @param string $value
     */
    public function __construct(
        private readonly string $value
    ) {
        // 1文字から200文字の半角英数字、記号
        if (!preg_match('/^[\x20-\x7E]{1,200}$/', $this->value)) {
            throw new \InvalidArgumentException('clientTagは1文字から200文字の半角英数字、記号である必要があります。');
        }
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}