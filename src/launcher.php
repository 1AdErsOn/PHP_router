<?php

require_once './src/Roots.php';
require_once PATH_SRC.'autoloader/Autoloader.php';
//require('./src/router/Ruote.php');

Autoloader::registrar();
require './routes/web.php';

$rutas = scandir(PATH_ROUTES);
//var_dump($rutas);
foreach ($rutas as $archivo) {
    //var_dump($archivo);
    $rutaArchivo = realpath(PATH_ROUTES.$archivo);
    //var_dump($rutaArchivo);
    if(is_file($rutaArchivo)){
        //var_dump($rutaArchivo);
        echo "funciona";
        require $rutaArchivo;
    }
}

Route::submit();