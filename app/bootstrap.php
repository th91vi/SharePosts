<?php 
    // Carrega config
    require_once 'config/config.php';

    // Carrega Libraries
    // require_once 'libraries/core.php';
    // require_once 'libraries/controller.php';
    // require_once 'libraries/database.php';

    //Autocarrega core libraries
    spl_autoload_register(function($className){
        require_once 'libraries/'.$className.'.php';
    });

?>