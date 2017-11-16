<?php

namespace Technodelight\SymfonyDebug\Debug;

use Magento\Framework\App\Config\ScopeConfigInterface;

class FileLinkFormatterFactory
{
    const CONFIG_PATH_FORMAT = 'dev/technodelight_symfonydebug/file_link_format';
    const CONFIG_PATH_MAPPING = 'dev/technodelight_symfonydebug/path_maps';
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $config;

    public function __construct(ScopeConfigInterface $config)
    {
        $this->config = $config;
    }

    public function create()
    {
        return new FileLinkFormatter(
            PathMap::fromString($this->config->getValue(self::CONFIG_PATH_MAPPING)),
            $this->config->getValue(self::CONFIG_PATH_FORMAT)
        );
    }
}
