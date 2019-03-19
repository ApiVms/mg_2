<?php

namespace Training\FeedbackProduct\Observer;

use Magento\Framework\Event\ObserverInterface;

class SaveFeedbackProducts implements ObserverInterface {
    
    private $feedbackProducts;
    
    public function __construct(
        \Training\FeedbackProduct\Model\FeedbackProducts $feedbackProducts
    ) {
        $this->feedbackProducts = $feedbackProducts;
    }
    
    public function execute(\Magento\Framework\Event\Observer $observer) {
        // $feedback = $observer->getFeedback();
        $feedback = $observer->getEvent()->getData('feedback');
//        var_dump($feedback->getExtensionAttributes()->getProducts());
//        $this->printFeedback($feedback);
        $this->feedbackProducts->saveProductRelations($feedback);
    }
    
    private function printFeedback($feedback) {
        echo $feedback->getId() . ' : '
        . $feedback->getAuthorName()
        . ' (' . $feedback->getAuthorEmail() . ')';
        echo "<br/>\n";
        exit();
    }
}