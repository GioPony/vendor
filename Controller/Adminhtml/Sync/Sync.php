<?php

namespace Origami\Vendor\Controller\Adminhtml\Sync;

use Magento\Framework\Controller\ResultFactory;
use Origami\Core\Service\OrigamiApiTools;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Framework\App\ObjectManager;
use Origami\Core\Service\OrigamiLogService;

class Sync extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	protected CategoryCollectionFactory $categoryCollection;
	protected OrigamiLogService $origamiLogService;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;

		$this->categoryCollection = ObjectManager::getInstance()->get(CategoryCollectionFactory::class);
		$this->origamiLogService = ObjectManager::getInstance()->get(OrigamiLogService::class)->create("[Vendor] Sync");

	}

	public function execute()
	{
		$rootOrigamiCategory = null;

		$rootOrigamiCategoryApi = OrigamiApiTools::api()->get("catalog/categories", [
			"filter[is_root_category]" => 1,
			"page[size]" => 1,
		]);

		if(isset($rootOrigamiCategoryApi['data']) && isset($rootOrigamiCategoryApi['data'][0])){
			$rootOrigamiCategory = $rootOrigamiCategoryApi['data'][0];
		}

		if(!isset($rootOrigamiCategory))
			throw new \Exception(__("No Origami Root Category"));

		$allCategories = $this->categoryCollection->create()->addAttributeToSelect('*');

		/*
		$mappingCategories = [];

		foreach($allCategories as $category){
			if($category->getLevel() > 1){
				$mappingCategories[]

				//$this->origamiLogService->log(json_encode($category->getData()));
			}
		}
		*/

		/*
		OrigamiApiTools::api()->post("catalog/categories", [
			[
				"parent_id" => $rootOrigamiCategory['id'],
			],
			[
				"parent_id" => $rootOrigamiCategory['id'],
			]
		]);
		*/

		/*
		OrigamiApiTools::api()->post("catalog/categories", [
			"parent_id" => 2,
			"seller_visible" => true,
			"external_id" => 16,
			"level_depth" => 1,
			"cover_image_url" => "https://origami-marketplace.com/wp-content/uploads/2017/05/logoazul.png",
			"mini_image_url" => "https://origami-marketplace.com/wp-content/uploads/2017/05/logoazul.png",
			"mini_menu_image_url" => "https://origami-marketplace.com/wp-content/uploads/2017/05/logoazul.png",
			"active" => true,
			"translations": [
				{
					"language_id": 1,
					"name": "My Category",
					"description": "Lorem Ipsum",
					"link_rewrite": "my-category",
					"meta_title": "my cateory",
					"meta_keywords": "category",
					"meta_description": "Lorem Ipsum"
				},
				{
					"language_id": 2,
					"name": "My Category",
					"description": "Lorem Ipsum",
					"link_rewrite": "my-category",
					"meta_title": "my cateory",
					"meta_keywords": "category",
					"meta_description": "Lorem Ipsum"
				}
			]
		]);
		*/

		return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
	}
}