<?php

namespace Technodelight\SymfonyDebug\Debug;

class FileLinkFormatter
{
    /**
     * @var \Technodelight\SymfonyDebug\Debug\PathMap
     */
    private $pathMap;
    /**
     * @var string
     */
    private $fileLinkFormat;

    public function __construct(PathMap $pathMap, $fileLinkFormat)
    {
        $this->pathMap = $pathMap;
        $this->fileLinkFormat = $fileLinkFormat;
    }

    public function format($path, $line)
    {
        return strtr(
            $this->fileLinkFormat,
            ['%f' => $this->pathMap->map($path), '%l' => $line]
        );
    }
}
