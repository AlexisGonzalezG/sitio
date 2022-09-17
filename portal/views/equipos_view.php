<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8" />
        <title>Equipos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="js/js.js"></script>

    </head>

    <body>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="img/logo.png" alt="Logo" width="120" class="d-inline-block align-text-top" />
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <li class="nav-item">
                <select class="form-select" onchange="buscar(this.value,'marca')">
                    <option value="0" selected>Todos...</option>
                     <?php
                         foreach ($marcas as $marca) {
                     ?>
                    <option value="<?php echo $marca["id"];?>"><?php echo $marca["marca"];?></option>
                     <?php 
                        }
                     ?>
                    </select>               
                 </li>

                 <li class="nav-item">
                 <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" id="input_id" placeholder="ID de equipo..." aria-label="Search" />
                        <button class="btn btn-info" type="submit" onclick="buscar(0,'id')">Buscar</button>
                    </form>
                </li>
                </div>
            </div>
        </nav>
        <br />
        <div class="container text-center">
            <div class="row" id="div_row">
                <?php
                  foreach ($datos as $dato) {
                ?>
                <div class="col-4">
                    <div class="card"  style="width:18rem;">
                    <br>
                    <div class="badge bg-primary text-wrap" style="width: 6rem;">
                     <?php echo $dato["marca"];?>
                    </div>
                    <center>
                        <img class="img-responsive" src="<?php echo $dato["url_image"];?>"  height="160" width="150" />
                        </center>
                        <div class="card-body">
                              <p class="fw-lighter">#<?php echo $dato["id"];?></p>
                            <h4 class="card-title"><?php echo $dato["modelo"];?></h4>
                            <div class="overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-light" style="width: 100%; max-height: 100px;">
                                <p class="card-text"><?php echo $dato["especificaciones"];?></p>
                            </div>
                            <br />
                            <button class="btn btn-warning" value="<?php echo $dato["id"];?>" onclick="pagar(this.value,<?php echo $dato['precio'];?>)" data-bs-toggle="modal" data-bs-target="#modalPagar">Comprar!</button>
                            <button class="btn btn-link" value="<?php echo $dato["id"];?>" onclick="ver_comentarios(this.value)" data-bs-toggle="modal" data-bs-target="#modalComentarios"><?php echo $dato["comentarios"];?> Comentarios</button>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <img src="img/like.png" width="20" class="d-inline-block align-text-top" />
                                    <p class="fw-light"><?php echo $dato["me_gusta"];?></p>
                                </li>
                                <li class="list-group-item">
                                    <img src="img/seen.png" width="20" class="d-inline-block align-text-top" />
                                    <p class="fw-light"><?php echo $dato["vistas"];?></p>
                                </li>
                                <li class="list-group-item bg-light">
                                <p class="fw-bold">$<?php echo number_format($dato["precio"]);?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
             }
            ?>
            </div>
        </div>
    </body

        <!-- Modal comentarios-->
        <div class="modal fade" id="modalComentarios" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title" >Comentarios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="div_comentarios" >
            </div>
             <div class="modal-footer">
             </div>
            </div>
         </div>
        </div>

        <!-- Modal pagar-->
        <div class="modal fade" id="modalPagar" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
             <div class="modal-header">
                <h5 class="modal-title">Nueva tarjeta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="div_comentarios" >
            <center><img src="img/tarjetas.png" width="60%" class="d-inline-block align-text-top" /></center>
            <br>
            <div id="div_mensualidades" > 
            </div>
            <br>
            <input class="form-control" type="text" id="" placeholder="Numero de la tarjeta" />
            <br>
            <input class="form-control" type="text" id="" placeholder="Nombre y Apellido" />
            <br>
            <input class="form-control" type="date" id="" placeholder="Fecha de vencimiento" />
            <br>
            <input class="form-control" type="text" id="" placeholder="Codigo de Seguridad" />
            <br>
            <button class="btn btn-warning" value="" onclick="">Pagar</button>
            </div>
             <div class="modal-footer">
             </div>
            </div>
         </div>
        </div>

</html>
