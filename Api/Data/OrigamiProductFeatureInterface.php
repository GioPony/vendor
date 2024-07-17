<?php

namespace Origami\Vendor\Api\Data;

interface OrigamiProductFeatureInterface {
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

    const value = "value";

    /**
    * @param json $value
    * @return void
    */
    public function setValue($value);

    /**
    * @return json
    */
    public function getValue();

    const id_feature_type = "id_feature_type";

    /**
    * @param int $value
    * @return void
    */
    public function setIdFeatureType($value);

    /**
    * @return int
    */
    public function getIdFeatureType();

    const id_feature_value = "id_feature_value";

    /**
    * @param int $value
    * @return void
    */
    public function setIdFeatureValue($value);

    /**
    * @return int
    */
    public function getIdFeatureValue();

    const custom = "custom";

    /**
    * @param string $value
    * @return void
    */
    public function setCustom($value);

    /**
    * @return string
    */
    public function getCustom();
}