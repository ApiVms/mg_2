<?php

namespace Training\Feedback\Block;

use \Magento\Framework\View\Element\Template\Context;
use \Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory;
use \Magento\Framework\Stdlib\DateTime\Timezone;
use \Training\Feedback\Model\ResourceModel\Feedback;

class FeedbackList extends \Magento\Framework\View\Element\Template {
    
    const PAGE_SIZE = 5;
    
    private $feedbackResource;
    private $collectionFactory;
    private $collection;
    private $timezone;
    
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        Timezone $timezone,
        Feedback $feedbackResource,
        array $data = array()
    ) {
        parent::__construct($context, $data);
        
        $this->collectionFactory = $collectionFactory;
        $this->feedbackResource = $feedbackResource;
        $this->timezone = $timezone;
    }
    
    public function getCollection() {
        if (!$this->collection) {
            $this->collection = $this->collectionFactory->create();
            $this->collection->addFieldToFilter('is_active', 1);
            $this->collection->setOrder('creation_time', 'DESC');
        }
        return $this->collection;
    }
    
    public function getPagerHtml() {
        $pagerBlock = $this->getChildBlock('feedback_list_pager');

        if ($pagerBlock instanceof \Magento\Framework\DataObject) {
            /* @var $pagerBlock \Magento\Theme\Block\Html\Pager */
            $pagerBlock
            ->setUseContainer(true)
            ->setShowPerPage(true)
            ->setShowAmounts(true)
            ->setLimit($this->getLimit())
            ->setCollection($this->getCollection());
            
            return $pagerBlock->toHtml();
        }
        return '';
    }
    
    public function getLimit() {
        return static::PAGE_SIZE;
    }
    
    public function getAddFeedbackUrl() {
        return $this->getUrl('training_feedback/layout/form');
    }
    
    public function getFeedbackDate($feedback) {
        return $this->timezone->formatDateTime($feedback->getCreationTime());
    }
    
    public function getAllFeedbackNumber() {
        return $this->feedbackResource->getAllFeedbackNumber();
    }
    
    public function getActiveFeedbackNumber() {
        return $this->feedbackResource->getActiveFeedbackNumber();
    }
}
