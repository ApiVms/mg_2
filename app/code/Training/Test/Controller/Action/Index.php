<?php

namespace Training\Test\Controller\Action;

class Index extends \Magento\Framework\App\Action\Action {
    
    /**
    * @var \Magento\Framework\Controller\Result\RawFactory
    */
    private $resultRawFactory;
    /**
    * @var \Magento\Framework\View\LayoutFactory
    */
    private $layoutFactory;
    /**
    * @param \Magento\Backend\App\Action\Context $context
    * @param \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    * @param \Magento\Framework\View\LayoutFactory $layoutFactory
    */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    ) {
        $this->resultRawFactory = $resultRawFactory;
        $this->layoutFactory = $layoutFactory;
        
        parent::__construct($context);
    }

    public function execute() {
        
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock(\Magento\Framework\View\Element\Template::class);
        $resultRaw = $this->resultRawFactory->create();
        $block->setTemplate("Training_Test::test.phtml");
        $html = $block->toHtml();
        
        return $resultRaw->setContents($html);
    }
}

