<?php

namespace Origami\Vendor\Api\Data;

interface OrigamiPaginationInterface {
    const TOTAL_PRODUCTS = 'total_products';
    const TOTAL_PAGES = 'total_pages';
    const PAGE_NUMBER = 'page_number';
    const PAGE_SIZE = 'page_size';
    const OFFSET = 'offset';
    const LIMIT = 'limit';

    /**
    * @param int $value
    * @return int
    */
    public function setTotalProducts($value);

    /**
     * @return int
     */
    public function getTotalProducts();

    /**
    * @param int $value
    * @return int
    */
    public function setTotalPages($value);

    /**
     * @return int
     */
    public function getTotalPages();

    /**
    * @param int $value
    * @return int
    */
    public function setPageNumber($value);

    /**
     * @return int
     */
    public function getPageNumber();

    /**
    * @param int $value
    * @return int
    */
    public function setPageSize($value);

    /**
     * @return int
     */
    public function getPageSize();

    /**
    * @param int $value
    * @return int
    */
    public function setOffset($value);

    /**
     * @return int
     */
    public function getOffset();

    /**
    * @param int $value
    * @return int
    */
    public function setLimit($value);

    /**
     * @return int
     */
    public function getLimit();

}