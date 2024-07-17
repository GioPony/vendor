<?php

namespace Origami\Vendor\Model\Api;

use \Magento\Catalog\Model\ProductFactory;

use Origami\Vendor\Model\Data\OrigamiCatalogApiFactory;
use Origami\Vendor\Model\Data\OrigamiCategoriesApiFactory;
use Origami\Vendor\Model\Data\OrigamiPaginationFactory;

use Origami\Vendor\Model\Data\OrigamiProductFactory;
use Origami\Vendor\Model\Data\OrigamiProductImageFactory;
use Origami\Vendor\Model\Data\OrigamiProductCategoryFactory;
use Origami\Vendor\Model\Data\OrigamiProductFeatureFactory;
use Origami\Vendor\Model\Data\OrigamiProductMetaFactory;

use Origami\Vendor\Model\Data\OrigamiCategoryFactory;

use \Origami\Core\Model\OrigamiCategory;

use Magento\Framework\App\RequestInterface;
use Magento\Eav\Api\AttributeSetRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Catalog\Api\ProductAttributeRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Tax\Model\Calculation as TaxCaclulation;
use Magento\Tax\Api\TaxRateRepositoryInterface;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\Webapi\Rest\Response;

use Origami\Vendor\Api\OrigamiApiInterface;

class OrigamiApi implements OrigamiApiInterface
{
    protected Response $response;
    protected RequestInterface $request;

    protected OrigamiCatalogApiFactory $origamiCatalogApiFactory;
    protected OrigamiCategoriesApiFactory $origamiCategoriesApiFactory;
    protected OrigamiPaginationFactory $origamiPaginationFactory;

    protected OrigamiProductFactory $origamiProductFactory;
    protected OrigamiProductImageFactory $origamiProductImageFactory;
    protected OrigamiProductCategoryFactory $origamiProductCategoryFactory;
    protected OrigamiProductFeatureFactory $origamiProductFeatureFactory;
    protected OrigamiProductMetaFactory $origamiProductMetaFactory;

    protected OrigamiCategoryFactory $origamiCategoryFactory;

    protected OrigamiCategory $origamiCategory;

    protected StoreManagerInterface $storeManager;
    protected ProductFactory $product;
    protected ProductRepositoryInterface $productRepository;
    protected ProductCollectionFactory $productCollection;
    protected CategoryCollectionFactory $categoryCollection;
    protected CategoryRepositoryInterface $categoryRepository;
    protected ProductAttributeRepositoryInterface $productAttributeRepository;
    protected SearchCriteriaBuilder $searchCriteriaBuilder;
    protected AttributeSetRepositoryInterface $attributeSetRepository;
    protected TaxRateRepositoryInterface $taxRateRepository;
    protected StockRegistryInterface $stockRegistry;
    protected TaxCaclulation $taxCalculation;

    public function __construct(
        Response $response,
        RequestInterface $request,

        OrigamiCatalogApiFactory $origamiCatalogApiFactory,
        OrigamiCategoriesApiFactory $origamiCategoriesApiFactory,
        OrigamiPaginationFactory $origamiPaginationFactory,

        OrigamiProductFactory $origamiProductFactory,
        OrigamiProductImageFactory $origamiProductImageFactory,
        OrigamiProductCategoryFactory $origamiProductCategoryFactory,
        OrigamiProductFeatureFactory $origamiProductFeatureFactory,
        OrigamiProductMetaFactory $origamiProductMetaFactory,

        OrigamiCategoryFactory $origamiCategoryFactory,

        OrigamiCategory $origamiCategory,

        StoreManagerInterface $storeManager,
        ProductFactory $product,
        ProductRepositoryInterface $productRepository,
        ProductCollectionFactory $productCollection,
        CategoryCollectionFactory $categoryCollection,
        CategoryRepositoryInterface $categoryRepository,
        ProductAttributeRepositoryInterface $productAttributeRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        AttributeSetRepositoryInterface $attributeSetRepository,
        TaxRateRepositoryInterface $taxRateRepository,
        StockRegistryInterface $stockRegistry,
        TaxCaclulation $taxCalculation
    ) {
        $this->response = $response;
        $this->request = $request;

        $this->origamiCatalogApiFactory = $origamiCatalogApiFactory;
        $this->origamiCategoriesApiFactory = $origamiCategoriesApiFactory;
        $this->origamiPaginationFactory = $origamiPaginationFactory;

        $this->origamiProductFactory = $origamiProductFactory;
        $this->origamiProductImageFactory = $origamiProductImageFactory;
        $this->origamiProductCategoryFactory = $origamiProductCategoryFactory;
        $this->origamiProductFeatureFactory = $origamiProductFeatureFactory;
        $this->origamiProductMetaFactory = $origamiProductMetaFactory;

        $this->origamiCategoryFactory = $origamiCategoryFactory;

        $this->origamiCategory = $origamiCategory;

        $this->storeManager = $storeManager;
        $this->product = $product;
        $this->productRepository = $productRepository;
        $this->productCollection = $productCollection;
        $this->categoryCollection = $categoryCollection;
        $this->categoryRepository = $categoryRepository;
        $this->productAttributeRepository = $productAttributeRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->attributeSetRepository = $attributeSetRepository;
        $this->taxRateRepository = $taxRateRepository;
        $this->stockRegistry = $stockRegistry;
        $this->taxCalculation = $taxCalculation;
    }

