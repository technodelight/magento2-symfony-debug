<?php

namespace Technodelight\SymfonyDebug\Plugin;

use Magento\Framework\App\Bootstrap;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Http;
use Symfony\Component\Debug\ExceptionHandler;
use Technodelight\SymfonyDebug\Debug\FileLinkFormatterFactory;

class CatchException
{
    const CONFIG_PATH_ENABLED = 'dev/technodelight_symfonydebug/enabled';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $config;
    /**
     * @var \Technodelight\SymfonyDebug\Debug\FileLinkFormatterFactory
     */
    private $factory;

    public function __construct(ScopeConfigInterface $config, FileLinkFormatterFactory $factory)
    {
        $this->config = $config;
        $this->factory = $factory;
    }

    public function beforeCatchException(Http $app, Bootstrap $bootstrap, \Exception $exception)
    {
        if ($bootstrap->isDeveloperMode() && $this->config->isSetFlag(self::CONFIG_PATH_ENABLED)) {
            $exceptionHandler = new ExceptionHandler(true, null, $this->factory->create());
            $exceptionHandler->handle($exception);

            return true;
        }
    }
}
