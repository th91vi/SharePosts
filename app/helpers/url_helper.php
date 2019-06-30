<?php
    // Redirecionamento de página simples
    function redirect($page){
        header('location: ' . URLROOT . '/' . $page);
    }
?>