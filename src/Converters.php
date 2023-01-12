<?php

namespace Clases;
use stdClass;

class Converters {
    /**
     * Convert stdObject to array
     * @param mixed $data
     * @return array
     */
    public static function objToArray(stdClass $data): array {
        return json_decode(json_encode($data), true);
    }

    /**
     * Convert stdObjects to arrays
     * @param array $data
     * @return array
     */
    public static function objsToArray(array $data): array {
        $func = function ($n) {
            return Converters::objToArray($n);
        };

        return array_map($func, $data);
    }
}