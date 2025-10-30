<!--__________________TABLA__________________-->
<table id="tabla_consultores" class="table table-bordered table-striped">
    <thead class="thead-dark" bgcolor="#eeeeee">
        <th>Acciones</th>
        <th>Nombre y Apellido</th>
        <th>N° de Registro</th>
        <th>Formacion</th>
        <th>Telefono</th>
        <th>Email</th>
        <th>Vigencia</th>
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
                echo    '<td>'.$fila->registro.'</td>';
                echo    '<td>'.$fila->profesion.'</td>';
                echo    '<td>'.$fila->telefono.'</td>';
                echo    '<td>'.$fila->email.'</td>'; 
                echo    '<td>'.$fila->vigencia.'</td>';                         
                echo '</tr>';
            }
        }
    ?>
    </tbody>
</table>

<script>
    


// boton info
$(".btnInfo").click(function(e){
    var data = JSON.parse($(this).parents("tr").attr("data-json")); 
    console.table(data);
    $("#E_nombre").val(data.nombre);
    $("#E_registro").val(data.registro);
    $("#E_telefono").val(data.telefono);
    $("#E_email").val(data.email);
    $("#E_vigencia").val(data.vigencia.substring(0,10));
    $("#E_profesion").val(data.id_profesion);
    $('#text_profesion').val(data.profesion).show();
    
    $(".titulo").text('Informacion Consultor');
    $(".habilitar").attr("readonly","readonly"); 
    $('#btnsave_e').hide();
    $(".ocultar").attr("style","display:none");
    $(".mostrar").removeAttr("style");
    $(".mostrar").attr("readonly","readonly"); 

}); 


// boton editar
    $(".btnEditar").click( function(e){
        var data = JSON.parse($(this).parents("tr").attr("data-json")); 
    
        $("#E_nombre").val(data.nombre);
        $("#E_registro").val(data.registro);
        $("#E_telefono").val(data.telefono);
        $("#E_email").val(data.email);
        $("#E_profesion").val(data.id_profesion);
        $("#E_vigencia").val(data.vigencia.substring(0,10));
        $('#text_profesion').hide();
        $(".titulo").text('Editar Consultor');
        $(".habilitar").removeAttr("readonly");
        $(".ocultar").removeAttr("style");
        $(".mostrar").attr("style","display:none");
        $("#E_registro").attr("readonly","readonly");
        $('#btnsave_e').show(); 
    
    });


// boton eliminar
$(".btnEliminar").click(function(e){
    var data = JSON.parse($(this).parents("tr").attr("data-json")); 
    $('#btndelete').show();    
    $("#registro_consultor").val(data.registro);
});


    DataTable($('#tabla_consultores'));
</script>