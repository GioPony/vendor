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

use Magento\Framework\App\ObjectManager;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Eav\Api\AttributeSetRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\InventoryApi\Api\SourceItemRepositoryInterface;
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
use Magento\Store\Model\WebsiteRepository;

use Origami\Vendor\Api\OrigamiApiInterface;

class OrigamiApi implements OrigamiApiInterface
{
    public Response $response;
    public RequestInterface $request;

    public OrigamiCatalogApiFactory $origamiCatalogApiFactory;
    public OrigamiCategoriesApiFactory $origamiCategoriesApiFactory;
    public OrigamiPaginationFactory $origamiPaginationFactory;

    public OrigamiProductFactory $origamiProductFactory;
    public OrigamiProductImageFactory $origamiProductImageFactory;
    public OrigamiProductCategoryFactory $origamiProductCategoryFactory;
    public OrigamiProductFeatureFactory $origamiProductFeatureFactory;
    public OrigamiProductMetaFactory $origamiProductMetaFactory;

    public StoreManagerInterface $storeManager;
    public WebsiteRepository $websiteRepository;
    public ProductFactory $product;
    public ProductRepositoryInterface $productRepository;
    public ProductCollectionFactory $productCollection;
    public CategoryCollectionFactory $categoryCollection;
    public CategoryRepositoryInterface $categoryRepository;
    public ProductAttributeRepositoryInterface $productAttributeRepository;
    public SearchCriteriaBuilder $searchCriteriaBuilder;
    public SourceItemRepositoryInterface $sourceItemRepository;
    public AttributeSetRepositoryInterface $attributeSetRepository;
    public TaxRateRepositoryInterface $taxRateRepository;
    public StockRegistryInterface $stockRegistry;
    public TaxCaclulation $taxCalculation;
    public ScopeConfigInterface $scopeConfig;

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

        StoreManagerInterface $storeManager,
        WebsiteRepository $websiteRepository,
        ProductFactory $product,
        ProductRepositoryInterface $productRepository,
        ProductCollectionFactory $productCollection,
        CategoryCollectionFactory $categoryCollection,
        CategoryRepositoryInterface $categoryRepository,
        ProductAttributeRepositoryInterface $productAttributeRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SourceItemRepositoryInterface $sourceItemRepository,
        AttributeSetRepositoryInterface $attributeSetRepository,
        TaxRateRepositoryInterface $taxRateRepository,
        StockRegistryInterface $stockRegistry,
        TaxCaclulation $taxCalculation,

        ScopeConfigInterface $scopeConfig,
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

