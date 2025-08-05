<?php
namespace Origami\Vendor\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OrigamiOrderMapping extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('origami_order_mapping', 'entity_id');
    }
}