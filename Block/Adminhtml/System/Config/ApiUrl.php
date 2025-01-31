<?php

namespace Origami\Vendor\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Store\Model\ScopeInterface;

class ApiUrl extends Field
{
    /**
     * Render the element value
     *
     * @param AbstractElement $element
     * @return string
     */
    protected function _renderValue(AbstractElement $element)
    {
        $storeManager = ObjectManager::getInstance()->get(StoreManagerInterface::class);
        $scopeConfig = ObjectManager::getInstance()->get(ScopeConfigInterface::class);
        $request= ObjectManager::getInstance()->get(RequestInterface::class);

        $website = $request->getParam('website');
        $key = $scopeConfig->getValue('origami_vendor/config/magento_api_token', ScopeInterface::SCOPE_WEBSITES, $website);

        $apiUrl = $storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_WEB) . "rest/all/V1/origami/vendor/api?key=$key";

        $html = '<td class="value">';
        $html .= '<span id="' . $element->getHtmlId() . '">' . $apiUrl . '</span>';
        $html .= '</td>';

        return $html;
    }
}