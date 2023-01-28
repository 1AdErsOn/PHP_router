<?php

class Route{
    public function __construct()
    {
        
    }

    private static $uris =array();

    public static function add($method, $uri, $function = null){
        Route::$uris[] = new Uri(self::parseUri($uri), $method, $function);
        //retornar un middleware !Cambio!
        return;
    }
    public static function get($uri, $function = null){
        //echo $uri;
        return Route::add("GET", $uri, $function);
    }
    public static function post($uri, $function = null){
        return Route::add("POST", $uri, $function);
    }
    public static function put($uri, $function = null){
        return Route::add("PUT", $uri, $function);
    }
    public static function delete($uri, $function = null){
        return Route::add("DELETE", $uri, $function);
    }
    public static function any($uri, $function = null){
        return Route::add("ANY", $uri, $function);
    }
    private static function parseUri($uri){ //Cambio
        $uri = trim($uri, '/');
        $uri = (strlen($uri) > 0 ) ? $uri : '/';
        return $uri;
    }
    public static function submit(){
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = isset($_GET['uri']) ? $_GET['uri'] : '';
        $uri = self::parseUri($uri);
        //echo $uri.' ';
        //var_dump(Route::$uris);

        //verifica si la uri que esta pidiendo el usuario se encuentra registrado
        foreach (Route::$uris as $key => $recordUri) {

            if($recordUri->match($uri)){ //cambio
                return $recordUri->call();
            }
        }

        //Muestra el mensaja de error 404...
        header("Content-Type: text/html");
        echo 'la uri <a href="'.$uri.'">'.$uri.'</a> no se encuentra registrada en el metodo '.$method.'.';
    }
}