<?php

namespace Training\Feedback\Controller\Index;

use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action {
    
    private $pageResultFactory;
    
    public function __construct(
        Context $context,
        PageFactory $pageResultFactory
    ) {
        $this->pageResultFactory = $pageResultFactory;
        parent::__construct($context);
    }
    
    public function execute() {
        $result = $this->pageResultFactory->create();
        return $result;
    }
}