    public function getTaxes($product)
    {
        $taxClassId = $product->getTaxClassId();
        $taxRate = $this->taxRateRepository->get($taxClassId);
        /*
        [
            "magento" => $taxRate->getData(),
            "id_tax" => (int)$taxClassId,
            "rate" => $this->getTaxRate($product),
            "active" => 1
        ]
        */
        return [];
    }

    public function getQuantity($product)
    {
        $stockItem = $this->stockRegistry->getStockItem($product->getId(), $product->getStore()->getWebsiteId());
        return $stockItem->getQty();
    }

    public function getPriceWithTax($product)
    {
        return (float)$product->getPrice() + (float)$this->taxCalculation->calcTaxAmount($product->getPrice(), $this->getTaxRate($product), false);
    }

    public function getTaxRate($product)
    {
        $storeId = $this->storeManager->getStore()->getId();

        $taxClassId = $product->getTaxClassId();
        $rateRequest = $this->taxCalculation->getRateRequest(null, null, null, $storeId);
        return $this->taxCalculation->getRate($rateRequest->setProductClassId($taxClassId));
    }

    public function getDefaultCategory($product)
    {
    }

    public function getCategories($product)
    {
        $categories = [];

        foreach ($this->categoryCollection->create()->addAttributeToSelect('id')->addAttributeToSelect('name')->addAttributeToSelect('url_key')->addIdFilter($product->getCategoryIds()) as $category) {
            $categories[] = [
                "id_category" => $category->getId(),
                "name" => $category->getName(),
                "link_rewrite" => $category->getUrlKey()
            ];
        }
        return $categories;
    }

    public function getDefaultImages($images)
    {
        if (count($images) === 0)
            return null;

        $imageIndex = array_search('cover', $images);

        if ($imageIndex === -1)
            return null;

        return $images[$imageIndex];
    }

    public function getImages($productId)
    {
        $images = [];

        $product = $this->product->create();
        $product->load($productId);

        foreach ($product->getMediaGalleryEntries() as $image) {
            $images[] = [
                "cover" => array_search('thumbnail', $image->getTypes()) !== false,
                "id_image" => (int)$image->getId(),
                "legend" => $image->getContent(),
                "position" => $image->getPosition(),
                "url" => $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $image->getFile(),
            ];
        }

        return $images;
    }

    public function getFeatures($product)
    {
        $features = [];

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('attribute_set_id', $product->getAttributeSetId())
            ->create();

        $attributes = $this->productAttributeRepository
            ->getList($searchCriteria)
            ->getItems();

        foreach ($attributes as $attribute) {
            if ($attribute->getIsUserDefined()) {
                $features[] = [
                    "name" => $attribute->getFrontend()->getLabel(),
                    "value" => $attribute->getFrontend()->getValue($product),
                    "id_feature_type" => (int)$attribute->getAttributeId(),
                    "id_feature_value" => null,
                    "custom" => 0
                ];
            }
        }

        return $features;
    }

    public function getVariants($product)
    {
        if ($product->getTypeId() != Configurable::TYPE_CODE)
            return [];

        return [];
    }

    public function getMeta($product)
    {
        return [
            "meta_title" => $product->getMetaTitle(),
            "meta_description" => $product->getMetaDescription(),
            "meta_keywords" => $product->getMetaKeywords(),
        ];
    }

