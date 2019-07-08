<?php 
    // Carrega config
    require_once 'config/config.php';

    // Carrega helpers
    require_once 'helpers/url_helper.php';

    //Carrega sessão
    require_once 'helpers/session_helper.php';

    // Carrega Libraries
    // require_once 'libraries/core.php';
    // require_once 'libraries/controller.php';
    // require_once 'libraries/database.php';

    //Autocarrega core libraries
    spl_autoload_register(function($className){
        require_once 'libraries/'.$className.'.php';
    });

?>