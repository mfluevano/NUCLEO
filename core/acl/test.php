<?php

namespace core\acl;

class test implements \core\interfaces\permisos
{
    private $_permisos = null;
    
    public function __construct() {
        $this->obtenerPermisos();
    }
    
    public function getPermisos() {
        return $this->_permisos;
    }

    public function obtenerPermisos() {
        $this->_permisos = array();
    }

    public function validaPermiso($ruta) {
        return true;
    }

}
