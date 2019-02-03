<?php

namespace Training\Training_TestOM\Model;

class Test {
    private $manager;
    private $name;
    private $number;
    private $arrayList;
    
    public function __construct(
            \Training\Training_TestOM\Model\ManagerInterface $manager,
//            object  $manager,
            string $name,
            int $number,
            array $arrayList
        ){
            $this->manager = $manager;
            $this->name = $name;
            $this->number = $number;
//            print ($my_number);
//            print (gettype($my_number));
            $this->arrayList = $arrayList;
    }
    
    public function log()
    {
        print_r(get_class($this->manager));
        echo '<br>';
        print_r($this->name);
        echo '<br>';
        print($this->number);
        echo '<br>';
        print_r($this->arrayList);
    }
}
