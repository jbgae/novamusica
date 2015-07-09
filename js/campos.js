
function AgregarCampos(){
    
    campo = '<div class="form-inline" id="semana"> <select name="diaSemana[]"><option value="1">Lunes</option><option value="2">Martes</option><option value="3">Miércoles</option><option value="4">Jueves</option><option value="5">Viernes</option><option value="6">Sábado</option><option value="7">Domingo</option></select> <label>Hora inicio:</label> <input type="text" name="HoraInicio[]" value=""  size="10"/> <label>Hora fin:</label> <input type="text" name="HoraFin[]" value="" size="10" />  </div>';
    $("#semana").append(campo);
    
    //campo = '<select name="diaSemana[]"><option value="1">Lunes</option><option value="2">Martes</option><option value="3">Miércoles</option><option value="4">Jueves</option><option value="5">Viernes</option><option value="6">Sábado</option><option value="7">Domingo</option></select><label>Hora inicio:</label><label>Hora fin:</label><input type="text" name="" value=""  />  ';
    $.post("http://localhost/novamusica/grupo/registrar",{}, function(data) {
                $(".check").html(data);
    });
    //$("#semana").append(campo);
}