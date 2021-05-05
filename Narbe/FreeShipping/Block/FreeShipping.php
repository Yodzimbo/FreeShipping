<?php

declare(strict_types = 1);

namespace Narbe\FreeShipping\Block;

use Magento\Framework\Escaper;
use Magento\Framework\View\Element\Template;

class FreeShipping extends \Magento\Framework\View\Element\Template
{
    protected $scopeConfig;

    protected $escaper;

    public function __construct(
        Escaper $escaper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        Template\Context $context,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->escaper = $escaper;

        parent::__construct($context, $data);
    }

    public function isEnabled()
    {
        return (boolean)$this->getConfigValue('narbe_free_shipping_config/content/enabled');
    }

    public function getValueFreeShipping()
    {
        return $this->getConfigValue('narbe_free_shipping_config/content/valueFreeShipping');
    }

    public function getMessageDefault()
    {
        return $this->getConfigValue('narbe_free_shipping_config/content/messageDefault');
    }

    public function getMessageItemsInCart()
    {
        return $this->getConfigValue('narbe_free_shipping_config/content/messageItemsInCart');
    }

    public function getMessageFreeShipping()
    {
        return $this->getConfigValue('narbe_free_shipping_config/content/messageFreeShipping');
    }

    private function getConfigValue(string $path)
    {
        return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getEscaper()
    {
        return $this->escaper;
    }
}
