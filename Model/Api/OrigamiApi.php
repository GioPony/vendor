<?php

namespace Origami\Vendor\Model\Api;

use Magento\Catalog\Model\ProductFactory;
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
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as OrderCollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\Status\CollectionFactory as OrderStatusCollectionFactory;

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

    public OrderStatusCollectionFactory $orderStatusCollectionFactory;
    public OrderCollectionFactory $orderCollectionFactory;
    public OrderRepositoryInterface $orderRepository;

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
        OrderStatusCollectionFactory $orderStatusCollectionFactory,
        OrderCollectionFactory $orderCollectionFactory,
        OrderRepositoryInterface $orderRepository
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

        $this->orderStatusCollectionFactory = $orderStatusCollectionFactory;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->orderRepository = $orderRepository;
    }

    public function getOrderData($order)
    {
        $products = [];
        foreach ($order->getAllVisibleItems() as $item) {
            $product = null;
            $images = null;

            try {
                $product = $this->productRepository->getById($item->getProductId());
                $images = $this->getImages($product->getId(), $this->storeManager->getWebsite());
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {

            }

            $products[$item->getId()] = [
                "id_order_detail" => $item->getId(),
                "id_order" => $order->getId(),
                "id_order_invoice" => $order->hasInvoices() ? $order->getInvoiceCollection()->getFirstItem()->getId() : null,
                "id_warehouse" => null,
                "id_shop" => $order->getStoreId(),
                "product_id" => $item->getProductId(),
                "product_attribute_id" => $item->getSku(),
                "product_name" => $item->getName(),
                "product_quantity" => $item->getQtyOrdered(),
                "product_quantity_in_stock" => $product ? $this->getQuantity($product) : null,
                "product_quantity_refunded" => $item->getQtyRefunded(),
                "product_quantity_return" => $item->getQtyReturned(),
                "product_quantity_reinjected" => null,
                "product_price" => $item->getPrice(),
                "reduction_percent" => $item->getDiscountPercent(),
                "reduction_amount" => $item->getDiscountAmount(),
                "reduction_amount_tax_incl" => $item->getDiscountAmount(),
                "reduction_amount_tax_excl" => $item->getDiscountAmount(),
                "group_reduction" => null,
                "product_quantity_discount" => null,
                "product_ean13" => $product ? $product->getData('ean') : null,
                "product_upc" => $product ? $product->getData('upc') : null,
                "product_reference" => $item->getSku(),
                "product_supplier_reference" => null,
                "product_weight" => $item->getWeight(),
                "id_tax_rules_group" => $product ? $product->getTaxClassId() : null,
                "tax_computation_method" => null,
                "tax_name" => null,
                "tax_rate" => $item->getTaxPercent(),
                "ecotax" => null,
                "ecotax_tax_rate" => null,
                "discount_quantity_applied" => null,
                "download_hash" => null,
                "download_nb" => null,
                "download_deadline" => null,
                "total_price_tax_incl" => $item->getRowTotalInclTax(),
                "total_price_tax_excl" => $item->getRowTotal(),
                "unit_price_tax_incl" => $item->getPriceInclTax(),
                "unit_price_tax_excl" => $item->getPrice(),
                "total_shipping_price_tax_incl" => null,
                "total_shipping_price_tax_excl" => null,
                "purchase_supplier_price" => null,
                "original_product_price" => $item->getOriginalPrice(),
                "original_wholesale_price" => null,
                "id_product" => $item->getProductId(),
                "id_supplier" => null,
                "id_manufacturer" => null,
                "id_category_default" => $product ? $product->getCategoryIds() : null,
                "id_shop_default" => null,
                "on_sale" => null,
                "online_only" => null,
                "ean13" => $product ? $product->getData('ean') : null,
                "upc" => $product ? $product->getData('upc') : null,
                "quantity" => $product ? $this->getQuantity($product) : null,
                "minimal_quantity" => null,
                "price" => $product ? $product->getPrice() : null,
                "wholesale_price" => null,
                "unity" => null,
                "unit_price_ratio" => null,
                "additional_shipping_cost" => null,
                "reference" => $product ? $product->getSku() : null,
                "supplier_reference" => null,
                "location" => null,
                "width" => null,
                "height" => null,
                "depth" => null,
                "weight" => $product ? $product->getWeight() : null,
                "out_of_stock" => null,
                "quantity_discount" => null,
                "customizable" => null,
                "uploadable_files" => null,
                "text_fields" => null,
                "active" => $product ? $product->isAvailable() : null,
                "redirect_type" => null,
                "id_product_redirected" => null,
                "available_for_order" => $product ? $product->isAvailable() : null,
                "available_date" => null,
                "condition" => $product ? $product->getData('condition') : null,
                "show_price" => null,
                "indexed" => null,
                "visibility" => null,
                "cache_is_pack" => null,
                "cache_has_attachments" => null,
                "is_virtual" => $item->getIsVirtual(),
                "cache_default_attribute" => null,
                "date_add" => $product ? $product->getCreatedAt() : null,
                "date_upd" => $product ? $product->getUpdatedAt() : null,
                "advanced_stock_management" => null,
                "pack_stock_type" => null,
                "image" => $images ? $this->getDefaultImages($images) : null,
                "image_size" => null,
                "current_stock" => $product ? $this->getQuantity($product) : null,
                "tax_calculator" => [
                    "taxes" => $product ? $this->getTaxes($product) : null,
                    "computation_method" => 0
                ],
                "product_price_wt" => $item->getPriceInclTax(),
                "product_price_wt_but_ecotax" => $item->getPriceInclTax(),
                "total_wt" => $item->getRowTotalInclTax(),
                "total_price" => $item->getRowTotal(),
                "customizedDatas" => null,
                "customizationQuantityTotal" => null,
                "id_address_delivery" => $order->getShippingAddress() ? $order->getShippingAddress()->getId() : null
            ];
        }

        $states_history = [];
        foreach ($order->getStatusHistoryCollection() ?: [] as $history) {
            $states_history[] = [
                "id_order_state" => $history->getStatus(),
                "invoice" => null,
                "send_email" => $history->getIsCustomerNotified(),
                "module_name" => null,
                "color" => null,
                "unremovable" => null,
                "hidden" => null,
                "logable" => null,
                "delivery" => null,
                "shipped" => null,
                "paid" => null,
                "pdf_invoice" => null,
                "pdf_delivery" => null,
                "deleted" => null,
                "id_order_history" => $history->getId(),
                "id_employee" => $history->getIsCustomerNotified() ? "0" : "1",
                "id_order" => $order->getId(),
                "date_add" => $history->getCreatedAt(),
                "employee_firstname" => null,
                "employee_lastname" => null,
                "ostate_name" => $order->getStatusLabel()
            ];
        }

        $shippingAddress = $order->getShippingAddress();
        $billingAddress = $order->getBillingAddress();
        $payment = $order->getPayment();

        $shop_order = [
            'id_order' => $order->getId(),
            'id_address_delivery' => $shippingAddress ? $shippingAddress->getId() : null,
            'id_address_invoice' => $billingAddress ? $billingAddress->getId() : null,
            'id_cart' => $order->getQuoteId(),
            'id_currency' => $order->getOrderCurrency()->getId(),
            'id_shop_group' => $order->getStore()->getGroup()->getId(),
            'id_shop' => $order->getStoreId(),
            'id_lang' => $this->storeManager->getStore()->getId(),
            'id_customer' => $order->getCustomerId(),
            'id_carrier' => $order->getShippingMethod(),
            'current_state' => $order->getStatus(),
            'payment' => $payment->getMethodInstance()->getTitle(),
            'module' => $payment->getMethod(),
            'recyclable' => null,
            'mobile_theme' => null,
            'total_discounts' => $order->getDiscountAmount(),
            'total_discounts_tax_incl' => $order->getDiscountAmount(),
            'total_discounts_tax_excl' => $order->getDiscountAmount(),
            'total_paid' => $order->getGrandTotal(),
            'total_paid_tax_incl' => $order->getGrandTotal(),
            'total_paid_tax_excl' => $order->getSubtotal(),
            'total_paid_real' => $order->getTotalPaid(),
            'total_products' => $order->getSubtotal(),
            'total_products_wt' => $order->getSubtotalInclTax(),
            'total_shipping' => $order->getShippingAmount(),
            'total_shipping_tax_incl' => $order->getShippingInclTax(),
            'total_shipping_tax_excl' => $order->getShippingAmount(),
            'carrier_tax_rate' => $order->getShippingAmount() > 0 ? ($order->getShippingTaxAmount() / $order->getShippingAmount()) * 100 : 0,
            'total_wrapping' => null,
            'total_wrapping_tax_incl' => null,
            'total_wrapping_tax_excl' => null,
            'round_mode' => null,
            'round_type' => null,
            'shipping_number' => $order->getShippingDescription(),
            'conversion_rate' => $order->getBaseToOrderRate(),
            'invoice_number' => $order->hasInvoices() ? $order->getInvoiceCollection()->getFirstItem()->getIncrementId() : null,
            'delivery_number' => $order->hasShipments() ? $order->getShipmentsCollection()->getFirstItem()->getIncrementId() : null,
            'invoice_date' => $order->hasInvoices() ? $order->getInvoiceCollection()->getFirstItem()->getCreatedAt() : null,
            'delivery_date' => $order->hasShipments() ? $order->getShipmentsCollection()->getFirstItem()->getCreatedAt() : null,
            'valid' => null,
            'reference' => $order->getIncrementId(),
            'date_add' => $order->getCreatedAt(),
            'date_upd' => $order->getUpdatedAt(),
            'states_history' => $states_history,
            'products' => $products,
            'invoice' => null,
            'cart' => [
                'id_cart' => $order->getQuoteId(),
                'id_shop_group' => $order->getStore()->getGroup()->getId(),
                'id_shop' => $order->getStoreId(),
                'id_address_delivery' => $shippingAddress ? $shippingAddress->getId() : null,
                'id_address_invoice' => $billingAddress ? $billingAddress->getId() : null,
                'id_carrier' => $order->getShippingMethod(),
                'id_currency' => $order->getOrderCurrency()->getId(),
                'id_customer' => $order->getCustomerId(),
                'id_guest' => $order->getCustomerIsGuest(),
                'id_lang' => $this->storeManager->getStore()->getId(),
                'recyclable' => null,
                'gift' => null,
                'gift_message' => $order->getGiftMessage(),
                'mobile_theme' => null,
                'delivery_option' => null,
                'secure_key' => $order->getProtectCode(),
                'allow_seperated_package' => null,
                'date_add' => $order->getQuote() ? $order->getQuote()->getCreatedAt() : null,
                'date_upd' => $order->getQuote() ? $order->getQuote()->getUpdatedAt() : null
            ]
        ];

        return [
            "id_origami_order" => null,
            "id_origami_marketplace" => null,
            "id_order" => $order->getId(),
            "reference_origami" => null,
            "state" => $order->getStatus(),
            "last_action" => null,
            "last_error" => null,
            "date_add" => $order->getCreatedAt(),
            "date_upd" => $order->getUpdatedAt(),
            "shop_order" => $shop_order
        ];
    }

    public function methodGetOrder($id, $website)
    {
        if (!$id) {
            throw new \Exception("Order ID is required.");
        }

        try {
            $order = $this->orderRepository->get($id);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            throw new \Exception("Order not found");
        }

        if (!in_array($order->getStoreId(), $website->getStoreIds())) {
            throw new \Exception("Order not found");
        }

        $orderData = $this->getOrderData($order);

        $this->response->setHeader('Content-Type', 'application/json', true)
            ->setBody(json_encode($orderData))
            ->sendResponse();
    }

    public function methodGetOrders($website)
    {
        $pageSize = 10;
        $curPage = 1;

        $page = $this->request->getParam('page');
        if (isset($page)) {
            $pageSize = (int)($page['size'] ?? 10);
            $curPage = (int)($page['number'] ?? 1);
        }

        if ($curPage <= 0) {
            $curPage = 1;
        }
        if ($pageSize <= 0) {
            $pageSize = 10;
        }

        $orderCollection = $this->orderCollectionFactory->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('store_id', ['in' => $website->getStoreIds()])
            ->setPageSize($pageSize)
            ->setCurPage($curPage);

        $body = [
            "orders" => [],
            "pagination" => [
                "total_orders" => $orderCollection->getSize(),
                "total_pages" => ceil($orderCollection->getSize() / $pageSize),
                "page_number" => $curPage,
                "page_size" => $pageSize,
                "offset" => ($curPage - 1) * $pageSize,
                "limit" => $pageSize
            ],
        ];

        foreach ($orderCollection as $order) {
            $body['orders'][] = $this->getOrderData($order);
        }

        $this->response->setHeader('Content-Type', 'application/json', true)
            ->setBody(json_encode($body))
            ->sendResponse();
    }

    public function methodOrderStates()
    {
        $states = [];
        $statusCollection = $this->orderStatusCollectionFactory->create();
        foreach ($statusCollection as $status) {
            $states[] = [
                'id' => $status->getStatus(),
                'name' => $status->getLabel(),
            ];
        }

        $this->response->setHeader('Content-Type', 'application/json', true)
            ->setBody(json_encode($states))
            ->sendResponse();
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
                $searchCriteria = $this->searchCriteriaBuilder
                    ->addFilter('sku', $product->getSku())
                    ->addFilter('source_code', $sellerId)
                    ->create();

                $items = $this->sourceItemRepository->getList($searchCriteria)->getItems();

                if (!empty($items)) {
                    $sourceItem = reset($items);
                    if ($sourceItem->getQuantity() > 0) {
                        return $sourceItem->getQuantity();
                    }
                }

                return 0;
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

    public function getDefaultCategory($product)
    {
        return null;
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
        if (count($images) === 0) {
            return null;
        }

        $imageIndex = array_search('cover', $images);

        if ($imageIndex === -1) {
            return null;
        }

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
        if ($product->getTypeId() != Configurable::TYPE_CODE) {
            return [];
        }

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

            if ($curPage <= 0) {
                $curPage = 1;
            }
            if ($pageSize <= 0) {
                $pageSize = 10;
            }

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
                return $this->methodOrderStates();

            case "get-order":
                return $this->methodGetOrder($id, $website);

            case "get-orders":
                return $this->methodGetOrders($website);

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
