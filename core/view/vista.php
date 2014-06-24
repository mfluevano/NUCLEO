<?php
namespace core\view;

class vista 
{
    private $_controller = null;
    private $_template   = null;
    
    public function __construct() 
    {   
        $this->_template = new \core\helper\template();
    }
 
    /**
     * Metodo encargado de llamar el modulo corresponfiente pintarlo y mostrar sus 
     * mensajes
     * @author Mario Felipe Luevano Villagomez <fluevano@gmail.com>
     */
    
    public function render()
    {
        return $this->_template->renderHTML();   
    }
    
    public function __call($name, $arguments) 
    {
        $this->Html='No se localiza el metodo'. $name;
    }
}