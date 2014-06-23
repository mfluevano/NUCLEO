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
   private $_seccion       = '';
   private $_modulo        = '';
   private $_operacion     = '';
   private $_standalone    = false;
   


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
       $this->_seccion;

       $this->_claseActual = \core\config\general::__SYSTEMFOLDER__.$this->_seccion.$this->_modulo.$this->_modulo;
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
