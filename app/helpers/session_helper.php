<?php
    session_start();

    // Flash message helper
    // EXEMPLO - flash('register_success', 'Você agora está registrado', 'alert alert-danger');
    // MOSTRA NA VIEW - <?php echo flash('register_success'); ? >
    function flash($name = '', $message = '', $class = 'alert alert-success'){
        if(!empty($name)){
            // $name está definida
            if(!empty($message) && empty($_SESSION[$name])){ // $message definida e sessão para $name não definida
                if (!empty($_SESSION[$name])) { //Sessão para $name não está vazia, primeiro fazer unset
                    unset($_SESSION[$name]);
                }


                if (!empty($_SESSION[$name. '_class'])) {
                    unset($_SESSION[$name. '_class']);
                }

                $_SESSION[$name] = $message;
                $_SESSION[$name. '_class'] = $class;
            } elseif (empty($message) && !empty($_SESSION[$name])) {
                $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
                echo '<div class="'.$class.'" id ="msg-flash">'.$_SESSION[$name].'</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_class']);
            }
        }
    }
?>