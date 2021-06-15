<?php

namespace AHT\Sales\Observer;
use Magento\Sales\Api\OrderRepositoryInterface;

class Save implements \Magento\Framework\Event\ObserverInterface
{


    protected $_productFactory;
    protected $_salesFactory;
    protected $orderRepository;

    public function __construct( OrderRepositoryInterface $OrderRepositoryInterface)
    {
        $this->orderRepository = $OrderRepositoryInterface;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
         // lấy dữ liệu từ checkout Session
        //  //Custom log:
        //  $writer = new \Zend\Log\Writer\Stream(BP.'/var/log/stackexchange.log');
        //  $logger = new \Zend\Log\Logger();
        //  $logger->addWriter($writer);

        //  $order_ids = $observer->getEvent()->getOrderIds()[0];
        //  $order = $this->orderRepository->get($order_ids);           
        //  $order_id = $order->getIncrementId();   
        //  $customer_email = $order->getCustomerEmail();
         

        // $logger->info("latest order Id ===>".$order_id."-------------".'customer Email ==>'.$customer_email);

        // foreach ($order->getAllVisibleItems() as $item)
        // {
        //       $logger->info("Item Name ===>".$item->getName());
        //       $logger->info("Item Sku  ===>".$item->getSku());


              
        // } 

    }
}