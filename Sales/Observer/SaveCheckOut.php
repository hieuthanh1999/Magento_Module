<?php
 
namespace AHT\Sales\Observer;
 
use Magento\Framework\Event\Observer;
 
class SaveCheckOut implements \Magento\Framework\Event\ObserverInterface
{

    protected $customerRepository;
 
    public function __construct(
 
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository)
 
    {
 
        $this->customerRepository = $customerRepository;
 
    }
    
    public function execute(Observer $observer)
    {
        $accountController = $observer->getAccountController();
        // $customer = $observer->getCustomer();
        // $request = $accountController->getRequest();
    //     $customer = $observer->getEvent()->getCustomer();
    //    $customer = $customer->getPage();
        var_dump($accountController);
        die
    //     $contact_phone = $request->getPost('contact_phone_number');
    //     $company_type = $request->getPost('company_type');

    //    $customer = $observer->getEvent()->getData('customer');

    //     $customer->setCustomAttribute('contact_phone', $contact_phone);
    //     $customer->setCustomAttribute('company_type', $company_type);
    //     if($company_type == 3)
    //     {
    //         $organization_name = $request->getPost('organization_name');
    //         $customer->setCustomAttribute('organization_name', $organization_name);
    //     }
    //     $this->customerRepository->save($customer);
 
    //     return $this;
    }
   
}
