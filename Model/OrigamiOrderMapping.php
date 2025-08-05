<?php
namespace Origami\Vendor\Model;

use Magento\Framework\Model\AbstractModel;

class OrigamiOrderMapping extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Origami\Vendor\Model\ResourceModel\OrigamiOrderMapping::class);
    }
}