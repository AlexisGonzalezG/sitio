<?php
if (isset($_POST['tipo']) ) {

    //Llamada al modelo
    require_once("../db/db.php");
    require_once("../models/equipos_model.php");

    $equipo=new equipos_model();
    $valor = $_POST['valor'];

    if($_POST['tipo'] == "id"){
        $datos=$equipo->get_equipos("id",$valor);
    }

    if($_POST['tipo'] == "marca"){
        $datos=$equipo->get_equipos("marca",$valor);
    }

    echo json_encode($datos);

}
?>
