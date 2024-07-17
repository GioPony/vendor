<?php

namespace Origami\Vendor\Model\Data;

use Magento\Framework\Model\AbstractModel;

class OrigamiCatalogApi extends AbstractModel implements \Origami\Vendor\Api\Data\OrigamiCatalogApiInterface
{
    public $products = [];
    public $categories = [];

    /**
     * @inheritDoc
     */
    public function getProducts()
    {
        return $this->getData($this::PRODUCTS);
    }

    /**
     * @inheritDoc
     */
    public function setProducts($value)
    {
        $this->setData($this::PRODUCTS, $value);
    }

    /**
     * @inheritDoc
     */
    public function addProduct($value)
    {
        $this->products[] = $value;
        $this->setData($this::PRODUCTS, $this->products);
    }

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
