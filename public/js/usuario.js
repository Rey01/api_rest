function guardar_datos(){ 
    if($("#nombre").val()==""){
        $("#alert_error").html("Nombre invalido");
        $("#div_error").slideDown();
        return false;
    }
    if($("#edad").val()==""){
        $("#alert_error").html("Edad invalido");
        $("#div_error").slideDown();
        return false;
    }
    if($("#sexo").val()==""){
        $("#alert_error").html("Sexo invalido");
        $("#div_error").slideDown();
        return false;
    } 
    $("#div_error").slideUp();
    $.ajax({
        type: "POST",
        dataType: "json",
        data:$("#formulario_registro").serialize(),
        url: "guadar_usuario",
    })
    .done(function( data, textStatus, jqXHR ) { 
        $("#token").val(data[0].token); 
        if($("#token").val()!=""){
            $("#modal_registro").modal("hide");
        } 
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        if ( console && console.log ) {
            console.log( "La solicitud a fallado: " +  textStatus);
        }
    });
}