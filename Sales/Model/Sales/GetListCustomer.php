<?php

namespace AHT\Sales\Model\Sales;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;

class GetListCustomer extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    protected $_customer;
    protected $_customerFactory;
    protected $connection;

    public function __construct(
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\Customer $customers,
        \Magento\Framework\App\ResourceConnection $resource
    ) {
        $this->_customerFactory = $customerFactory;
        $this->_customer = $customers;
        $this->connection = $resource->getConnection();
    }
    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {

            $query = $this->connection->fetchAll("SELECT c.firstname, c.entity_id FROM customer_entity as c 
        LEFT JOIN customer_entity_int  as i ON i.entity_id = c.entity_id 
        RIGHT JOIN eav_attribute as e ON i.attribute_id = e.attribute_id 
        WHERE attribute_code = 'is_sales_agent'");

            foreach ($query as $key => $item) {
                $this->_options[] = [
                    'label' => $item['firstname'],
                    'value' => $item['entity_id'],
                ];
            }
        }
        return $this->_options;
    }
}
