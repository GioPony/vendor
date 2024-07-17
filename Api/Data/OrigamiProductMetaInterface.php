<?php

namespace Origami\Vendor\Api\Data;

interface OrigamiProductMetaInterface {
    const meta_title = "meta_title";

    /**
    * @param string $value
    * @return void
    */
    public function setMetaTitle($value);

    /**
    * @return string
    */
    public function getMetaTitle();

    const meta_description = "meta_description";

    /**
    * @param string $value
    * @return void
    */
    public function setMetaDescription($value);

    /**
    * @return string
    */
    public function getMetaDescription();


    const meta_keywords = "meta_keywords";

    /**
    * @param string $value
    * @return void
    */
    public function setMetaKeywords($value);

    /**
    * @return string
    */
    public function getMetaKeywords();
}