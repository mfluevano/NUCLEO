<?php
/**
 *Controlador generico que define el funcionamiento de ejecucion de modulo del sistema
 * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
 */

namespace core\controller;

class controller implements \core\interfaces\controllers
{
   #control
   private $_claseActual   = '';
   private $_mensaje       = '';
   private $_sistema       = '';
   private $_seccion       = '';
   private $_modulo        = '';
   private $_operacion     = '';
   private $_estatus       = null;
   private $_standalone    = false;
   #operacion (objetos) -- dependencias que serán inyectados por consuecuencia tendran metodos que las definan
   private $_controller    = null;
   private $_permisos      = null;
   private $_input         = null;  
   private $_debug         = null;
   private $_cliente       = null;
   #instancia propia
   static private $instance = null;
   
/**
 * constructor de la clase
 */
   public function __construct()
   {
       $this->_permisos = new \core\acl\test();
   }
   
/**
 * Obtiene lqa ultima instancia de si mismo o genera una nueva en caso de no existir
 * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
 * @return Objeto
 */
   public static function getInstance()
   {
       if (self::$instance == null)
       {
           self::$instance = new self;
       }

       return self::$instance;
   }
   
   /**
    * define el objeto para hacer el debug utilizado en el controlador
    * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
    */
   public function definirDebug($debug)
   {
       $this->_debug = $debug;
   }
   
   /**
    * define el objeto para el manejo general de variables como ;
    * Get
    * Post
    * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
    */
   public function definirInput($input)
   {
       $this->_input = $input;
   }
   
   /**
    * Define el template conel que traajara la clase
    */
   
   /**
    * Conecta el cliente Nusoao
    * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
    */
   private function conectar_cliente()
   {
       $this->_cliente = new \soapclient(\core\config\general::$server. \core\config\general::$wsdl, array('trace' => 1, 'exceptions' => TRUE));
   }
   
   /**
    * Obtiene el mensaje-estatus en el que se encuentra la clase al momento
    * de ser llamada 
    * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
    */
   public function getMensaje()
   {
       return $this->_mensaje;
   }
   
   /**
    * Obtiene el estatus en el que se encuentra la clase al momento
    * de ser llamada 
    * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
    */
   public function getEstatus()
   {
       return $this->_estatus;
   }

   /**
    * Asigna el mensaje-estatue en el que se encuentra la clase 
    * de ser llamada 
    * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
    */
   public function setMensaje($msg,$estatus = \core\config\vars::ok)
   {
       $this->_mensaje = $msg;
       
       $this->_estatus = $estatus;
       
       //$this->_debug->trace($this->getMensaje(),$this->getEstatus());
   }
   
   /**
    * Forma la ruta de la clase a llamar a partir de las variables formadas en el
    * metodo _trace()
    * 
    */
   private function in_generaRutaClase()
   {
       $sistema = strlen($this->_sistema) > 0 ? '\\'.$this->_sistema : '';
       
       $seccion = strlen($this->_seccion) > 0 ? '\\'.$this->_seccion : '';
       
       $modulo = strlen($this->_modulo)  > 0 ? '\\'.$this->_modulo  : '';
       
       return $sistema . $seccion . $modulo . $modulo;
   }

   /**
    * Metodo encargado de tomar la url solicitada y definir el modulo
    * @author Mario Felipe Luevano Villagomez<fluevano@gmail.com>
    */
   private function _trace()
   {
       $this->_sistema      = $this->_input->get('sistema');
       
       $this->_seccion      = $this->_input->get('seccion');
       
       $this->_modulo       = $this->_input->get('modulo');
       
       $this->_operacion    = $this->_input->get('operacion');
       
       $this->_standalone   = $this->_input->get('standalone');
       
       $this->_claseActual  = \core\config\general::__SYSTEMFOLDER__.$this->in_generaRutaClase();
   }
   
    /**
    * Genera la instancia de la clase que se utilizara en el modulo actual 
    * @throws \Exception
    * @author Mario Felipe Luevano Villagomez<fluevano@gmail.com>
    */
   private function setInstancia()
   {
       if($this->_input->session('logueado'))
       {
           if(class_exists($this->_claseActual))
           {
               $this->_controller = new $this->_claseActual();
               
               $this->setMensaje('Iniciando.sistema',\core\config\vars::ok);
           }
           else
           {
               throw new \Exception('Modulo '.$this->_claseActual.' no registrado');
           }
       }
       else
       {
           
       }
   }
   
   /**
    * valida el permiso de acceso sobre la clase actual
    */
   public function permisos() 
   {
       $this->_permisos->validaPermiso($this->_claseActual);
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
           
           $this->_trace();
           
           $this->conectar_cliente();
           
           $this->setInstancia();
           
           return $this->_controller->render();
           
       }  
       catch (\Exception $E)
       {
           $this->setMensaje($E->getMessage(), \core\config\vars::error);
           
           return $this->getMensaje();
       }

   }

   
}
