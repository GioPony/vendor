<?php

namespace Origami\Vendor\Api;

interface OrigamiTestInterface {
    /**
     * Test
     * 
     * @param string $id
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function test($id);
}