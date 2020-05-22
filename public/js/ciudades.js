
function logArrayElements(element, index, array) { 
    $("#t_body").append(' <tr> <td>'+index+'</td>  <td>'+element.name+'</td> <td>'+element.latitude+'</td> <td>'+element.longitude+'</td> <td><button type="button" class="btn btn-primary" onclick="showGoogleMaps('+element.latitude+','+element.longitude+')">Buscar</button></td><tr>  ');
}
function sugerencias(){
    $("#datos").html('<img src="./img/loading.gif">');
    q = $("#q").val();
    latitude = $("#latitude").val();
    longitude = $("#longitude").val(); 
    token = $("#token").val(); 
    url = "sugerencias?q="+q+"&latitude="+latitude+"&longitude="+longitude;
    $.get(url, function(response) {  
            $("#datos").html("<table class='table'><thead><tr>  <td>#</td>   <td>Nombre</td>  <td>Latitude</td> <td>Longitude</td> <td>Ubicar</td> </tr> </thead><tbody id='t_body'></tbody></table>");
            response["suggestions"].forEach(logArrayElements); 
        });
}
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