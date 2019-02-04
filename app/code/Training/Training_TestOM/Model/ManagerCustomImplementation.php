<?php

namespace Training\Training_TestOM\Model;

class ManagerCustomImplementation implements ManagerInterface {
    
    public function __construct() {
        // echo "<script>console.log('constructor ManagerCustomImplementation class')</script>";
    }
    
    public function create() {
        // custom logic
    }
    public function get() {
        // custom logic
    }
}
