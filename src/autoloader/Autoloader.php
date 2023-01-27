<?php

class Autoloader{
    public static function registrar(){
        if (function_exists('__autoload')) {
            spl_autoload_register('__autoload');
            return;
        }
        if(version_compare(PHP_VERSION, '5.3.0')  >= 0){
            spl_autoload_register(array('Autoloader', 'cargar'), true, true);
        }else{
            spl_autoload_register(array('Autoloader', 'cargar'));
        }
    }
    public static function cargar($clase)
    {
        $nombreArchivo = $clase.'.php';
        $carpetas = require PATH_CONFIG.'autoloader.php';
        foreach ($carpetas as $carpeta) {
            if(self::buscarArchivo($carpeta,$nombreArchivo)){
                return true;
            }
        }
        return false;
    }
    private static function buscarArchivo($carpeta,$nobreArchivo){
        $Archivos = scandir($carpeta);
        foreach ($Archivos as $archivo) {
            $rutaArchivo = realpath($carpeta.DIRECTORY_SEPARATOR.$archivo);
            if(is_file($rutaArchivo)){
                if($nobreArchivo == $archivo){
                    require_once $rutaArchivo;
                    return true;
                }
            }else if($archivo != '.' && $archivo != '..'){
                return self::buscarArchivo($rutaArchivo, $nobreArchivo);
                //return;
            }
        }
        return false;
    }
}