        $this->storeManager = $storeManager;
        $this->websiteRepository = $websiteRepository;
        $this->product = $product;
        $this->productRepository = $productRepository;
        $this->productCollection = $productCollection;
        $this->categoryCollection = $categoryCollection;
        $this->categoryRepository = $categoryRepository;
        $this->productAttributeRepository = $productAttributeRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sourceItemRepository = $sourceItemRepository;
        $this->attributeSetRepository = $attributeSetRepository;
        $this->taxRateRepository = $taxRateRepository;
        $this->stockRegistry = $stockRegistry;
        $this->taxCalculation = $taxCalculation;
        $this->scopeConfig = $scopeConfig;
    }

    public function getTaxes($product)
    {
        /*
        $taxClassId = $product->getTaxClassId();
        $taxRate = $this->taxRateRepository->get($taxClassId);
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
        $sellerId = $this->scopeConfig->getValue('origami_vendor/config/seller_id', ScopeInterface::SCOPE_WEBSITES, 1);
        if (!empty($sellerId)) {
            try {
                $child = $this->sourceItemRepository->get($product->getId(), $sellerId);
                if ($child->getQuantity() > 0) {
                    return $child->getQuantity();
                } else {
                    return 0;
                }
            } catch (\Exception $error) {
                return 0;
            }
        }

        $stockItem = $this->stockRegistry->getStockItem($product->getId(), $product->getStore()->getWebsiteId());
        return $stockItem->getQty();
    }

    public function getPriceWithTax($product)
    {
        return (float)(float)$product->getData('recommanded_price') + (float)$this->taxCalculation->calcTaxAmount((float)$product->getData('recommanded_price'), $this->getTaxRate($product), false);
    }

    public function getTaxRate($product)
    {
        $storeId = $this->storeManager->getStore()->getId();

        $taxClassId = $product->getTaxClassId();
        $rateRequest = $this->taxCalculation->getRateRequest(null, null, null, $storeId);
        return $this->taxCalculation->getRate($rateRequest->setProductClassId($taxClassId));
    }

    public function getDefaultCategory($product) {}

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

    public function getImages($productId, $website)
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
                "url" => $website->getDefaultStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' . $image->getFile(),
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


    public function methodCatalog($id, $website)
    {
        $categoryToCheck = $this->scopeConfig->getValue('origami_vendor/config/category_id', ScopeInterface::SCOPE_WEBSITES, $website->getId());
        $allProducts = [];

        $categoryIds = [];
        if ($categoryToCheck) {
            $category = $this->categoryRepository->get($categoryToCheck);
            $childrenCategories = $category->getChildrenCategories();
            foreach ($childrenCategories as $childCategory) {
                $categoryIds[] = $childCategory->getId();
            }
        }

        if ($id) {
            $product = $this->productRepository->getById($id);

            if (count($categoryIds)) {
                if (array_intersect($categoryIds, $product->getCategoryIds())) {
                    $allProducts[] = $product;
                } else {
                    throw new \Exception("Product not found");
                }
            }
        } else {
            $pageSize = 10;
            $curPage = 1;

            $page = $this->request->getParam('page');
            if (isset($page)) {
                $pageSize = (int)$page['size'] ?? 10;
                $curPage = (int)$page['number'] ?? 1;
            }

            if ($curPage <= 0) $curPage = 1;
            if ($pageSize <= 0) $pageSize = 10;

            $allProducts = $this->productCollection->create()
                ->addAttributeToSelect('*')
                ->setPageSize($pageSize)
                ->addWebsiteFilter($website->getId())
                ->setCurPage($curPage);

            $eavConfig = ObjectManager::getInstance()->get(\Magento\Eav\Model\Config::class);
            $attribute = $eavConfig->getAttribute(\Magento\Catalog\Model\Product::ENTITY, 'origami_seller');
            if ($attribute && $attribute->getId()) {
                $allProducts->addAttributeToFilter('origami_seller', ['null' => true], 'left');
            }

            if (count($categoryIds) > 0) {
                $allProducts->addCategoriesFilter(['in' => $categoryIds]);
            }
        }

        if ($id) {
            $body = [
                "products" => [],
            ];
        } else {
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

        if (count($allProducts)) {
            foreach ($allProducts as $product) {
                $images = $this->getImages($product->getId(), $website);

                $body['products'][] = [
                    "id" => $product->getId(),
                    "reference" => $product->getSku(),
                    "name" => $product->getName(),
                    "link" => $website->getDefaultStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB) . "/" . $product->getUrlKey() . ".html",
                    "description" => $product->getDescription(),
                    "description_short" => $product->getShortDescription(),
                    "brand_id" => null,
                    "quantity" => $this->getQuantity($product),
                    "price_tax_exc" => (float)$product->getData('recommanded_price'),
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

        if ($id) {
            $this->response->setHeader('Content-Type', 'application/json', true)
                ->setBody(json_encode(count($body['products']) ? $body['products'][0] : null))
                ->sendResponse();
        } else {
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

    public function methodFeatures($id)
    {
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

    public function methodAttributes()
    {
        $this->response->setHeader('Content-Type', 'application/json', true)
            ->setBody(json_encode([]))
            ->sendResponse();
    }

    /**
     * @inheritDoc
     */
    public function index($method, $id = null): mixed
    {
        $key = $this->request->getParam('key');
        $websites = $this->storeManager->getWebsites();
        $website = null;

        foreach ($websites as $innerWebsite) {
            $configKey = $this->scopeConfig->getValue(
                'origami_vendor/config/magento_api_token',
                ScopeInterface::SCOPE_WEBSITES,
                $innerWebsite->getId()
            );

            if ($configKey === $key) {
                $website = $innerWebsite;
                break;
            }
        }

        if (!isset($website) || null === $website->getId()) {
            throw new \Exception("Key is different.");
        }

        switch ($method) {
            case "catalog":
                return $this->methodCatalog($id, $website);

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
