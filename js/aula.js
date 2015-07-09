$(document).ready(function() {
    //$(".formulario").hide();
    var base_url = 'http://localhost/novamusica/';
    var texto = /^[0-9 a-zA-Z áéíóúAÉÍÓÚÑñ]+$/;
    var num = /^[0-9]+$/;
    
    $("#crear").click(function() {
        if(!texto.test($("#nombreAula").val())){
            var error=$('<div class="text-error">').addClass('mensaje').hide().text('Carácter introducido no permitido.');
            $('#nombreAula').focus().after(error);
            error.fadeIn(800);
            //aux = false;
       }
       else if($(".nombreAula").val().length < 3){
            var error=$('<div class="text-error">').addClass('mensaje').hide().text('Debe introducir al menos tres caracteres');
            $('.nombreAula').focus().after(error);
            error.fadeIn(800);
            //aux = false;
       }
       if(!num.test($("#capacidad").val())){
            var error=$('<div class="text-error">').addClass('mensaje').hide().text('Por favor, introduzca solamente números.');
            $('#capacidad').focus().after(error);
            error.fadeIn(800);
            //aux = false;
       }
       else{ 
            $.ajax({
                type: "POST",
                url:  base_url +"admin/aula/registrar",
                data: $("#formdata").serialize(),
                datatype: "text",
                /*beforeSend:function(){
                    $('.formulario').append('<b>El formulario se esta enviando</b>');
                },*/
                success:function(res){ 
                    $(".formulario").append(res);
                    $(".aulas").append('<div>\n\
                                                <strong>'+$("#nombreAula").val() +' </strong> ('+ $("#capacidad").val() + 'personas)\n\
                                                <button type="button" class="btn btn-danger btn-xs pull-right">\n\
                                                    <i class="glyphicon glyphicon-trash"></i>\n\
                                                    Eliminar\n\
                                                </button>\n\
                                            </div>');
                    $("#nombreAula").val('');
                    $("#capacidad").val('');
                },
                error:function(){
                    $('.mensaje').append('<b class="text-error"> No se ha podido completar el registro</b>');
                }
            });

            return false;
        }
    });
    
    
});