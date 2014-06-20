<?php
/**
 *Index de la capa de controlador encargado del funcionamiento general del sitio
 
 * @author MFLUEVANO
 */
namespace core\controller;

class controller implements \core\interfaces\controllers{
   #
   private $_claseActual   = '';
   private $_controller    = null;
   private $_mensaje       = '';


   static private $instance = null;

   public function __construct()
   {
       $this->_trace();
   }

   public static function getInstance()
   {
       if (self::$instance == null)
       {
           self::$instance = new self;
       }

       return self::$instance;
   }

   /**
    * Obtiene el mensaje-estatue en el que se encuentra la clase al momento
    * de ser llamada 
    */

   public function getMensaje()
   {
       return $this->_mensaje;
   }

   /**
    * Asigna el mensaje-estatue en el que se encuentra la clase 
    * de ser llamada 
    */
   
   private function setMensaje($msg)
   {
       $this->_mensaje = $msg;
   }

   /**
    * Metodo encargado de tomar la url solicitada y definir el modulo
    * @author Mario Felipe Luevano Villagomez<fluevano@gmail.com>
    */

   private function _trace()
   {
       $url = strtolower($_SERVER['PATH_INFO']);

       $urlPartes = explode('/',$url);

       unset($urlPartes[0]);

       foreach($urlPartes as $dir)
       {
           $this->_claseActual .= '\\' . $dir;
       }

       $this->_claseActual.= '\\'. $urlPartes[count($urlPartes)];

       $this->_claseActual = \core\config\general::__SYSTEMFOLDER__. $this->_claseActual;
   }

   /**
    * Metodo encargado de:
    * configurar el ambiente
    * cargar modulos
    * manejo de permisos
    * @author Mario Felipe Luevano Villagomez<fluevano@gmail.com>
    */

   public function iniciar()
   {
       try 
       {
           $vista = new \core\view\vista();
           
           return $vista->render();

       }  
       catch (\Exception $E)
       {
           $this->setMensaje($E->getMessage());
       }

   }

   /**
    * Genera la instancia de la clase que se utilizara en el modulo actual 
    * @throws \Exception
    * @author Mario Felipe Luevano Villagomez<fluevano@gmail.com>
    */

   private function setInstancia()
   {
       if(class_exists($this->_claseActual))
       {
           $this->_controller = new $this->_claseActual();
       }
       else
       {
           throw new \Exception('Modulo no registrado');
       }
   }    

}
