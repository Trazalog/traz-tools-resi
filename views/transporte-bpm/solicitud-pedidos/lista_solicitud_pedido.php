<!--__________________TABLA__________________-->
<table id="tabla_solicitudes_pedido" class="table table-bordered table-striped">
    <thead class="thead-dark" bgcolor="#eeeeee">
        <th>Acciones</th>
        <th>Observaciones</th>
        <th>Transportista</th>
        <th>Tipo Residuo</th>
        <th>Fecha</th>
        <th>Cantidad solicitada</th>
        <th>Estado</th>
    </thead>
    <tbody>
    <?php
        if($solicitudes){
            foreach($solicitudes as $fila){
                echo "<tr data-json='".json_encode($fila)."'>";
                echo    '<td>';
                echo    '<button type="button" title="Ver detalle" class="btn btn-primary btn-circle btnInfo btnInfo" data-toggle="modal" data-target="#modalInfo"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></button>&nbsp
                        <button type="button" title="Eliminar" class="btn btn-primary btn-circle btnEliminar" data-toggle="modal" data-target="#modalBorrar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>&nbsp';
                echo   '</td>';
                echo    '<td>'.$fila->observaciones.'</td>';
                echo    '<td>'.$fila->transportista.'</td>';
                echo    '<td>'.$fila->tipo_residuo.'</td>';
                echo    '<td>'.$fila->fec_alta.'</td>';                       
                echo    '<td class="centrar">'.$fila->cantidad.'</td>';                       
                switch ($fila->estado) {
                    case 'SOLICITADA':
                      echo '<td class="text-center"><span data-toggle="tooltip" title="" class="badge bg-blue">SOLICITADA</span></td>';
                      break;
  
                    case 'ENTREGA_ACORDADA':
                      echo '<td class="text-center"><span data-toggle="tooltip" title="" class="badge bg-green">ENTREGA ACORDADA</span></td>';
                      break;
  
                    default:
                      echo '<td class="text-center"><button type="button" class="btn btn-secondary">'.$fila->estado.'</button></td>';
                      break;
                }
                echo '</tr>';
            }
        }
    ?>
    </tbody>
</table>
<!--__________________FIN TABLA__________________-->
<!---//////////////////////////////////////--- MODAL INFO ---///////////////////////////////////////////////////////----->

    
<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title titulo" id="exampleModalLabel">Informacion Solicitud</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="info_observaciones">Observaciones:</label>
                            <br>
                            <input type="text" class="form-control" id="info_observaciones" name="info_observaciones" disabled>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="info_trnasportista">Transportista:</label>
                            <br>
                            <input type="text" class="form-control" id="info_trnasportista" name="info_trnasportista" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="info_tipo_residuo" >Tipo de residuo:</label>
                            <input type="text" class="form-control" id="info_tipo_residuo" name="info_tipo_residuo" disabled>
                        </div>				
                    </div>				
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="info_fecha">Fecha de solicitud:</label>
                            <input type="text" class="form-control" id="info_fecha" name="info_fecha" disabled>
                        </div>
                    </div>
                </div>
                <!-- ____________________________________________________________________________________________ -->
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label for="info_cantidad">Cantidad solicitada:</label>
                            <input type="text" class="form-control" id="info_cantidad" name="info_cantidad" disabled>  
                        </div>                                
                    </div>
                </div>
            </div><!-- ./modal-body -->
            <div class="modal-footer">
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-default" id="btnsave" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!---//////////////////////////////////////--- FIN MODAL INFO ---///////////////////////////////////////////////////////----->
<!---//////////////////////////////////////--- MODAL BORRAR ---///////////////////////////////////////////////////////----->
<div class="modal fade" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel"> Eliminar Solicitud</h5>
            </div>
            <input type="text" id="soco_id" style="display:none">
            <div class="modal-body">
            <center>
					<h4>
						<p>¿Desea eliminar la solicitud de pedido?</p>
					</h4>
			</center>
            <!--__________________ FIN FORMULARIO MODAL ___________________________-->
            </div>
            <div class="modal-footer">
                <center>
                    <button type="submit" class="btn btn-primary" id="btndelete" onclick="">SI</button>
                    <button type="submit" class="btn btn-default" id="btncancelar" data-dismiss="modal" id="cerrar">NO</button>
                </center>
            </div>
        </div>
    </div>
</div>
<!---//////////////////////////////////////--- FIN MODAL BORRAR ---///////////////////////////////////////////////////////----->
<script>
$(".btnInfo").click(function(e){
    var data = JSON.parse($(this).parents("tr").attr("data-json")); 
    console.table(data);
    $("#info_observaciones").val(data.observaciones);
    $("#info_trnasportista").val(data.transportista);
    $("#info_tipo_residuo").val(data.tipo_residuo);
    $("#info_fecha").val(data.fec_alta);
    $("#info_cantidad").val(data.cantidad);
});

$(".btnEliminar").click(function(e){
    var data = JSON.parse($(this).parents("tr").attr("data-json")); 
    $('#btndelete').show();    
    // $("#id_generador").val(data.sotr_id);
});
DataTable($('#tabla_solicitudes_pedido'));
</script>