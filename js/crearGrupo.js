$(document).ready(function() {
    
    $("#crearGrupo").click(function() { 
        var texto = /^[a-zA-Z áéíóúAÉÍÓÚÑñ 0-9]+$/;
        var fecha = /([0-9]{2})\/([0-9]{2})\/([0-9]{4})/;
        
        if(!texto.test($("#nombreGrupo").val())){
            var error=$('<div class="text-error">').addClass('error').hide().text('Por favor, introduzca solamente texto.');
            $('#nombreGrupo').focus().after(error);
            error.fadeIn(800);
            //aux = false;
       }
       else{

            $.ajax({
                    type: "POST",
                    url: "http://localhost/novamusica/admin/grupo/registrar",
                    data: $("#formdata").serialize(),
                    datatype: "text",
                    beforeSend:function(){
                        $('#mensaje').html('<b>El formulario se esta enviando</b>');
                    },
                    success:function(res){ 
                        $("#mensaje").html(res);
                        $('#formdata').each(function(){
                            this.reset();   
                        });
                        //location.reload();
                    }
                    
            });
            
            return false;
        }
       
    });
});