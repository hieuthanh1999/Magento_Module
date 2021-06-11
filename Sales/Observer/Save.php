<?php

namespace AHT\Sales\Observer;

class Save implements \Magento\Framework\Event\ObserverInterface
{
    public function __construct()
    {
        // Observer initialization code...
        // You can use dependency injection to get any class this observer may need.
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        //  /** @var OrderInterface $order */
        //  $order = $observer->getEvent()->getOrder();
        //  $orderId = $order->getEntityId();
        //  echo "<pre>"; print_r($orderId);
        // $orderIds = $observer->getEvent()->getOrderIds();
        // $order = $observer->getEvent()->getOrder();
        // echo "<pre>";
        // var_dump($order->getData());
        // echo "</pre>";
        // var_dump($orderIds); exit;
        // // $order = $observer->getEvent()->getOrder();
        // // var
        // // echo $orderId = $order->getId();
        // die;
        // $comment = $this->getRequest()->getParam('comment');
        // print_r("Catched event succssfully !"); exit;
    }
}
