<?php

namespace Origami\Vendor\Model\Data;

use Magento\Framework\Model\AbstractModel;

class OrigamiCategory extends AbstractModel implements \Origami\Vendor\Api\Data\OrigamiCategoryInterface
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
    public function setFullName($value)
    {
        $this->setData($this::full_name, $value);
    }

    /**
     * @inheritDoc
     */
    public function getFullName()
    {
        return $this->getData($this::full_name);
    }

    /**
     * @inheritDoc
     */
    public function setIdCategoryParent($value)
    {
        $this->setData($this::id_category_parent, $value);
    }

    /**
     * @inheritDoc
     */
    public function getIdCategoryParent()
    {
        return $this->getData($this::id_category_parent);
    }

    /**
     * @inheritDoc
     */
    public function setDescription($value)
    {
        $this->setData($this::description, $value);
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return $this->getData($this::description);
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
