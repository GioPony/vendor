<?php

namespace Origami\Vendor\Api\Data;

interface OrigamiProductCategoryInterface {
    const id_category = "id_category";

    /**
    * @param int $value
    * @return void
    */
    public function setIdCategory($value);

    /**
    * @return int
    */
    public function getIdCategory();

    const name = "name";

    /**
    * @param string $value
    * @return void
    */
    public function setName($value);

    /**
    * @return string
    */
    public function getName();

    const link_rewrite = "link_rewrite";

    /**
    * @param string $value
    * @return void
    */
    public function setLinkRewrite($value);

    /**
    * @return string
    */
    public function getLinkRewrite();
}