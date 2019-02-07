<?php

namespace Training\Test\Observer;

use Magento\Framework\Event\ObserverInterface;

class RedirectToLogin implements ObserverInterface {
    
    /**
     * @var \Magento\Framework\App\Response\RedirectInterface $redirect
     */
    private $redirect;
    /**
     * @var \Magento\Fremework\App\ActionFlag $actionFlag
     */
    private $actionFlag;
    
    /**
    * @param \Magento\Framework\App\Response\RedirectInterface $redirect
    * @param \Magento\Framework\App\ActionFlag $actionFlag
    */
    public function __construct(
        \Magento\Framework\App\Response\RedirectInterface $redirect
        //\Magento\Fremework\App\ActionFlag $actionFlag
    ) {
        $this->redirect = $redirect;
        //$this->actionFlag = $actionFlag;
    }
    
    public function execute(\Magento\Framework\Event\Observer $observer) {
        
        $request = $observer->getEvent()->getData('request');
        
        // exit();
        
        if ($request->getFullActionName() == 'catalog_product_view' // altenative way
//        if (
//               $request->getModuleName() == 'catalog'
//            && $request->getControllerName() == 'product'
//            && $request->getActionName() == 'view'
        ) {
            $controller = $observer->getEvent()->getData('controller_action');
            //$this->actionFlag->set('', \Magento\Framework\App\Action\Action::FLAG_NO_DISPATCH, true);
            $this->redirect->redirect($controller->getResponse(), 'customer/account/login');
        }
    }    
}