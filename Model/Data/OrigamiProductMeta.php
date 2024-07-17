<?php

namespace Origami\Vendor\Model\Data;

use Magento\Framework\Model\AbstractModel;

class OrigamiProductMeta extends AbstractModel implements \Origami\Vendor\Api\Data\OrigamiProductMetaInterface
{
    /**
     * @inheritDoc
     */
    public function setMetaTitle($value)
    {
        $this->setData($this::meta_title, $value);
    }

    /**
     * @inheritDoc
     */
    public function getMetaTitle()
    {
        return $this->getData($this::meta_title);
    }

    /**
     * @inheritDoc
     */
    public function setMetaDescription($value)
    {
        $this->setData($this::meta_description, $value);
    }

    /**
     * @inheritDoc
     */
    public function getMetaDescription()
    {
        return $this->getData($this::meta_description);
    }


    /**
     * @inheritDoc
     */
    public function setMetaKeywords($value)
    {
        $this->setData($this::meta_keywords, $value);
    }

    /**
     * @inheritDoc
     */
    public function getMetaKeywords()
    {
        return $this->getData($this::meta_keywords);
    }
}
