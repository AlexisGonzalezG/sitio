
function buscar(valor1,tipo){

    if( tipo == "marca")
    valor = valor1;

    if( tipo == "id")
    valor = $("#input_id").val();
    
    $html = "";

    if(!$.isNumeric(valor)) {
      valor = 0;
    }

    $.ajax({
    type: "POST",
    url: 'controllers/buscar_controller.php',
    data: { 
     'valor': valor,
     'tipo': tipo,
    },
    success: function(response)
    {

        const obj = JSON.parse(response);
        obj.forEach(function(objj, index) {
        
       $html += "<div class='col-4'><div class='card'  style='width: 18rem;'>"+
                "<br><div class='badge bg-primary text-wrap' style='width: 6rem;'>"+
                objj.marca +
                "</div>"+
                "<center><img class='img-responsive' src=" + objj.url_image + " height='160' width='150'  /></center>"+
                "<div class='card-body'>"+
                "<p class='fw-lighter'>#" + objj.id + "</p>"+
                "<h4 class='card-title'>" + objj.modelo + "</h4>"+
                "<div class='overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-light' style='width: 100%; max-height: 100px;'>"+
                "<p class='card-text'>" + objj.especificaciones + "</p>"+
                "</div>"+
                "<br />"+
                "<button class='btn btn-warning' value='" + objj.id + "' onclick='pagar(this.value," + objj.precio + ")' data-bs-toggle='modal' data-bs-target='#modalPagar'>Comprar!</button>"+
                "<button class='btn btn-link' data-bs-toggle='modal' data-bs-target='#modalComentarios'>" + objj.comentarios + " Comentarios</button>"+
                "<ul class='list-group list-group-flush'>"+
                "<li class='list-group-item'>"+
                "<img src='img/like.png' width='20' class='d-inline-block align-text-top' />"+
                "<p class='fw-light'>" + objj.me_gusta + "</p>"+
                "</li>"+
                "<li class='list-group-item'>"+
                "<img src='img/seen.png' width='20' class='d-inline-block align-text-top' />"+
                "<p class='fw-light'>" + objj.vistas + "</p>"+
                "</li>"+
                "<li class='list-group-item bg-light'>"+
                "<p class='fw-bold'>" + formatterPeso.format(objj.precio) + "</p>"+
                "</li>"+
                "</ul>"+
                "</div></div></div>"; 

            });

        
                
    $("#div_row").html($html);        
        
   }
 });

}

function ver_comentarios(valor){

    html = "";

    $("#div_comentarios").html("");        

    $.ajax({
        type: "POST",
        url: 'controllers/comentarios_controller.php',
        data: { 
         'id_equipo': valor
           },
        success: function(response)
        {
            if(response != "null" ){

                const obj = JSON.parse(response);
                obj.forEach(function(objj, index) {
                
                html += "<img src='img/estrella.png' width='20' class='d-inline-block align-text-top' /> &nbsp;" + objj.calificacion +
                            "<p class='text-decoration-underline'>" + objj.nombre + "</p>" +
                            "<p class='text-start'>Fecha de publicacion: " + objj.creacion + " hrs.</p>" +
                            "<p class='lh-1 border-bottom'>" + objj.comentario + "</p>" 
                        });
            }
            else{

                html += "<p class='text-start'>Este articulo todavia no tiene publicaciones</p>";

            }

        $("#div_comentarios").html(html);        
            
       }
     });

}

function pagar(valor,valor2){

    html = "";

    porcentaje = valor2 * .10;
    p6 = (valor2 + porcentaje) / 6;
    p12 = (valor2 + porcentaje) / 12;

    html = "<select class='form-select'>"+
            "<option selected>Pago unico de " + formatterPeso.format(valor2) + "</option>"+
            "<option value=''>6 pagos de " + formatterPeso.format(p6) + " mensuales.</option>"+
            "<option value=''>12 pagos de " + formatterPeso.format(p12) + " mensuales.</option>"+
            "</select>";

    $("#div_mensualidades").html(html);        

}

const formatterPeso = new Intl.NumberFormat('es-mx', {
    style: 'currency',
    currency: 'MXN',
    minimumFractionDigits: 0
  })


