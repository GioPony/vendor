<?php

namespace Origami\Vendor\Model\Data;

use Magento\Framework\Model\AbstractModel;

class OrigamiProduct extends AbstractModel implements \Origami\Vendor\Api\Data\OrigamiProductInterface
{

    /**
     * @inheritDoc
     */
    public function setId($value)
    {
        $this->setData($this::id, $value);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData($this::id);
    }

    /**
     * @inheritDoc
     */
    public function setReference($value)
    {
        $this->setData($this::reference, $value);
    }

    /**
     * @inheritDoc
     */
    public function getReference()
    {
        return $this->getData($this::reference);
    }


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
    public function setLink($value)
    {
        $this->setData($this::link, $value);
    }

    /**
     * @inheritDoc
     */
    public function getLink()
    {
        return $this->getData($this::link);
    }


    /**
     * @inheritDoc
     */
    public function setDescription($value)
    {
        $this->setData($this::description, $value);
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return $this->getData($this::description);
    }


    /**
     * @inheritDoc
     */
    public function setDescriptionShort($value)
    {
        $this->setData($this::description_short, $value);
    }

    /**
     * @inheritDoc
     */
    public function getDescriptionShort()
    {
        return $this->getData($this::description_short);
    }


    /**
     * @inheritDoc
     */
    public function setBrandId($value)
    {
        $this->setData($this::brand_id, $value);
    }

    /**
     * @inheritDoc
     */
    public function getBrandId()
    {
        return $this->getData($this::brand_id);
    }

    /**
     * @inheritDoc
     */
    public function setQuantity($value)
    {
        $this->setData($this::quantity, $value);
    }

    /**
     * @inheritDoc
     */
    public function getQuantity()
    {
        return $this->getData($this::quantity);
    }


    /**
     * @inheritDoc
     */
    public function setPriceTaxExc($value)
    {
        $this->setData($this::price_tax_exc, $value);
    }

    /**
     * @inheritDoc
     */
    public function getPriceTaxExc()
    {
        return $this->getData($this::price_tax_exc);
    }


    /**
     * @inheritDoc
     */
    public function setOldPriceTaxExc($value)
    {
        $this->setData($this::old_price_tax_exc, $value);
    }

    /**
     * @inheritDoc
     */
    public function getOldPriceTaxExc()
    {
        return $this->getData($this::old_price_tax_exc);
    }


    /**
     * @inheritDoc
     */
    public function setPriceTaxInc($value)
    {
        $this->setData($this::price_tax_inc, $value);
    }

    /**
     * @inheritDoc
     */
    public function getPriceTaxInc()
    {
        return $this->getData($this::price_tax_inc);
    }


    /**
     * @inheritDoc
     */
    public function setOldPriceTaxInc($value)
    {
        $this->setData($this::old_price_tax_inc, $value);
    }

    /**
     * @inheritDoc
     */
    public function getOldPriceTaxInc()
    {
        return $this->getData($this::old_price_tax_inc);
    }


    /**
     * @inheritDoc
     */
    public function setWholesalePrice($value)
    {
        $this->setData($this::wholesale_price, $value);
    }

    /**
     * @inheritDoc
     */
    public function getWholesalePrice()
    {
        return $this->getData($this::wholesale_price);
    }


    /**
     * @inheritDoc
     */
    public function setTaxes($value)
    {
        $this->setData($this::taxes, $value);
    }

    /**
     * @inheritDoc
     */
    public function getTaxes()
    {
        return $this->getData($this::taxes);
    }


    /**
     * @inheritDoc
     */
    public function setTaxRate($value)
    {
        $this->setData($this::tax_rate, $value);
    }

    /**
     * @inheritDoc
     */
    public function getTaxRate()
    {
        return $this->getData($this::tax_rate);
    }


    /**
     * @inheritDoc
     */
    public function setSupplierReference($value)
    {
        $this->setData($this::supplier_reference, $value);
    }

    /**
     * @inheritDoc
     */
    public function getSupplierReference()
    {
        return $this->getData($this::supplier_reference);
    }


    /**
     * @inheritDoc
     */
    public function setUpc($value)
    {
        $this->setData($this::upc, $value);
    }