    public function methodCatalog($id)
    {
        $allProducts = [];

        if($id){
            $product = $this->productRepository->getById($id);

            if(!$product->getData('origami_seller')){
                $allProducts[] = $product;
            }
        }else{
            $pageSize = 10;
            $curPage = 1;

            $page = $this->request->getParam('page');
            if(isset($page)){
                $pageSize = (int)$page['size'] ?? 10;
                $curPage = (int)$page['number'] ?? 1;
            }

            if($curPage <= 0) $curPage = 1;
            if($pageSize <= 0) $pageSize = 10;

            $categoryIds = [];
            $category = $this->categoryRepository->get(3);
            $childrenCategories = $category->getChildrenCategories();
            foreach ($childrenCategories as $childCategory) {
                $categoryIds[] = $childCategory->getId();
            }

            $allProducts = $this->productCollection->create()
                ->addAttributeToSelect('*')
                ->addCategoriesFilter(['in' => $categoryIds])
                ->addAttributeToFilter('origami_seller', ['null' => true], 'left')
                ->setPageSize($pageSize)
                ->setCurPage($curPage);
        }

        if($id){
            $body = [
                "products" => [],
            ];
        }else{
            $body = [
                "products" => [],
                "pagination" => [
                    "total_products" => $allProducts->getSize(),
                    "total_pages" => ceil($allProducts->getSize() / $pageSize),
                    "page_number" => $curPage,
                    "page_size" => $pageSize,
                    "offset" => ($curPage - 1) * $pageSize,
                    "limit" => $pageSize   
                ],
            ];
        }

        if(count($allProducts)){
            foreach ($allProducts as $product) {
                $images = $this->getImages($product->getId());

                $body['products'][] = [
                    "id" => $product->getId(),
                    "reference" => $product->getSku(),
                    "name" => $product->getName(),
                    "link" => $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB) . "/" . $product->getUrlKey() . ".html",
                    "description" => $product->getDescription(),
                    "description_short" => $product->getShortDescription(),
                    "brand_id" => null,
                    "quantity" => $this->getQuantity($product),
                    "price_tax_exc" => (float)$product->getPrice(),
                    "old_price_tax_exc" => null,
                    "price_tax_inc" => $this->getPriceWithTax($product),
                    "old_price_tax_inc" => null,
                    "wholesale_price" => null,
                    "taxes" => $this->getTaxes($product),
                    "tax_rate" => $this->getTaxRate($product),
                    "supplier_reference" => null,
                    "upc" => null,
                    "ean" => null,
                    "weight" => (float)$product->getWeight(),
                    "width" => null,
                    "depth" => null,
                    "height" => null,
                    "ecotax" => null,
                    "condition" => null,
                    "available_for_order" => null,
                    "out_of_stock" => null,
                    "category_default" => null,
                    "image_default" => $this->getDefaultImages($images),
                    "meta" => $this->getMeta($product),
                    "categories" => $this->getCategories($product),
                    "images" => $images,
                    "features" => $this->getFeatures($product),
                    "variants" => $this->getVariants($product),
                ];
            }
        }

        if($id){
            $this->response->setHeader('Content-Type', 'application/json', true)
                ->setBody(json_encode(count($body['products']) ? $body['products'][0] : null))
                ->sendResponse();
        }else{
            $this->response->setHeader('Content-Type', 'application/json', true)
                ->setBody(json_encode($body))
                ->sendResponse();
        }
    }

    public function methodCategories($id)
    {
        $body = [];

        $allCategories = $this->categoryCollection->create()->addAttributeToSelect('*');
        
        foreach ($allCategories as $category) {
            $body[] = [
                "id_category" => (int)$category->getId(),
                "name" => $category->getName(),
                "full_name" => $category->getName(),
                "id_category_parent" => (int)$category->getParentId(),
                "description" => $category->getDescription(),
                "link_rewrite" => $category->getUrlKey(),
            ];
        }
        
        $this->response->setHeader('Content-Type', 'application/json', true)
            ->setBody(json_encode($body))
            ->sendResponse();
    }

    public function methodFeatures($id){
        $features = [];

        $searchCriteria = $this->searchCriteriaBuilder
            ->create();

        $attributes = $this->productAttributeRepository
            ->getList($searchCriteria)
            ->getItems();

        foreach ($attributes as $attribute) {
            if ($attribute->getIsUserDefined()) {
                $features[] = [
                    'id_feature' => (int)$attribute->getAttributeId(),
                    'position' => (int)$attribute->getPosition(),
                    'id_lang' => 1,
                    'name' => $attribute->getFrontend()->getLabel(),
                    'values' => []
                ];
            }
        }

        $this->response->setHeader('Content-Type', 'application/json', true)
            ->setBody(json_encode($features))
            ->sendResponse();
    }

    public function methodAttributes(){
        $this->response->setHeader('Content-Type', 'application/json', true)
            ->setBody(json_encode([]))
            ->sendResponse();
    }

    /**
     * @inheritDoc
     */
    public function index($method, $id = null): mixed
    {
        switch ($method) {
            case "catalog":
                return $this->methodCatalog($id);

            case "categories":
                return $this->methodCategories($id);

            case "features":
                return $this->methodFeatures($id);

            case "attributes":
                return [];

            case "taxes":
                return [];

            case "carriers":
                return [];

            case "orderstates":
                return [];

            case "get-order":
                return null;

            case "get-orders":
                return [];

            case "get-invoice":
                return null;

            case "brands":
                return [];

            default:
                throw new \Exception("Undefined method name.");
        }

        throw new \Exception("Undefined method name.");
    }
}
