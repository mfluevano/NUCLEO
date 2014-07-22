<?php
namespace core\interfaces;

/**
 *
 * @author Mario Felipe Luevano Villagomez <fluevano@gmail.com>
 */
interface controllers {
    /**
     * Funcion qiue se encarga de iniciar las configuraciones del nucleo y
     * arrancar el sistema
     * @author Mario Felipe Luevano Villagomez <fluevano@gmail.com>
     */
    
    public function iniciar();
    
    /**
     * Funcion que se encarga de generar un arbol de permisos para el sistema
     * @author Mario Felipe Luevano Villagomez <fluevano@gmail.com>
     */
    public function permisos();
    
    /**
     * Funcion que se encarga de asignar un estatus al controlador
     * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
     */
    
    public function setMensaje($msg,$estatus);
    /**
     * Funcion que se encarga de obtener el estatus del controlador
     * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
     */
    
    public function getMensaje();
    
}
