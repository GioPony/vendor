<?php

namespace Origami\Vendor\Model\Data;

use Magento\Framework\Model\AbstractModel;

class OrigamiCategoriesApi extends AbstractModel implements \Origami\Vendor\Api\Data\OrigamiCategoriesApiInterface
{
    public $categories = [];

    /**
     * @inheritDoc
     */
    public function getCategories()
    {
        return $this->getData($this::CATEGORIES);
    }

    /**
     * @inheritDoc
     */
    public function setCategories($value)
    {
        $this->setData($this::CATEGORIES, $value);
    }

    /**
     * @inheritDoc
     */
    public function addCategory($value)
    {
        $this->categories[] = $value;
        $this->setData($this::CATEGORIES, $this->categories);
    }

    /**
     * @inheritDoc
     */
    public function setPagination($value)
    {
        $this->setData($this::PAGINATION, $value);
    }

    /**
     * @inheritDoc
     */
    public function getPagination()
    {
        return $this->getData($this::PAGINATION);
    }
}
