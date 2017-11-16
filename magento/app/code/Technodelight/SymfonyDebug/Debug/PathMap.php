<?php

namespace Technodelight\SymfonyDebug\Debug;

class PathMap
{
    private $pathMappings = [];

    public static function fromString($string)
    {
        $instance = new static;
        $lines = explode(PHP_EOL, $string);
        foreach ($lines as $line) {
            list($from, $to) = explode(PATH_SEPARATOR, $line, 2);
            $instance->pathMappings[$from] = $to;
        }

        return $instance;
    }

    public function map($path)
    {
        foreach ($this->pathMappings as $from => $to) {
            if (strpos($path, $from) === 0) {
                return $to . substr($path, strlen($from));
            }
        }

        return $path;
    }
}
