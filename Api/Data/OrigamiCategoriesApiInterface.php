<?php

namespace Origami\Vendor\Api\Data;

interface OrigamiCategoriesApiInterface
{
    const CATEGORIES = 'categories';
    const PAGINATION = 'pagination';

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