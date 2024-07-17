<?php

namespace Origami\Vendor\Model\Data;

use Magento\Framework\Model\AbstractModel;

class OrigamiProductFeature extends AbstractModel implements \Origami\Vendor\Api\Data\OrigamiProductFeatureInterface
{
    /**
     * @inheritDoc
     */
    public function setName($value)
    {
        $this->setData($this::name, $value);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData($this::name);
    }

    /**
     * @inheritDoc
     */
    public function setValue($value)
    {
        $this->setData($this::value, $value);
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return $this->getData($this::value);
    }


    /**
     * @inheritDoc
     */
    public function setIdFeatureType($value)
    {
        $this->setData($this::id_feature_type, $value);
    }

    /**
     * @inheritDoc
     */
    public function getIdFeatureType()
    {
        return $this->getData($this::id_feature_type);
    }


    /**
     * @inheritDoc
     */
    public function setIdFeatureValue($value)
    {
        $this->setData($this::id_feature_value, $value);
    }

    /**
     * @inheritDoc
     */
    public function getIdFeatureValue()
    {
        return $this->getData($this::id_feature_value);
    }


    /**
     * @inheritDoc
     */
    public function setCustom($value)
    {
        $this->setData($this::custom, $value);
    }

    /**
     * @inheritDoc
     */
    public function getCustom()
    {
        return $this->getData($this::custom);
    }
}
