<!doctype html>
<html lang="es">
  <head>
    <!-- Etiquetas <meta> obligatorias para Bootstrap -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Enlazando el CSS de Bootstrap -->
    <link rel="stylesheet" href="./css/bootstrap.min.css"  crossorigin="anonymous">

    <title>Api-Rest</title>
  </head>
  <body>
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Cliente</h1>
        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-4">
            <form id="formulario_busqueda"> 
                <div class="form-group"> 
                    <label>Busqueda</label>
                    <input type="text" class="form-control" id="q" name="q">
                    <small id="1" class="form-text text-muted">Para generar la busqueda precionar la tecla "Enter" o dar clic en buscar.</small>
                </div>  
                <button type="button" class="btn btn-success" onclick="sugerencias()">Buscar</button>
            </form>
        </div>
        <div class="col-md-4">
            <div id="showMap" style="width: 100%; height: 350px;"> </div>
        </div>
    </div>
    
    <div class="row"> 
        <div class="col-md-2">
        </div>
        <div class="col-md-8 text-center" id="datos" style="margin-top:50px;">
            <h2>Sin Resultados</h2>  
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
    <script src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <script>  
        function logArrayElements(element, index, array) {
            console.log("a[" + index + "] = " + element);
            $("#t_body").append(' <tr> <td>'+index+'</td>  <td>'+element.name+'</td> <td>'+element.latitude+'</td> <td>'+element.longitude+'</td> <td><button type="button" class="btn btn-primary" onclick="showGoogleMaps('+element.latitude+','+element.longitude+')">Buscar</button></td><tr>  ');
        }
        function sugerencias(){  
            q = $("#q").val();
            latitude = $("#latitude").val();
            longitude = $("#longitude").val(); 
            token = $("#token").val(); 
            url = "sugerencias?q="+q+"&latitude="+latitude+"&longitude="+longitude;
            $.ajax({
                type: "get",
                dataType: "json", 
                url: url,
                beforeSend: function( xhr ) {
                    $("#datos").html('<img src="./img/loading.gif">');
                }
            })
            .done(function( data, textStatus, jqXHR ) {
                if ( console && console.log ) {
                    $("#datos").html("<table class='table'><thead><tr>  <td>#</td>   <td>Nombre</td>  <td>Latitude</td> <td>Longitude</td> <td>Ubicar</td> </tr> </thead><tbody id='t_body'></tbody></table>");
                    data["suggestions"].forEach(logArrayElements);
                }
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) {
                    console.log( "La solicitud a fallado: " +  textStatus);
                }
            });
        }
        $( document ).ready(function() {
            $("#modal_registro").modal({backdrop: 'static', keyboard: false});
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