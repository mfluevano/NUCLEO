<?php

namespace core\lib;

/**
 * Clase encargada de obtener valores de las diferentes variables de PHP
 * como son
 *  _GET
 *  _POST
 * @author Mario Felipe Luevano Villagomez  <fluevano@gmail.com>
 */
class input {
//metodos temporales
    public function get($variable    )
    {
        return isset($_GET[$variable]) ? $_GET[$variable] : ''  ;
    }
    public function session($variable    )
    {
        return isset($_SESSION[$variable]) ? $_SESSION[$variable] : ''  ;
    }
}
