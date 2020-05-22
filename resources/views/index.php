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
                <div class="form-group"> 
                    <label>Busqueda</label>
                    <input type="text" class="form-control" id="q" name="q">
                    <small id="1" class="form-text text-muted">Para generar la busqueda precionar la tecla "Enter" o dar clic en buscar.</small>
                </div>  
                <button type="button" class="btn btn-success" onclick="sugerencias()">Buscar</button> 
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
    </script>
  </body>
</html>