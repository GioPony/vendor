<?php

namespace Origami\Vendor\Api;

interface OrigamiApiInterface {
    /**
     * List all catalog
     * 
     * @param string $method
     * @param string $id
     *
     * @return \Origami\Vendor\Api\Data\OrigamiCatalogApiInterface
     */
    public function index($method, $id = null);
}