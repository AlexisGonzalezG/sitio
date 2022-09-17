<?php
if (isset($_POST['id_equipo']) ) {

    //Llamada al modelo
    require_once("../db/db.php");
    require_once("../models/equipos_model.php");

    $equipo=new equipos_model();
    $id_equipo = $_POST['id_equipo'];
    $datos=$equipo->get_comentarios($id_equipo);

    echo json_encode($datos);

}
?>
