<?php

namespace core\helper;

/**
 * Genera un HTML a partir de un archivo plantilla y se encarga de sustituir
 * los contenidos 
 * @author Mario Felipe Luevano Villagomez <fluevano@gmail.com>
 */
class template 
{
    private $_header    = '';
    private $_content   = '';
    private $_js        = '';
    private $_css       = '';
    private $_footer    = '';
    private $_template  = '';
    private $_HTML      = '';
    
    public function __construct() 
    {
        if(file_exists(\core\config\general::__TEMPLATEHOST__. \core\config\general::__TEMPLATE__))
        {
            $this->setTemplate(\core\config\general::__TEMPLATEHOST__. \core\config\general::__TEMPLATE__);
        }
        else
        {
           echo \core\config\general::__TEMPLATEHOST__ . \core\config\general::__TEMPLATE__;
        }
        
    }
    
    public function loadTemplate()
    {
        $this->_HTML = file_get_contents($this->_template);
    }
    
    private function setTemplate($template)
    {
        $this->_template = $template;
    }
    
    public function setVariable($variable,$valor)
    {
        $this->_HTML = str_replace($variable, $valor, $this->_HTML);
    }
    
    public function getHTML()
    {
        return $this->_HTML;
    }
    
    public function renderHTML()
    {
        $this->loadTemplate();
        
        $this->setVariable('{header}', $this->_header);
        
        $this->setVariable('{css}', $this->_css);
        
        $this->setVariable('{content}', $this->_content);
        
        $this->setVariable('{footer}', $this->_footer);
        
        $this->setVariable('{js}', $this->_js);
        
        return $this->getHTML();
        
    }
    
    public function __call($name, $arguments) 
    {
        $this->_HTML='No se localiza el metodo'. $name;
    }
}
