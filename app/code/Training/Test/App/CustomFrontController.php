<?php

namespace Training\Test\App;

use \Magento\Framework\App\FrontController;
use Magento\Framework\App\Request\ValidatorInterface as RequestValidator;
use Magento\Framework\Message\ManagerInterface as MessageManager;


class CustomFrontController extends FrontController { //implements FrontControllerInterface {
    /**
    * @var \Magento\Framework\App\RouterList
    */
    protected $_routerList;
    /**
    * @var \Magento\Framework\App\Response\Http
    */
    protected $response;
    /**
    * @var \Psr\Log\LoggerInterface
    */
    private $logger;
    /**
    * @param \Magento\Framework\App\RouterList $routerList
    * @param \Magento\Framework\App\Response\Http $response
    * @param \Psr\Log\LoggerInterface $logger
    */
    public function __construct(
        \Magento\Framework\App\RouterList $routerList,
        \Magento\Framework\App\Response\Http $response,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->_routerList = $routerList;
        $this->response = $response;
        $this->logger = $logger;
        
        parent::__construct($routerList, $response, null, null, $logger);
    }
    
    public function dispatch(\Magento\Framework\App\RequestInterface $request) {
//        $result = print_r(get_class($this->_routerList));
//        echo "<script>console.log('ROUTER LIST:', $result)</script>";
        
        foreach ($this->_routerList as $router) {
            $this->logger->info(get_class($router));
        }
        
        return parent::dispatch($request);
    }
}
