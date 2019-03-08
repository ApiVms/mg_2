<?php

namespace Training\Feedback\ViewModel;

use Magento\Framework\UrlInterface;

class FeedbackForm implements \Magento\Framework\View\Element\Block\ArgumentInterface {
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
    
    public function getActionUrl() {
        return $this->urlBuilder->getUrl('training_feedback/index/save/');
        // return $this->urlBuilder->getUrl('training_feedback/layout/save');
    }
}
