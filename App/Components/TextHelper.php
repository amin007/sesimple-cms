<?php

namespace App\Components;

// vendors
use League\CommonMark\CommonMarkConverter;

class TextHelper
{
    /**
     * Slugify Strings
     *
     * Based on Laravel's Helper :: str_slug();
     *
     * @param  string $str
     * @param  string $delimiter
     * @return string
     */
    public static function slugify($str, $separator = '-')
    {
        // Convert all dashes/underscores into separator
        $flip = $separator == '-' ? '_' : '-';
        $str = preg_replace('!['.preg_quote($flip).']+!u', $separator, $str);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $str = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($str));

        // Replace all separator characters and whitespace by a single separator
        $str = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $str);

        return trim($str, $separator);
    }

    public static function markdownToHtml($str)
    {
        $converter = new CommonMarkConverter();
        return $converter->convertToHtml($str);
    }
}
