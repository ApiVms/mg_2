<?php

namespace Training\Feedback\Controller\Index;

use \Magento\Framework\App\Action\Context;
use \Training\Feedback\Api\Data\FeedbackInterfaceFactory;
use \Training\Feedback\Api\FeedbackRepositoryInterface;
use \Magento\Framework\Api\SearchCriteriaBuilder;
use \Magento\Framework\Api\SortOrderBuilder;



class Test extends \Magento\Framework\App\Action\Action {
    
    private $feedbackFactory;
    private $feedbackRepository;
    private $searchCriteriaBuilder;
    private $sortOrderBuilder;
    
    public function __construct(
        Context $context,
        FeedbackInterfaceFactory $feedbackFactory,
        FeedbackRepositoryInterface $feedbackRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackRepository = $feedbackRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        
        parent::__construct($context);
    }
    
    public function execute() {

        // create new item
        $newFeedback = $this->feedbackFactory->create();

        $newFeedback->setAuthorName('some name');
        $newFeedback->setAuthorEmail('test@test.com');
        $newFeedback->setMessage('ghj dsghjfghs sghkfgsdhfkj sdhjfsdf gsfkj');
        $newFeedback->setIsActive(1);
        
        $this->feedbackRepository->save($newFeedback);
        
        // load item by id
        $feedbackId = 17;
        $feedback = $this->feedbackRepository->getById($feedbackId);
        $this->printFeedback($feedback);

        // update item
        $feedbackToUpdate = $this->feedbackRepository->getById($feedbackId);
        $feedbackToUpdate->setMessage('CUSTOM ' . $feedbackToUpdate->getMessage());
        $this->feedbackRepository->save($feedbackToUpdate);
       
        // delete feedback
        $this->feedbackRepository->deleteById(1);
        
        // load multiple items
        $this->searchCriteriaBuilder->addFilter('is_active', 1);
        $sortOrder = $this->sortOrderBuilder->setField('message')->setAscendingDirection()->create();

        $this->searchCriteriaBuilder->addSortOrder($sortOrder);
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->feedbackRepository->getList($searchCriteria);
        
        foreach ($searchResult->getItems() as $item) {
            $this->printFeedback($item);
        }
        exit();
    }
    
    private function printFeedback($feedback) {
        echo $feedback->getId() . ' : '
        . $feedback->getAuthorName()
        . ' (' . $feedback->getAuthorEmail() . ')';
        echo "<br/>\n";
    }
}
