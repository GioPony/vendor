<?php

namespace Origami\Vendor\Model\Data;

use Magento\Framework\Model\AbstractModel;

class OrigamiProductCategory extends AbstractModel implements \Origami\Vendor\Api\Data\OrigamiProductCategoryInterface
{
    /**
     * @inheritDoc
     */
    public function setIdCategory($value)
    {
        $this->setData($this::id_category, $value);
    }

    /**
     * @inheritDoc
     */
    public function getIdCategory()
    {
        return $this->getData($this::id_category);
    }

    /**
     * @inheritDoc
     */
    public function setName($value)
    {
        $this->setData($this::name, $value);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData($this::name);
    }


    /**
     * @inheritDoc
     */
    public function setLinkRewrite($value)
    {
        $this->setData($this::link_rewrite, $value);
    }

    /**
     * @inheritDoc
     */
    public function getLinkRewrite()
    {
        return $this->getData($this::link_rewrite);
    }
}
