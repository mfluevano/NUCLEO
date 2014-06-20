<?php
namespace
{
    require 'plugins/autoload/autoload.php';
    
    ob_start();
    
    $test= \core\controller\controller::getInstance();
    
    echo $test->iniciar();
    
    
    
    ob_end_flush();
}