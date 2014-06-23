<?php
namespace core\view;

class vista 
{
    private $_controller = null;
    
    public function __construct() 
    {
    }
 
    /**
     * Metodo encargado de llamar el modulo corresponfiente pintarlo y mostrar sus 
     * mensajes
     * @author Mario Felipe Luevano Villagomez <fluevano@gmail.com>
     */
    
    public function render()
    {
        
    }
    
    public function __call($name, $arguments) 
    {
        $this->Html='No se localiza el metodo'. $name;
    }
}