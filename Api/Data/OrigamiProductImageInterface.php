<?php

namespace Origami\Vendor\Api\Data;

interface OrigamiProductImageInterface {
    const cover = "cover";

    /**
    * @param int $value
    * @return void
    */
    public function setCover($value);

    /**
    * @return int
    */
    public function getCover();

    const id_image = "id_image";

    /**
    * @param int $value
    * @return void
    */
    public function setIdImage($value);

    /**
    * @return int
    */
    public function getIdImage();

    const legend = "legend";

    /**
    * @param string $value
    * @return void
    */
    public function setLegend($value);

    /**
    * @return string
    */
    public function getLegend();

    const position = "position";

    /**
    * @param int $value
    * @return void
    */
    public function setPosition($value);

    /**
    * @return int
    */
    public function getPosition();

    const url = "url";

    /**
    * @param string $value
    * @return void
    */
    public function setUrl($value);

    /**
    * @return string
    */
    public function getUrl();
}