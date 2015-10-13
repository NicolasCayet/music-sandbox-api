<?php

namespace App\CoreBundle\Utils;

/**
 * This class is used as service to provide helpful methods about string manipulation
 *
 * Also expose static function to be used everywhere in the app
 *
 * @package App\CoreBundle\Utils
 */
class String {
    /**
     * Transform a full class name to its short version (without namespace)
     *
     * @param string $className
     *
     * @return string
     */
    public static function getShortClassName($className)
    {
        $path = explode('\\', $className);

        return array_pop($path);
    }
}