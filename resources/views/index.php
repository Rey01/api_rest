<!doctype html>
<html lang="es">
  <head>
    <!-- Etiquetas <meta> obligatorias para Bootstrap -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Enlazando el CSS de Bootstrap -->
    <link rel="stylesheet" href="./css/bootstrap.min.css"  crossorigin="anonymous">

    <title>Api-Rest</title>
    <style>
    #suggestions {
        box-shadow: 2px 2px 8px 0 rgba(0,0,0,.2);
        height: auto;
        position: absolute;
        top: 70px;
        z-index: 9999;
        width: 206px;
    }
    
    #suggestions .suggest-element {
        background-color: #EEEEEE;
        border-top: 1px solid #d6d4d4;
        cursor: pointer;
        padding: 8px;
        width: 100%;
        float: left;
    }
    </style>
  </head>
  <body>
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Cliente</h1>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-4"> 
                <div class="form-group"> 
                    <label>Busqueda</label>
                    <input type="text" class="form-control" id="q" name="q" autocomplete="off">
                    <small id="1" class="form-text text-muted">Para generar la busqueda precionar la tecla "Enter" o dar clic en buscar.</small>
                </div>  
                <button type="button" class="btn btn-success" onclick="sugerencias()">Buscar</button> 
                
<div id="suggestions"></div>
        </div>
        <div class="col-md-6">
            <div id="showMap" style="width: 100%; height: 350px;"> </div>
        </div>
    </div>
    
    <div class="row"> 
        <div class="col-md-2">
        </div>
        <div class="col-md-8 text-center" id="datos" style="margin-top:50px;">
        </div>
    </div>

    <!---INICIO MODAL DE REGISTRO--->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal_registro">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Quien eres?</h5> 
            </div>
            <div class="modal-body">
                <div class="alert alert-info">Si es primera vez que ingresas favor decomprimir el archivo (ciudades.rar) que esta en la raiz y posterior a generar las migraciones importar dicho archivo a la tabla ciudades</div>
                <form id="formulario_registro">
                    <div class="form-group" style="display:none;" id="div_error"> 
                        <div class="alert alert-danger" id="alert_error"> 
                            Datos errorneos
                        </div>
                    </div>  
                    <div class="form-group"> 
                        <label>Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Ingrese un nombre">
                    </div>  
                    <div class="form-group"> 
                        <label>Edad</label>
                        <input type="text" class="form-control" id="edad" name="edad"  placeholder="Ingrese su edad">
                    </div> 
                    <div class="form-group"> 
                        <label>Sexo</label>
                        <select class="form-control" id="sexo" name="sexo"  >
                            <option value="">Seleccione...</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                    </select> 
                    </div> 
                </form> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="guardar_datos()">Guardar</button> 
            </div>
            </div>
        </div>
    </div>
    <!---FIN MODAL DE REGISTRO--->
    <input type="hidden" id="token" value="">
    <input type="hidden" id="latitude" value="">
    <input type="hidden" id="longitude" value="">
    <!-- Enlazando el JavaScript de Bootstrap -->
    <script src="./js/jquery.min.js" crossorigin="anonymous"></script>
    <script src="./js/popper.min.js" crossorigin="anonymous"></script>
    <script src="./js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="./js/usuario.js" crossorigin="anonymous"></script>
    <script src="./js/ciudades.js" crossorigin="anonymous"></script>
    <script src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <script>
        $( document ).ready(function() {
            $("#modal_registro").modal({backdrop: 'static', keyboard: false});
            $('#q').on('keyup', function(event) { 
                //si se preciona la tecla enter
                if(event.which==13){
                    sugerencias();
                } 
            });
        }); 
        function showGoogleMaps(latitud,longitud)
        {
            window.scroll({
            top: 0, 
            behavior: 'smooth'
            });
            //Creamos el punto a partir de la latitud y longitud de una dirección:
            var point = new google.maps.LatLng(latitud,longitud);
            //var point = new google.maps.LatLng('41.397122', '2.152873');

            //Configuramos las opciones indicando zoom, punto y tipo de mapa
            var myOptions = {
                zoom: 15, 
                center: point, 
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            //Creamos el mapa y lo asociamos a nuestro contenedor
            var map = new google.maps.Map(document.getElementById("showMap"),  myOptions);

            //Mostramos el marcador en el punto que hemos creado
            var marker = new google.maps.Marker({
                position:point,
                map: map
            });
        } 

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(mostrarUbicacion);
            
            function mostrarUbicacion (ubicacion) {
                const lng = ubicacion.coords.longitude;
                const lat = ubicacion.coords.latitude;  
                $("#latitude").val(lng);
                $("#longitude").val(lng);  
                showGoogleMaps(lat,lng);
            }
        } 
    </script>
  </body>
</html>