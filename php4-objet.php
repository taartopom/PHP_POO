<?php
    /* opérateur de résolution de portée */
    function loadClass($class) {
        require "Entity/".$class.".php";
    }
    spl_autoload_register("loadClass");

    // constantes PHP
    const TVA = 20;
    echo TVA;
?>