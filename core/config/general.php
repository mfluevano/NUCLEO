<?php
/**
 * Esta clase es solo de configuracion
 */
namespace core\config;

class general{       

 #configutaciones para el cliente nusoap
    static $server = "http://localhost/operadoraMaxipuntos/";
    
    static $wsdl = "lealtadWS/srv_cat.php?wsdl";
    
 #directivas y constantes
    const __DBHOST__        = 'localhost';

    const __DBLOGIN__       = '';

    const __DBPASS__        = ''; 

    const __DBNAME__        = '';

    const __CSSFOLDER__     = 'site_media/css/';
    
    const __TEMPLATEHOST__  = 'site_media/html/templates/';

    const __TEMPLATE__      =  'base.html';

    const __SYSTEMFOLDER__  = 'sistema';

 #configuraciones
    const __PERMISOS__      = FALSE;

    const __DEBUG__         = FALSE;



}
    