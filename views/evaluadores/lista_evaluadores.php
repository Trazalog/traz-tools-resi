<!--__________________TABLA__________________-->
<table id="tabla_evaluadores" class="table table-bordered table-striped">
    <thead class="thead-dark" bgcolor="#eeeeee">
        <th>Acciones</th>
        <th>Nombre y Apellido</th>
        <th>DNI</th>
        <th>Formacion</th>
        <th>Telefono</th>
        <th>Email</th>
    </thead>
    <tbody>
    <?php
        if($evaluadores){
            foreach($evaluadores as $fila){
                echo "<tr data-json='".json_encode($fila)."'>";
                echo    '<td>';
                echo    '<button type="button" title="Editar" class="btn btn-primary btn-circle btnEditar" data-toggle="modal" data-target="#modalEdit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>&nbsp
                        <button type="button" title="Info" class="btn btn-primary btn-circle btnInfo btnInfo" data-toggle="modal" data-target="#modalEdit"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></button>&nbsp
                        <button type="button" title="eliminar" class="btn btn-primary btn-circle btnEliminar" data-toggle="modal" data-target="#modalBorrar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>&nbsp';
                echo   '</td>';
                echo    '<td>'.$fila->nombre.'</td>';
                echo    '<td>'.$fila->dni.'</td>';
                echo    '<td>'.$fila->formacion.'</td>';
                echo    '<td>'.$fila->telefono.'</td>';
                echo    '<td>'.$fila->email.'</td>';                       
                echo '</tr>';
            }
        }
    ?>
    </tbody>
</table>
<script>

// boton editar
    $(".btnEditar").click( function(e){
        var data = JSON.parse($(this).parents("tr").attr("data-json")); 
    
        $("#E_nombre").val(data.nombre);
        $("#E_dni").val(data.dni);
        $("#E_telefono").val(data.telefono);
        $("#E_email").val(data.email);
        $("#E_formacion").val(data.id_formacion);
        $('#text_evaluador').hide();
        $(".titulo").text('Editar Evaluador');
        $(".habilitar").removeAttr("readonly");
        $(".ocultar").removeAttr("style");
        $(".mostrar").attr("style","display:none");
        $("#E_dni").attr("readonly","readonly");
        $('#btnsave_e').show(); 
    
    });


// boton info
$(".btnInfo").click(function(e){
    var data = JSON.parse($(this).parents("tr").attr("data-json")); 
    console.table(data);
    $("#E_nombre").val(data.nombre);
    $("#E_dni").val(data.dni);
    $("#E_telefono").val(data.telefono);
    $("#E_email").val(data.email);
    $("#E_formacion").val(data.id_formacion);
    $('#text_evaluador').val(data.formacion).show();
    
    $(".titulo").text('Informacion Evaluador');
    $(".habilitar").attr("readonly","readonly"); 
    $('#btnsave_e').hide();
    $(".ocultar").attr("style","display:none");
    $(".mostrar").removeAttr("style");
    $(".mostrar").attr("readonly","readonly"); 

}); 

// boton eliminar
$(".btnEliminar").click(function(e){
    var data = JSON.parse($(this).parents("tr").attr("data-json")); 
    $('#btndelete').show();    
    $("#dni_evaluador").val(data.dni);
});


    DataTable($('#tabla_evaluadores'));
</script>