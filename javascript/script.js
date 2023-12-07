$(document).ready(function() {
    // Captura el clic en el enlace
    $("#presidente").click(function(event) {
        // Obtiene el texto del enlace
        var textoEnlace = $(this).text();

        var url = "/home/msc22dbp/public_html/ProyectoFinal/php/codigos/desplegarInformacion.php";

        // Envia el texto al servidor PHP utilizando AJAX
        $.ajax({
            type: 'GET',
            url: url,
            data: { textoEnlace: textoEnlace },
            success: function(response) {
                // Hacer algo con la respuesta del servidor si es necesario
                console.log(response);
            },
            error: funcionErrors
        });
    });
});


function funcionErrors(xhr,status,error){
	alert(xhr);
}// muestraEditarUsuario