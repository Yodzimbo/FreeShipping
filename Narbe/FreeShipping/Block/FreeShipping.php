<?php

declare(strict_types = 1);

namespace Narbe\FreeShipping\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Escaper;
use Magento\Framework\View\Element\Template;

/**
 * Class FreeShipping
 * @package Narbe\FreeShipping\Block
 */
class FreeShipping extends \Magento\Framework\View\Element\Template
{
    private $scopeConfig;

    /**
     * FreeShipping constructor.
     * @param Escaper $escaper
     * @param ScopeConfigInterface $scopeConfig
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        Escaper $escaper,
        ScopeConfigInterface $scopeConfig,
        Template\Context $context,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->escaper = $escaper;

        parent::__construct($context, $data);
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (boolean)$this->getConfigValue('narbe_free_shipping_config/content/enabled');
    }

    /**
     * @return mixed
     */
    public function getValueFreeShipping()
    {
        return $this->getConfigValue('narbe_free_shipping_config/content/valueFreeShipping');
    }

    /**
     * @return mixed
     */
    public function getMessageDefault()
    {
        return $this->getConfigValue('narbe_free_shipping_config/content/messageDefault');
    }

    /**
     * @return mixed
     */
    public function getMessageItemsInCart()
    {
        return $this->getConfigValue('narbe_free_shipping_config/content/messageItemsInCart');
    }

    /**
     * @return mixed
     */
    public function getMessageFreeShipping()
    {
        return $this->getConfigValue('narbe_free_shipping_config/content/messageFreeShipping');
    }

    /**
     * @param string $path
     * @return mixed
     */
    private function getConfigValue(string $path)
    {
        return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
