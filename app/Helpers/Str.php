<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Support\Str as SupportStr;

class Str extends SupportStr
{

    public static function nameSlug(array $targetSlug, $model): string
    {
        $name_slug = SupportStr::slug(implode(' ', $targetSlug), '-');

        $query = $model::query();
        $usesSoftDeletes = in_array(SoftDeletes::class, class_uses_recursive($model), true);
        if ($usesSoftDeletes) {
            $query->withTrashed();
        }

        if($query->where('name_slug', '=', $name_slug)->exists()){
            $i = 1;
            $duplicateQuery = $model::query();
            if ($usesSoftDeletes) {
                $duplicateQuery->withTrashed();
            }

            while ($duplicateQuery->where('name_slug','=', $name_slug.'-'.$i)->exists()){
                $i ++;
                $duplicateQuery = $model::query();
                if ($usesSoftDeletes) {
                    $duplicateQuery->withTrashed();
                }
            }
            $name_slug .= '-'. $i;
        }

        return $name_slug;
    }

    public static function firstCharToLowercase(string $value): string
    {
        $firstChar = mb_substr($value, 0, 1);
        $firstChar = mb_strtolower($firstChar);
        $otherChars = mb_substr(
            $value,
            1,
            mb_strlen($value)
        );

        return $firstChar . $otherChars;
    }

    public static function getSubstringWithEllipsis($string, $length = 250): string
    {
        if (mb_strlen($string) <= $length) {
            return (string)$string;
        }

        $substring = mb_substr($string, 0, $length);
        $lastSpacePosition = mb_strrpos($substring, ' ');

        if ($lastSpacePosition !== false) {
            $substring = mb_substr($substring, 0, $lastSpacePosition);
        }

        return $substring . '...';
    }

    public static function customPlural($number, $zero, $one, $two, $five, $showZeroNumber = false, $showNumber = true): string
    {
        $number = abs($number);
        $numStr = $number . ' ';
        $ost = $number % 100;

        if ($number === 0) {
            return $showZeroNumber ? $numStr . $zero : $zero;
        }

        if ($ost >= 5 && $ost <= 20) {
            return $showNumber ? $numStr . $five : $five;
        }

        $ost %= 10;

        if ($ost === 1) {
            return $showNumber ? $numStr . $one : $one;
        }

        if ($ost >= 2 && $ost <= 4) {
            return $showNumber ? $numStr . $two : $two;
        }

        return $showNumber ? $numStr . $five : $five;
    }

}
