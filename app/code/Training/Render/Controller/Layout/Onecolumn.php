<?php

namespace Training\Render\Controller\Layout;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Onecolumn extends \Magento\Framework\App\Action\Action {
    
    private $resultPageFactory;
    
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
