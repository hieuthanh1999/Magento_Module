<?php

namespace AHT\Sales\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_blockFactory;
	protected $_customer;
    protected $_customerFactory;
	protected $optArray;
	protected $connection;

	protected $json;
    protected $resultJsonFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\AHT\Sales\Model\SalesFactory $blockFactory,
		\Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\Customer $customers,
		\Magento\Framework\App\ResourceConnection $resource,
		\Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
	) {
		$this->_pageFactory  = $pageFactory;
		$this->_blockFactory = $blockFactory;
		$this->_customerFactory = $customerFactory;
        $this->_customer = $customers;

		$this->json = $json;
        $this->resultJsonFactory = $resultJsonFactory;

        $this->connection = $resource->getConnection();
		return parent::__construct($context);
	}

	public function execute()
	{

		$data = $this->getRequest()->getContent();
        $response = $this->json->unserialize($data);
        // /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
         // chuyển kết quả về dạng object json và trả về cho ajax
		return $resultJson->setData($response);
	    //$collection = $this->_customerFactory->create()->getCollection()->addFieldToFilter('is_sales_agent', 1);
		//$collection->addAttributeToSelect('firstname');
		// $query = $this->connection->fetchAll("SELECT c.firstname, c.entity_id FROM customer_entity as c LEFT JOIN customer_entity_int  as i ON i.entity_id
		// = c.entity_id RIGHT JOIN eav_attribute as e ON i.attribute_id = e.attribute_id WHERE attribute_code = 'is_sales_agent'");
		//$query = $this->connection->fetchAll("SELECT * FROM customer_eav_attribute_website  as c INNER JOIN eav_attribute as e ON c.attribute_id = e.attribute_id WHERE attribute_code = 'is_sales_agent'" );
		//$query = $this->connection->fetchAll("SELECT * from eav_attribute where attribute_code ='is_sales_agent'");
       // $query->;
		//$collection->addFieldToFilter('is_sales_agent', 1);
		
        //$collection = $this->_customerFactory->create()->getCollection()->addFieldToFilter('is_sales_agent', 1);
    
    //     foreach($query as $item) {
    //         $this->optArray[] = [
	// 			'label' => $item['firstname'],
	// 			'value' => $item['entity_id'],
	// 		];
    // }
	// 	echo '<pre>';
	// 	print_r($this->optArray);
	// 	echo '</pre>';
		
	// 	exit;
		//return $this->_pageFactory->create();
	}
}
