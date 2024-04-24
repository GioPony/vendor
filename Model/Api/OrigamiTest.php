<?php 
namespace Origami\Vendor\Model\Api;

use \Magento\Framework\Controller\Result\JsonFactory;
use \Magento\Framework\Webapi\Request;
use \Magento\Store\Model\StoreManagerInterface;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Store\Model\ScopeInterface;
use \Magento\Framework\Webapi\Exception;

use \Origami\Core\Service\OrigamiLogService;
use Origami\Vendor\Api\OrigamiTestInterface;

class OrigamiTest implements OrigamiTestInterface {

    private JsonFactory $jsonFactory;
    private StoreManagerInterface $storeManager;
    private ScopeConfigInterface $scopeConfig;
    private OrigamiLogService $origamiLogService;
    private Request $request;

    public function __construct(
        JsonFactory $jsonFactory,
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig,
        OrigamiLogService $origamiLogService,
        Request $request
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->origamiLogService = $origamiLogService;
        $this->request = $request;
    }

    /**
     * Sync Origami Seller
     *
     * @param string $id
     * @return string
     */
    public function test($id)
    {
        $result = [];

        $result[] = [
            "a" => "B"
        ];

        return $result;
    }
}