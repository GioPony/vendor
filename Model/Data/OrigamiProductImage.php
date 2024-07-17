<?php

namespace Origami\Vendor\Model\Data;

use Magento\Framework\Model\AbstractModel;

class OrigamiProductImage extends AbstractModel implements \Origami\Vendor\Api\Data\OrigamiProductImageInterface
{
    /**
     * @inheritDoc
     */
    public function setCover($value)
    {
        $this->setData($this::cover, $value);
    }

    /**
     * @inheritDoc
     */
    public function getCover()
    {
        return $this->getData($this::cover);
    }

    /**
     * @inheritDoc
     */
    public function setIdImage($value)
    {
        $this->setData($this::id_image, $value);
    }

    /**
     * @inheritDoc
     */
    public function getIdImage()
    {
        return $this->getData($this::id_image);
    }


    /**
     * @inheritDoc
     */
    public function setLegend($value)
    {
        $this->setData($this::legend, $value);
    }

    /**
     * @inheritDoc
     */
    public function getLegend()
    {
        return $this->getData($this::legend);
    }


    /**
     * @inheritDoc
     */
    public function setPosition($value)
    {
        $this->setData($this::position, $value);
    }

    /**
     * @inheritDoc
     */
    public function getPosition()
    {
        return $this->getData($this::position);
    }

    /**
     * @inheritDoc
     */
    public function setUrl($value)
    {
        return $this->setData($this::url, $value);
    }

    /**
     * @inheritDoc
     */
    public function getUrl()
    {
        return $this->getData($this::url);
    }
}
