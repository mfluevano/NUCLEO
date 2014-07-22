<?php
namespace
{
    require 'plugins/autoload/autoload.php';
    
    ob_start();
    
    $system= \core\controller\controller::getInstance();
    
    $system->definirInput(new \core\lib\input());
    
    echo $system->iniciar();
    
    ob_end_flush();
}