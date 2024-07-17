<?php

namespace Origami\Vendor\Model\Data;

use Magento\Framework\Model\AbstractModel;

class OrigamiPagination extends AbstractModel implements \Origami\Vendor\Api\Data\OrigamiPaginationInterface
{
    /**
     * @inheritDoc
     */
    public function setTotalProducts($value)
    {
        $this->setData($this::TOTAL_PRODUCTS, $value);
    }

    /**
     * @inheritDoc
     */
    public function getTotalProducts()
    {
        return $this->getData($this::TOTAL_PRODUCTS);
    }

    /**
     * @inheritDoc
     */
    public function setTotalPages($value)
    {
        $this->setData($this::TOTAL_PAGES, $value);
    }

    /**
     * @inheritDoc
     */
    public function getTotalPages()
    {
        return $this->getData($this::TOTAL_PAGES);
    }

    /**
     * @inheritDoc
     */
    public function setPageNumber($value)
    {
        $this->setData($this::PAGE_NUMBER, $value);
    }

    /**
     * @inheritDoc
     */
    public function getPageNumber()
    {
        return $this->getData($this::PAGE_NUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setPageSize($value)
    {
        $this->setData($this::PAGE_SIZE, $value);
    }

    /**
     * @inheritDoc
     */
    public function getPageSize()
    {
        return $this->getData($this::PAGE_SIZE);
    }

    /**
     * @inheritDoc
     */
    public function setOffset($value)
    {
        $this->setData($this::OFFSET, $value);
    }

    /**
     * @inheritDoc
     */
    public function getOffset()
    {
        return $this->getData($this::OFFSET);
    }

    /**
     * @inheritDoc
     */
    public function setLimit($value)
    {
        $this->setData($this::LIMIT, $value);
    }

    /**
     * @inheritDoc
     */
    public function getLimit()
    {
        return $this->getData($this::LIMIT);
    }
}
