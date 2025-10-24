<!--__________________TABLA__________________-->
<table id="tabla_transportistas" class="table table-bordered table-striped">
    <thead class="thead-dark" bgcolor="#eeeeee">
        <th>Acciones</th>
        <th>Nombre / Razon social</th>
        <th>Usuario vinculado</th>
        <th>Departamento</th>
        <th>Registro</th>
        <!-- <th>Tipo</th> -->
    </thead>
    <tbody>
    <?php
        if($generadores){
            foreach($generadores as $fila){
                echo "<tr data-json='".json_encode($fila)."'>";
                echo    '<td>';
                echo    '<button type="button" title="Editar" class="btn btn-primary btn-circle btnEditar" data-toggle="modal" data-target="#modalEdit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>&nbsp
                        <button type="button" title="Info" class="btn btn-primary btn-circle btnInfo btnInfo" data-toggle="modal" data-target="#modalEdit"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></button>&nbsp
                        <button type="button" title="eliminar" class="btn btn-primary btn-circle btnEliminar" data-toggle="modal" data-target="#modalBorrar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>&nbsp';
                echo   '</td>';
                echo    '<td>'.$fila->razon_social.'</td>';
                echo    '<td>'.$fila->user_id.'</td>';
                echo    '<td>'.$fila->depa_nombre.'</td>';
                echo    '<td>'.$fila->num_registro.'</td>';                       
                echo '</tr>';
            }
        }
    ?>
    </tbody>
</table>
<!--__________________FIN TABLA__________________-->
<script>
$(".btnEditar").click( function(e){
    var data = JSON.parse($(this).parents("tr").attr("data-json")); 
   
    $("#E_Nombre_Razon_social").val(data.razon_social);
    $("#E_CUIT").val(data.cuit);
    $("#E_Numero_registro").val(data.num_registro);
    $("#E_Domicilio").val(data.domicilio);
    // $("#E_lat").val(data.lat);
    // $("#E_long").val(data.lng);
    $("#id_gen").val(data.sotr_id);
    $(".titulo").text('Editar Generador');
    $(".habilitar").removeAttr("readonly");
    $(".ocultar").removeAttr("style");
    $(".mostrar").attr("style","display:none");
    $('#btnsave_e').show(); 
    var tipozona = data.zona_id;
    $("#E_Zonag").val(tipozona);   
    
		// lena input tipo RSU 
		llenarSelectRsu(data.tiposCarga.carga);	
    // habilita el input
    $("#tica_edit").prop("disabled", false);
    
		var tipogen = data.tist_id;
    $("#E_TipoG").val(tipogen);
    var tiporubro = data.rubr_id;
    $("#E_TipoR").val(tiporubro);

    llenarFormDinamico(data.transportistas_formularios.transportista_formulario, $('#modalEdit .frm-new'), true);
});

$(".btnInfo").click(function(e){
    var data = JSON.parse($(this).parents("tr").attr("data-json"));

    console.table(data);
    $("#E_Nombre_Razon_social").val(data.razon_social);
    $("#E_CUIT").val(data.cuit);
    $("#E_Numero_registro").val(data.num_registro);
    $("#E_Domicilio").val(data.domicilio);
    // $("#E_lat").val(data.lat);
    // $("#E_long").val(data.lng);
    $("#id_gen").val(data.sotr_id);
    $(".titulo").text('Informacion Generador');
    $(".habilitar").attr("readonly","readonly"); 
    $('#btnsave_e').hide();
    //
    $(".ocultar").attr("style","display:none");
    $(".mostrar").removeAttr("style");
    $(".mostrar").attr("readonly","readonly"); 
    var tipozona = data.zona_id;
    $("#E_Zonag").val(tipozona);
    $("#text_zona").val(data.zona_nombre);   
		
		// llena input tipo RSU 
		llenarSelectRsu(data.tiposCarga.carga);	
    // deshabilita el input
		$("#tica_edit").prop("disabled", true); 
	 
	  // $("#text_residuos").val(tipores.substr(10,50));
    var tipogen = data.tist_id;
    $("#E_TipoG").val(tipogen);
    $("#text_generador").val(tipogen.substr(14,50));
    var tiporubro = data.rubr_id;
    $("#E_TipoR").val(tiporubro);   
    $("#text_rubro").val(tiporubro.substr(15,50));

    // llena form dinamico
    let $modalForm = $('#modalEdit').find('.frm-new');
    llenarFormDinamico(data.transportistas_formularios.transportista_formulario, $modalForm, false);

});

$(".btnEliminar").click(function(e){
    var data = JSON.parse($(this).parents("tr").attr("data-json")); 
    $('#btndelete').show();    
    $("#id_generador").val(data.sotr_id);
});

// llena select multiple con RSU y selcciona los guardados
function llenarSelectRsu($tipos){	
		
	var opcGuardadas = [];		
	// recorro los tipos de carga asociados		
	$.each($tipos, function(key,rsu_asociado){				
		opcGuardadas.push(rsu_asociado.tabl_id);		
	});	
		
	// seteo as opciones predeterminadas
	$('#tica_edit').val(opcGuardadas);
	$('#tica_edit').trigger('change');	
}

// llena datos del form dinamico asociado al generador
function llenarFormDinamico(data, $formContenedor, modoEdicion) {  
    // Limpiar valores
    $formContenedor.find('input').val('');
    $formContenedor.find('select').val('').trigger('change');

    // Llenar valores
    $.each(data, function(index, item) {
        let label = item.label.toLowerCase().trim();
        let valor = item.valor;
        switch(label) {
            case 'n° de expediente':
                let $exp = $formContenedor.find('#expediente');
                $exp.val(valor);
                if (!modoEdicion) $exp.prop('readonly', true);
                else $exp.prop('readonly', false);
                break;

            case 'evaluador':
                let $sel = $formContenedor.find('select[name="evaluadores_resi"]');
                $sel.val(valor).trigger('change');
                if (!modoEdicion) {
                    $sel.prop('disabled', true);
                    if ($sel.hasClass('select2-hidden-accessible')) {
                        $sel.select2({disabled: true});
                    }
                }else {
                    $sel.prop('disabled', false);
                    if ($sel.hasClass('select2-hidden-accessible')) {
                        $sel.select2({disabled: false});
                    }
                }
                break;

            case 'responsable técnico':
                let $sele = $formContenedor.find('select[name="consultor_resi"]');
                $sele.val(valor).trigger('change');
                if (!modoEdicion) {
                    $sele.prop('disabled', true);
                    if ($sele.hasClass('select2-hidden-accessible')) {
                        $sele.select2({disabled: true});
                    }
                }else {
                    $sele.prop('disabled', false);
                    if ($sele.hasClass('select2-hidden-accessible')) {
                        $sele.select2({disabled: false});
                    }
                }
                break;     

            case 'e-mail':
                let $email = $formContenedor.find('#email');
                $email.val(valor);
                if (!modoEdicion) $email.prop('readonly', true);
                else $email.prop('readonly', false);
                break;

            case 'teléfono':
                let $telefono = $formContenedor.find('#telefono');
                $telefono.val(valor);
                if (!modoEdicion) $telefono.prop('readonly', true);
                else $telefono.prop('readonly', false);
                break;

            case 'domicilio legal':
                let $domicilio_legal = $formContenedor.find('#domicilio_legal');
                $domicilio_legal.val(valor);
                if (!modoEdicion) $domicilio_legal.prop('readonly', true);
                else $domicilio_legal.prop('readonly', false);
                break;
        }
    });
}


DataTable($('#tabla_transportistas'));
// DataTable($('#tabla_'));
</script>