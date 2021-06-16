<?php
namespace AHT\CustomCheckOut\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

     /**
     * @param \Magento\Framework\Serialize\Serializer\Json
     */
    private $_json;

    /**
     * @param \Magento\Framework\Controller\Result\JsonFactory
     */
    private $_jsonFactory;

    /**
     * @param \Magento\Checkout\Model\Session
     */
    private $_checkoutSession;


    protected $resultJsonFactory;

    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       \Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    )
    {

        $this->_json = $json;
        $this->_jsonFactory = $jsonFactory;
        $this->_checkoutSession = $checkoutSession;
        $this->_pageFactory = $pageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        // $data = $this->getRequest()->getContent();
        // //$response = $this->_json->unserialize($data);

        
        // $this->$_checkoutSession->setData('date', $response['checkout-date']);
        // $this->$_checkoutSession->setData('comment', $response['checkout-comment']);
         //lấy dữ liệu từ ajax gửi sang
         $response = $this->getRequest()->getParams();
         /** @var \Magento\Framework\Controller\Result\Json $resultJson */
         $resultJson = $this->resultJsonFactory->create();
          // chuyển kết quả về dạng object json và trả về cho ajax
        // return $resultJson->setData($response);
        var_dump($response);
         return ;
    }
}