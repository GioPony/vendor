<?php

namespace Origami\Vendor\Api\Data;

interface OrigamiCategoryInterface {
    const id_category = 'id_category';
    const name = 'name';
    const full_name = 'full_name';
    const id_category_parent = 'id_category_parent';
    const description = 'description';
    const link_rewrite = 'link_rewrite';

    /**
    * @param int $value
    * @return int
    */
    public function setIdCategory($value);

    /**
     * @return int
     */
    public function getIdCategory();

    /**
    * @param string $value
    * @return string
    */
    public function setName($value);

    /**
     * @return string
     */
    public function getName();

    /**
    * @param string $value
    * @return string
    */
    public function setFullName($value);

    /**
     * @return string
     */
    public function getFullName();

    /**
    * @param int $value
    * @return int
    */
    public function setIdCategoryParent($value);

    /**
     * @return int
     */
    public function getIdCategoryParent();

    /**
    * @param string $value
    * @return string
    */
    public function setDescription($value);

    /**
     * @return string
     */
    public function getDescription();

    /**
    * @param string $value
    * @return string
    */
    public function setLinkRewrite($value);

    /**
     * @return string
     */
    public function getLinkRewrite();

}