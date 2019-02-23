<?php
namespace Training\Render\ViewModel;

use Magento\Framework\UrlInterface;

class Form implements \Magento\Framework\View\Element\Block\ArgumentInterface {
    /**
    * @var \Magento\Framework\UrlInterface
    */
    private $urlBuilder;
    /**
    * @param \Magento\Framework\UrlInterface $urlBuilder
    */
    public function __construct(UrlInterface $urlBuilder) {
        $this->urlBuilder = $urlBuilder;
    }
    
    public function getSubmitUrl() {

        return $this->urlBuilder->getUrl('customer/account/login');
    }
}