<?php
class equipos_model{
    private $db;
    private $equipos;
    private $calificaciones;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->equipos=array();
    }

    public function get_marcas(){
        $consulta=$this->db->query("SELECT * FROM catalogo_marcas WHERE estatus = 1;");
         while($filas=$consulta->fetch_assoc()){
            $this->marcas[]=$filas;
         }
        return $this->marcas;
    }

    public function get_equipos($tipo,$valor){

        $cadena = "";

        if( $tipo == "id" && $valor !=0 ){
            $cadena = " AND eq.id = ".$valor;
        }

        if( $tipo == "marca" && $valor !=0 ){
            $cadena = " AND eq.id_marca = ".$valor;
        }
         
        $consulta=$this->db->query("SELECT 
                                    eq.id,
                                    eq.modelo,
                                    eq.especificaciones,
                                    eq.precio,
                                    eq.cantidad,
                                    eq.url_image,
                                    eq.vistas,
                                    eq.me_gusta,
                                    cm.marca,
                                    (SELECT COUNT(*) FROM calificaciones WHERE id_equipo = eq.id) AS comentarios
                                    FROM equipos AS eq
                                    INNER JOIN catalogo_marcas cm ON (eq.id_marca = cm.id)
                                    WHERE eq.estatus = 1".$cadena);


        while($filas=$consulta->fetch_assoc()){
            $this->equipos[]=$filas;
        }
        return $this->equipos;
    }
    
    public function get_comentarios($valor){

        $consulta=$this->db->query("SELECT 
                                    *
                                    FROM calificaciones
                                    WHERE estatus = 1 
                                    AND id_equipo = ".$valor);


        while($filas=$consulta->fetch_assoc()){
            $this->calificaciones[]=$filas;
        }

        return $this->calificaciones;
    }
    
}
?>