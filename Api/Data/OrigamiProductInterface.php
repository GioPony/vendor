<?php

namespace Origami\Vendor\Api\Data;

interface OrigamiProductInterface {
    const id = 'id';

    /**
    * @param int $value
    * @return void
    */
    /**
    * @param int $value
    * @return int
    */
    public function setId($value);

    /**
    * @param int $value
    * @return int
    */
    public function getId();
    

    const reference = 'reference';

    /**
    * @param string $value
    * @return void
    */
    public function setReference($value);

    /**
    * @return string
    */
    public function getReference();
    

    const name = 'name';

    /**
    * @param string $value
    * @return void
    */
    public function setName($value);

    /**
    * @return string
    */
    public function getName();
    

    const link = 'link';

    /**
    * @param string $value
    * @return void
    */
    public function setLink($value);

    /**
    * @return string
    */
    public function getLink();
    

    const description = 'description';

    /**
    * @param string $value
    * @return void
    */
    public function setDescription($value);

    /**
    * @param string $value
    * @return string
    */
    public function getDescription();
    

    const description_short = 'description_short';

    /**
    * @param string $value
    * @return void
    */
    public function setDescriptionShort($value);

    /**
    * @param string $value
    * @return string
    */
    public function getDescriptionShort();
    

    const brand_id = 'brand_id';

    /**
    * @param int $value
    * @return void
    */
    public function setBrandId($value);

    /**
    * @param int $value
    * @return int
    */
    public function getBrandId();
    

    const quantity = 'quantity';

    /**
    * @param int $value
    * @return void
    */
    public function setQuantity($value);

    /**
    * @param int $value
    * @return int
    */
    public function getQuantity();
    

    const price_tax_exc = 'price_tax_exc';

    /**
    * @param float $value
    * @return void
    */
    public function setPriceTaxExc($value);

    /**
    * @param float $value
    * @return float
    */
    public function getPriceTaxExc();
    

    const old_price_tax_exc = 'old_price_tax_exc';

    /**
    * @param float $value
    * @return void
    */
    public function setOldPriceTaxExc($value);

    /**
    * @param float $value
    * @return float
    */
    public function getOldPriceTaxExc();
    

    const price_tax_inc = 'price_tax_inc';

    /**
    * @param float $value
    * @return void
    */
    public function setPriceTaxInc($value);

    /**
    * @param float $value
    * @return float
    */
    public function getPriceTaxInc();
    

    const old_price_tax_inc = 'old_price_tax_inc';

    /**
    * @param float $value
    * @return void
    */
    public function setOldPriceTaxInc($value);

    /**
    * @param float $value
    * @return float
    */
    public function getOldPriceTaxInc();
    

    const wholesale_price = 'wholesale_price';

    /**
    * @param float $value
    * @return void
    */
    public function setWholesalePrice($value);

    /**
    * @param float $value
    * @return float
    */
    public function getWholesalePrice();
    

    const taxes = 'taxes';

    /**
    * @param array $value
    * @return void
    */
    public function setTaxes($value);

    /**
    * @param array $value
    * @return array
    */
    public function getTaxes();
    

    const tax_rate = 'tax_rate';

    /**
    * @param float $value
    * @return void
    */
    public function setTaxRate($value);

    /**
    * @param float $value
    * @return float
    */
    public function getTaxRate();
    

    const supplier_reference = 'supplier_reference';

    /**
    * @param string $value
    * @return void
    */
    public function setSupplierReference($value);

    /**
    * @param string $value
    * @return string
    */
    public function getSupplierReference();
    

    const upc = 'upc';

    /**
    * @param string $value
    * @return void
    */
    public function setUpc($value);

    /**
    * @param string $value
    * @return string
    */
    public function getUpc();
    

    const ean = 'ean';

    /**
    * @param string $value
    * @return void
    */
    public function setEan($value);

    /**
    * @param string $value
    * @return string
    */
    public function getEan();
    

    const weight = 'weight';

    /**
    * @param float $value
    * @return void
    */
    public function setWeight($value);

    /**
    * @param float $value
    * @return float
    */
    public function getWeight();
    

    const width = 'width';

    /**
    * @param float $value
    * @return void
    */
    public function setWidth($value);

    /**
    * @param float $value
    * @return float
    */
    public function getWidth();
    

    const depth = 'depth';

    /**
    * @param float $value
    * @return void
    */
    public function setDepth($value);

    /**
    * @param float $value
    * @return float
    */
    public function getDepth();
    

    const height = 'height';

    /**
    * @param float $value
    * @return void
    */
    public function setHeight($value);

    /**
    * @param float $value
    * @return float
    */
    public function getHeight();
    

    const ecotax = 'ecotax';

    /**
    * @param float $value
    * @return void
    */
    public function setEcotax($value);

    /**
    * @param float $value
    * @return float
    */
    public function getEcotax();
    

    const condition = 'condition';

    /**
    * @param float $value
    * @return void
    */
    public function setCondition($value);

    /**
    * @param float $value
    * @return float
    */
    public function getCondition();
    

    const available_for_order = 'available_for_order';

    /**
    * @param boolean $value
    * @return void
    */
    public function setAvailableForOrder($value);

    /**
    * @param boolean $value
    * @return boolean
    */
    public function getAvailableForOrder();
    

    const out_of_stock = 'out_of_stock';

    /**
    * @param int $value
    * @return void
    */
    public function setOutOfStock($value);

    /**
    * @param int $value
    * @return int
    */
    public function getOutOfStock();
    

    const category_default = 'category_default';

    /**
    * @param \Origami\Vendor\Api\Data\OrigamiProductCategoryInterface $value
    * @return void
    */
    public function setCategoryDefault($value);

    /**
    * @return \Origami\Vendor\Api\Data\OrigamiProductCategoryInterface
    */
    public function getCategoryDefault();
    

    const image_default = 'image_default';

    /**
    * @param \Origami\Vendor\Api\Data\OrigamiProductImageInterface $value
    * @return void
    */
    public function setImageDefault($value);

    /**
    * @return \Origami\Vendor\Api\Data\OrigamiProductImageInterface
    */
    public function getImageDefault();
    

    const meta = 'meta';

    /**
    * @param \Origami\Vendor\Api\Data\OrigamiProductMetaInterface $value
    * @return void
    */
    public function setMeta($value);

    /**
    * @return \Origami\Vendor\Api\Data\OrigamiProductMetaInterface
    */
    public function getMeta();

    const categories = 'categories';

    /**
    * @param \Origami\Vendor\Api\Data\OrigamiProductCategoryInterface $value
    * @return void
    */
    public function setCategories($value);

    /**
    * @return \Origami\Vendor\Api\Data\OrigamiProductCategoryInterface[]
    */
    public function getCategories();
    

    const images = 'images';

    /**
    * @param \Origami\Vendor\Api\Data\OrigamiProductImageInterface $value
    * @return void
    */
    public function setImages($value);

    /**
    * @return \Origami\Vendor\Api\Data\OrigamiProductImageInterface[]
    */
    public function getImages();
    

    const features = 'features';

    /**
    * @param \Origami\Vendor\Api\Data\OrigamiProductImageInterface[] $value
    * @return void
    */
    public function setFeatures($value);

    /**
    * @return \Origami\Vendor\Api\Data\OrigamiProductFeatureInterface[]
    */
    public function getFeatures();
    

    const variants = 'variants';

    /**
    * @param int $value
    * @return void
    */
    public function setVariants($value);

    /**
    * @param int $value
    * @return int
    */
    public function getVariants();
    

}