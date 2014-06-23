<?php
/**
 *Index de la capa de controlador encargado del funcionamiento general del sitio
 
 * @author MFLUEVANO
 */

namespace core\controller;

class controller implements \core\interfaces\controllers
{
   #control
   private $_claseActual   = '';
   private $_mensaje       = '';
   private $_seccion       = '';
   private $_modulo        = '';
   private $_operacion     = '';
   private $_estatus       = null;
   private $_standalone    = false;
   #operacion (objetos)
   private $_controller    = null;
   private $_permisos      = null;
  
   


   static private $instance = null;

   public function __construct()
   {
       $this->_permisos = new \core\acl\test();
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
    * Obtiene el mensaje-estatus en el que se encuentra la clase al momento
    * de ser llamada 
    */

   public function getMensaje()
   {
       return $this->_mensaje;
   }
   
   /**
    * Obtiene el estatus en el que se encuentra la clase al momento
    * de ser llamada 
    */

   public function getEstatus()
   {
       return $this->_estatus;
   }

   /**
    * Asigna el mensaje-estatue en el que se encuentra la clase 
    * de ser llamada 
    */
   
   private function setMensaje($msg,$estatus = \core\config\vars::ok)
   {
       $this->_mensaje = $msg;
       
       $this->_estatus = $estatus;
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
    * Genera la instancia de la clase que se utilizara en el modulo actual 
    * @throws \Exception
    * @author Mario Felipe Luevano Villagomez<fluevano@gmail.com>
    */

   private function setInstancia()
   {
       if(class_exists($this->_claseActual))
       {
           $this->_controller = new $this->_claseActual();
           
           $this->setMensaje('',\core\config\vars::ok);
       }
       else
       {
           throw new \Exception('Modulo no registrado');
       }
   }
   
   #Overrides controllers
  
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
           $this->_trace();
           
           $vista = new \core\view\vista();
           
           $this->_controller = $this->setInstancia();
           
           return $vista->render($this);

       }  
       catch (\Exception $E)
       {
           $this->setMensaje($E->getMessage(), \core\config\vars::error);
       }

   }
   
   public function permisos() 
   {
       $this->_permisos->validaPermiso($this->_claseActual);
   }
   
}