    /**
     * @inheritDoc
     */
    public function getUpc()
    {
        return $this->getData($this::upc);
    }


    /**
     * @inheritDoc
     */
    public function setEan($value)
    {
        $this->setData($this::ean, $value);
    }

    /**
     * @inheritDoc
     */
    public function getEan()
    {
        return $this->getData($this::ean);
    }


    /**
     * @inheritDoc
     */
    public function setWeight($value)
    {
        $this->setData($this::weight, $value);
    }

    /**
     * @inheritDoc
     */
    public function getWeight()
    {
        return $this->getData($this::weight);
    }


    /**
     * @inheritDoc
     */
    public function setWidth($value)
    {
        $this->setData($this::width, $value);
    }

    /**
     * @inheritDoc
     */
    public function getWidth()
    {
        return $this->getData($this::width);
    }


    /**
     * @inheritDoc
     */
    public function setDepth($value)
    {
        $this->setData($this::depth, $value);
    }

    /**
     * @inheritDoc
     */
    public function getDepth()
    {
        return $this->getData($this::depth);
    }


    /**
     * @inheritDoc
     */
    public function setHeight($value)
    {
        $this->setData($this::height, $value);
    }

    /**
     * @inheritDoc
     */
    public function getHeight()
    {
        return $this->getData($this::height);
    }


    /**
     * @inheritDoc
     */
    public function setEcotax($value)
    {
        $this->setData($this::ecotax, $value);
    }

    /**
     * @inheritDoc
     */
    public function getEcotax()
    {
        return $this->getData($this::ecotax);
    }


    /**
     * @inheritDoc
     */
    public function setCondition($value)
    {
        $this->setData($this::condition, $value);
    }

    /**
     * @inheritDoc
     */
    public function getCondition()
    {
        return $this->getData($this::condition);
    }


    /**
     * @inheritDoc
     */
    public function setAvailableForOrder($value)
    {
        $this->setData($this::available_for_order, $value);
    }

    /**
     * @inheritDoc
     */
    public function getAvailableForOrder()
    {
        return $this->getData($this::available_for_order);
    }


    /**
     * @inheritDoc
     */
    public function setOutOfStock($value)
    {
        $this->setData($this::out_of_stock, $value);
    }

    /**
     * @inheritDoc
     */
    public function getOutOfStock()
    {
        return $this->getData($this::out_of_stock);
    }


    /**
     * @inheritDoc
     */
    public function setCategoryDefault($value)
    {
        $this->setData($this::category_default, $value);
    }

    /**
     * @inheritDoc
     */
    public function getCategoryDefault()
    {
        return $this->getData($this::category_default);
    }


    /**
     * @inheritDoc
     */
    public function setImageDefault($value)
    {
        $this->setData($this::image_default, $value);
    }

    /**
     * @inheritDoc
     */
    public function getImageDefault()
    {
        return $this->getData($this::image_default);
    }


    /**
     * @inheritDoc
     */
    public function setMeta($value)
    {
        $this->setData($this::meta, $value);
    }

    /**
     * @inheritDoc
     */
    public function getMeta()
    {
        return $this->getData($this::meta);
    }

    /*
        meta_title
        meta_description
        meta_keywords
        */


    public function setCategories($value)
    {
        $this->setData($this::categories, $value);
    }

    /**
     * @inheritDoc
     */
    public function getCategories()
    {
        return $this->getData($this::categories);
    }


    /**
     * @inheritDoc
     */
    public function setImages($value)
    {
        $this->setData($this::images, $value);
    }

    /**
     * @inheritDoc
     */
    public function getImages()
    {
        return $this->getData($this::images);
    }


    /**
     * @inheritDoc
     */
    public function setFeatures($value)
    {
        $this->setData($this::features, $value);
    }

    /**
     * @inheritDoc
     */
    public function getFeatures()
    {
        return $this->getData($this::features);
    }


    /**
     * @inheritDoc
     */
    public function setVariants($value)
    {
        $this->setData($this::variants, $value);
    }

    /**
     * @inheritDoc
     */
    public function getVariants()
    {
        return $this->getData($this::variants);
    }
}
