<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Origami\Vendor\Model\Config\Backend;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\RequestInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Math\Random;
use Magento\Framework\App\Config\Storage\WriterInterface;


/**
 * Encrypted config field backend model.
 *
 * @api
 * @since 100.0.2
 */
class MagentoApiToken extends \Magento\Framework\App\Config\Value
{
    /**
     * @var \Magento\Framework\Encryption\EncryptorInterface
     */
    protected $_encryptor;
    protected RequestInterface $request;
    protected Random $random;
    protected WriterInterface $configWriter;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $config
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\Encryption\EncryptorInterface $encryptor
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->_encryptor = $encryptor;

        $this->request = ObjectManager::getInstance()->get(RequestInterface::class);
        $this->configWriter = ObjectManager::getInstance()->get(WriterInterface::class);
        $this->random = ObjectManager::getInstance()->get(Random::class);
        $this->storeManager = ObjectManager::getInstance()->get(\Magento\Store\Model\StoreManagerInterface::class);

        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    public function afterSave()
    {
        $result = parent::afterSave();
        $website = $this->request->getParam('website');
        if (empty($website)) {
            $website = $this->storeManager->getDefaultStoreView()->getWebsite()->getId();
        }

        var_dump($website);
        die();

        if (!$result->getValue() || empty($result->getValue()))
            $this->configWriter->save("origami_vendor/config/magento_api_token", $this->random->getRandomString(16), ScopeInterface::SCOPE_WEBSITES, $website);

        return $result;
    }
}