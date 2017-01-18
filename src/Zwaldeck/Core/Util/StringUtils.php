<?php

namespace Zwaldeck\Core\Util;

/**
 * Class StringUtils
 * @package Zwaldeck\Core\Util
 */
class StringUtils
{
    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    public static function startsWith(string $haystack, string $needle): bool {
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    public static function endsWith(string $haystack, string $needle): bool {
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    public static function contains(string $haystack, string $needle): bool {
        return strpos($haystack, $needle) !== FALSE;
    }
}