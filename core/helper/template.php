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
    private $_js_files  = array();
    private $_css       = '';
    private $_css_files = '';
    private $_footer    = '';
    private $_template  = '';
    private $_HTML      = '';
    
    public function __construct() 
    {
        if(file_exists(\core\config\general::__TEMPLATEHOST__. \core\config\general::__TEMPLATE__))
        {
            $this->setTemplate(\core\config\general::__TEMPLATEHOST__. \core\config\general::__TEMPLATE__);
            
            $this->setBase();
        }
        else
        {
           echo \core\config\general::__TEMPLATEHOST__ . \core\config\general::__TEMPLATE__;
        }
        
    }
    
    private function setBase()
    {
        //este metodo solo se modificara en caso de que exsista alfo generico para cualquier sistema 
    }
    
    /**
     * Toma el template asignado y lo coloca en HTML
     * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
     */
    public function loadTemplate()
    {
        $this->_HTML = file_get_contents($this->_template);
    }
    
    /**
     * asigna el template que se utilizara para renderizar 
     * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
     */
    private function setTemplate($template)
    {
        $this->_template = $template;
    }
    
    /**
     * sustituye una TAG del template con un valor dado 
     * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
     */
    public function setVariable($variable,$valor)
    {
        $this->_HTML = str_replace($variable, $valor, $this->_HTML);
    }
    
    public function agregarJS($script)
    {
        $this->_js .= $script;
    }
    
    public function agregarArchivoJS($file)
    {
        $this->_js_files[] = $file;
    }
    
    public function agregarCSS($style)
    {
        $this->_js .= $style;
    }
    
    public function agregarArchivoCSS($file)
    {
        $this->_css_files[] = $file;
        
        $this->_css = '';
                
        foreach( $this->_css_files as $css)
        {
            $this->_css .= '<link rel="stylesheet" href="'. \core\config\general::__CSSFOLDER__.$css.'">';
        }
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
