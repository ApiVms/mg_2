<?php

namespace Training\FeedbackProduct\Controller\Index;

use \Magento\Framework\App\Action\Context;
use \Training\Feedback\Model\FeedbackFactory;
use \Training\Feedback\Model\ResourceModel\Feedback;
use \Training\FeedbackProduct\Model\FeedbackDataLoader;

use \Magento\Framework\App\Action\Action;
use \Magento\Framework\App\Action\HttpPostActionInterface;

class Save extends Action { // implements HttpPostActionInterface {
    
    private $feedbackFactory;
    private $feedbackResource;
    private $feedbackDataLoader;
    
    public function __construct(
        Context $context,
        FeedbackFactory $feedbackFactory,
        Feedback $feedbackResource,
        FeedbackDataLoader $feedbackDataLoader
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackResource = $feedbackResource;
        $this->feedbackDataLoader = $feedbackDataLoader;
        
        parent::__construct($context);
    }
    
    public function execute() {

//        echo 'SAVE FROM FEEDBACK PRODUCT: ' . get_class($this->feedbackFactory);
//        exit();
        
        $result = $this->resultRedirectFactory->create();
        $post = $this->getRequest()->getPostValue();
        
        if ($post) {
            try {
                $this->validatePost($post);
                
                $feedback = $this->feedbackFactory->create();
                $feedback->setData($post);
                
                $this->setProductsToFeedback($feedback, $post);
                $this->feedbackResource->save($feedback);
                
                $this->messageManager->addSuccessMessage(
                    __('Thank you for your feedback.')
                );
                $result->setPath('training_feedback/index/index');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('An error occurred while processing your form. Please try again later.')
                );
                $result->setPath('training_feedback/layout/form');
                // $result->setPath('*/*/form');
            }
        }
        
        $result->setPath('training_feedback/index/index');
        return $result;
    }
    
    private function setProductsToFeedback($feedback, $post) {
          
        $skus = [];
        if (isset($post['products_skus']) && !empty($post['products_skus'])) {
            $skus = explode(',', $post['products_skus']);
            $skus = array_map('trim', $skus);
            $skus = array_filter($skus);
            
//            echo 'PRODUCTS SKUS FORM FORM = '.$post['products_skus'];
//            exit();
        }
        $this->feedbackDataLoader->addProductsToFeedbackBySkus($feedback, $skus);
    }
   
    private function validatePost($post) {
        if (!isset($post['author_name']) || trim($post['author_name']) === '') {
            throw new LocalizedException(__('Name is missing'));
        }
        if (!isset($post['message']) || trim($post['message']) === '') {
            throw new LocalizedException(__('Comment is missing'));
        }
        if (!isset($post['author_email']) || false === \strpos($post['author_email'], '@')) {
            throw new LocalizedException(__('Invalid email address'));
        }
        if (trim($this->getRequest()->getParam('hideit')) !== '') {
            throw new \Exception();
        }
    }
}
