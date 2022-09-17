<?php
class Conectar{
    public static function conexion(){
        $conexion=new mysqli("localhost", "root", "", "portal");

        return $conexion;
    }
}
?>
