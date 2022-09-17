<?php
//Llamada al modelo
require_once("models/equipos_model.php");

$equipo=new equipos_model();
$datos=$equipo->get_equipos("general",0);

$marca=new equipos_model();
$marcas=$marca->get_marcas();

//Llamada a la vista
require_once("views/equipos_view.php");
?>
