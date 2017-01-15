<?php

namespace Zwaldeck\Core\DependencyInjection\Service;

/**
 * Class ConstructArgumentType
 * @package Zwaldeck\Core\DependencyInjection\Service
 */
abstract class ConstructorArgumentType
{
    const PLAIN = 'PLAIN';
    const PARAMETER = 'PARAMETER';
    const SERVICE = 'SERVICE';
    const ARRAY = 'ARRAY';

    public static function validType(string $type) {
        $types = [
            'PLAIN',
            'PARAMETER',
            'SERVICE',
            'ARRAY'
        ];

        return in_array($type, $types);
    }
}