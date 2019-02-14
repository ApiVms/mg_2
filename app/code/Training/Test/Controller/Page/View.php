<?php

namespace Training\Test\Controller\Page;

use \Magento\Framework\Exception\NoSuchEntityException;

class View extends \Magento\Cms\Controller\Page\View {
    
    protected $customerSession;
    protected $context;
    protected $resultForwardFactory;


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        \Magento\Customer\Model\Session $customerSession
    ) {
        $this->customerSession = $customerSession;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->context = $context;
        $this->resultForwardFactory = $resultForwardFactory;
        
        parent::__construct($this->context, $this->resultForwardFactory);
    }
    
    public function execute() {
        
        if ( !$this->customerSession->isLoggedIn() ) {
            $forwardResult = $this->resultForwardFactory->create();
            $forwardResult->setModule('customer');
            $forwardResult->setController('account');
            $forwardResult->forward('login');
            return $forwardResult;
        }
        return parent::execute();
    }
}