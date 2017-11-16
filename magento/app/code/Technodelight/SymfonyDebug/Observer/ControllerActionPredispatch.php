<?php

namespace Technodelight\SymfonyDebug\Observer;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\ExceptionHandler;
use Technodelight\SymfonyDebug\Debug\FileLinkFormatterFactory;

class ControllerActionPredispatch implements ObserverInterface
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

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        if ($this->config->isSetFlag(self::CONFIG_PATH_ENABLED)) {
            Debug::enable(E_ALL);
            ExceptionHandler::register(
                true,
                null,
                $this->factory->create()
            );
        }
    }
}
