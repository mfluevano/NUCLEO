<?php

namespace core\controller;

/**
 * Controla permiso de sistema
 *
 * @author desarrollo8
 */
class acl implements \core\interfaces\permisos
{
    private $_permisos = array();
    
    public function getPermisos()       
    {
        
    }
    
    public function setPermisos($permisos)
    {
        $this->_permisos = $permisos;
    }

    public function validaPermiso($ruta) 
    {
        
    }

}
