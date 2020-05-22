
function logArrayElements(element, index, array) { 
    $("#suggestions").append(' <div><a class="suggest-element" latitude="'+element.latitude+'" longitude="'+element.longitude+'" data="'+element.name+'" id="product'+index+'">'+element.name+'</a></div>  ');
}
function sugerencias(){
    $("#datos").html('<img src="./img/loading.gif">');
    q = $("#q").val();
    latitude = $("#latitude").val();
    longitude = $("#longitude").val(); 
    token = $("#token").val(); 
    url = "sugerencias?q="+q+"&latitude="+latitude+"&longitude="+longitude;
    $.get(url, function(response) {  
            $("#datos").html("");
            $("#suggestions").html("");
            response["suggestions"].forEach(logArrayElements);
             //Escribimos las sugerencias que nos manda la consulta
             $('#suggestions').fadeIn(1000);
             //Al hacer click en alguna de las sugerencias
             $('.suggest-element').on('click', function(){
                     //Obtenemos la id unica de la sugerencia pulsada
                     var id = $(this).attr('id');
                     //Obtenemos la latitude de la sugerencia pulsada
                     var latitude = $(this).attr('latitude');
                     //Obtenemos la longitude de la sugerencia pulsada
                     var longitude = $(this).attr('longitude');
                     //Editamos el valor del input con data de la sugerencia pulsada
                     $('#q').val($('#'+id).attr('data'));
                     //Hacemos desaparecer el resto de sugerencias
                     $('#suggestions').fadeOut(1000);
                       
                     //Hacemos que el mapa se ubique en lo seleccionado
                    showGoogleMaps(latitude,longitude); 
                     return false;
             });
        });
}
