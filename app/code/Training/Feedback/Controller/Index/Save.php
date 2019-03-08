<?php

namespace Training\Feedback\Controller\Index;

use \Magento\Framework\App\Action\Context;
use \Training\Feedback\Model\FeedbackFactory;
use \Training\Feedback\Model\ResourceModel\Feedback;
use \Magento\Framework\App\Action\Action;

class Save extends Action {
    
    private $feedbackFactory;
    private $feedbackResource;
    
    public function __construct(
        Context $context,
        FeedbackFactory $feedbackFactory,
        Feedback $feedbackResource
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackResource = $feedbackResource;
        
        parent::__construct($context);
    }
    
    public function execute() {
        $result = $this->resultRedirectFactory->create();
        
        if ($post = $this->getRequest()->getPostValue()) {
            try {
                $this->validatePost($post);
                
                $feedback = $this->feedbackFactory->create();
                $feedback->setData($post);
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
            }
        }
        return $result;
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
