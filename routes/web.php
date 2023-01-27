<?php

Route::get("/", function(){
    return "Hola mundo ";
});
Route::get("/saludame/:nombre", function(&nombre, Request $request){
    return "Hola mundo ".$nombre;
});
Route::get("/nombrecompleto", function(Request $request){
    return "Hola mundo ".$request->nombre." ".$request->apellido;
});
Route::get("/lista", function(){
    return [1,2,3,4];
});