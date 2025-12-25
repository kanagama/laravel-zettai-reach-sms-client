<?php
declare(strict_types=1);

namespace Kanagama\ZettaiReachSmsClient\Validator;

use Carbon\CarbonImmutable;

/**
 * 日付バリデータ
 */
final class DateValidator
{
    /**
     * Ymm形式かどうか判定
     *
     * @return bool
     */
    public static function isYmdFormat(string $value): bool
    {
        return preg_match('/^\d{8}$/', $value) === 1;
    }

    /**
     * Ymm形式かどうか判定
     *
     * @return bool
     */
    public static function isYmFormat(string $value): bool
    {
        return preg_match('/^\d{6}$/', $value) === 1;
    }

    /**
     * YYYY-mm-dd H:i形式かどうか判定
     *
     * @param  string  $value
     * @return bool
     */
    public static function isYmdHiFormat(string $value): bool
    {
        return preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/', $value) === 1;
    }

    /**
     * 二年前までの日付かどうか判定
     *
     * @return bool
     */
    public static function isNotBeforeTwoYearsAgo(string $value): bool
    {
        if (!self::isYmdFormat($value)) {
            return false;
        }

        $date = CarbonImmutable::createFromFormat('Ymd', $value);
        $now = CarbonImmutable::now();
        $twoYearsAgo = $now->subYears(2)->startOfDay();

        return !($date < $twoYearsAgo || $date > $now);
    }

    /**
     * 正しい日付かどうか判定
     *
     * @return bool
     */
    public static function isYmdValidDate(string $value): bool
    {
        $year = (int) substr($value, 0, 4);
        $month = (int) substr($value, 4, 2);
        $day = (int) substr($value, 6, 2);

        return checkdate($month, $day, $year);
    }

    /**
     * 正しい年月かどうか判定
     *
     * @return bool
     */
    public static function isYmValidDate(string $value): bool
    {
        $year = (int) substr($value, 0, 4);
        $month = (int) substr($value, 4, 2);

        return checkdate($month, 1, $year);
    }

    /**
     * 当月以前の日付かどうか判定
     *
     * @return bool
     */
    public static function isNotAfterThisMonth(string $value): bool
    {
        if (!self::isYmFormat($value)) {
            return false;
        }

        $date = CarbonImmutable::createFromFormat('Ym', $value)->endOfMonth();
        $now = CarbonImmutable::now()->endOfMonth();

        return $date <= $now;
    }
}
