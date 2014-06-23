<?php
/**
 * interface para el modelo de permisos utilizado para este nucleo
 */

namespace core\interfaces;

/**
 *
 * @author Mario Felipe Luevano Villagomez <fluevano@gmail.com>
 */
interface permisos {
    
    public function getPermisos();
    
    public function validaPermiso($ruta);
    
    public function obtenerPermisos();
    
}
