<?php

namespace Origami\Vendor\Api\Data;

interface OrigamiCatalogApiInterface
{
    const CATEGORIES = 'categories';
    const PRODUCTS = 'products';
    const PAGINATION = 'pagination';

    /**
     * @return \Origami\Vendor\Api\Data\OrigamiProductInterface[]
     */
    public function getProducts();

    /**
     * @param \Origami\Vendor\Api\Data\OrigamiProductInterface[] $value
     * @return void
     */
    public function setProducts($value);

    /**
     * @param \Origami\Vendor\Api\Data\OrigamiPaginationInterface $value
     * @return void
     */
    public function addProduct($value);

    /**
     * @return \Origami\Vendor\Api\Data\OrigamiCategoryInterface[]
     */
    public function getCategories();

    /**
     * @param \Origami\Vendor\Api\Data\OrigamiCategoryInterface[] $value
     * @return void
     */
    public function setCategories($value);

    /**
     * @param \Origami\Vendor\Api\Data\OrigamiCategoryInterface $value
     * @return void
     */
    public function addCategory($value);


    /**
     * @return \Origami\Vendor\Api\Data\OrigamiPaginationInterface
     */
    public function getPagination();

    /**
    * @param \Origami\Vendor\Api\Data\OrigamiPaginationInterface $value
    * @return \Origami\Vendor\Api\Data\OrigamiPaginationInterface
    */
    public function setPagination($value);
}