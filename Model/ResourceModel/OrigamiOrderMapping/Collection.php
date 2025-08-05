<?php
namespace Origami\Vendor\Model\ResourceModel\OrigamiOrderMapping;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Origami\Vendor\Model\OrigamiOrderMapping::class, \Origami\Vendor\Model\ResourceModel\OrigamiOrderMapping::class);
    }
}