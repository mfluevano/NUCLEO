<?php
namespace core\view;

class vista {
    
    
    
    
    public function __construct() 
    {
    }
    
    
   
    public function __call($name, $arguments) 
    {
        $this->Html='No se localiza el metodo'. $name;
    }
}