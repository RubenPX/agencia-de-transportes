<?php

namespace Clases;
use stdClass;

class QueryParser {
    /**
     * Convert stdObject to array
     * @param mixed $data
     * @return array
     */
    public static function objToArray(stdClass $data): array {
        return json_decode(json_encode($data), true);
    }
}