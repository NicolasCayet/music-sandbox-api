<?php

namespace App\CoreBundle\Utils;

/**
 * This class is used as service to provide helpful methods about string manipulation
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
    public function getShortClassName($className)
    {
        $path = explode('\\', $className);

        return array_pop($path);
    }
}