<?php

/**
 * Autoloader
 * * Autorequiere clases que se encuentren en las carpetas core, controllers o models
 */
spl_autoload_register(function ($className){
    $dirs = ["core", "core/ui", "controllers", "models"];
    foreach ($dirs as $dir) {
        $path = "{$dir}/{$className}.php";
        if (file_exists($path)) {
            require $path;
        }
    }
});
