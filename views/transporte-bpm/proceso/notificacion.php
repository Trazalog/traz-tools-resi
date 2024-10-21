<h4>Notificación de rechazo de pedido</h4>

<!--_________________SEPARADOR_________________-->
<!-- <div class="col-md-12 col-sm-12 col-xs-12"><br></div> -->
<!--_________________SEPARADOR_________________-->

<!--_____________ motivo de rechazo _____________-->
<div class="col-md-12 col-sm-12 col-xs-12">
	<!--_____________ Descripcion _____________-->
		<div class="form-group">
			<!-- <label for="motivo" class="col-sm-4 control-label">Motivo rechazo:</label> -->
			<label for="motivo" class="disabledTextInput">Motivo rechazo:</label>
			<textarea class="form-control" id="motivo" rows="3" disabled>
        <?php echo $motivo_rechazo ?>
      </textarea>
		</div>
	<!--__________________________-->
</div>

<!--_________________SEPARADOR_________________-->
<div class="col-md-12 col-sm-12 col-xs-12"><hr></div>
<!--_________________SEPARADOR_________________-->

<script>
	function recargaBandejaEntrada(){
		linkTo('<?php echo BPM ?>Proceso');
	}
	// Datatable
	DataTable($('#tbl_contenedores'));
	//Lo dejo definido, pero el proceso de BONITA no tiene contrato de cierre
	function cerrarTarea() {
        var dataForm = new FormData();
        var id = $('#taskId').val();

        $.ajax({
            type: 'POST',
            data: dataForm,
            cache: false,
            contentType: false,
            processData: false,
            url: '<?php base_url() ?>index.php/<?php echo BPM ?>Proceso/cerrarTarea/' + id,
            success: function(data) {
                wc();
				if(result.status){
                	confRefresh(recargaBandejaEntrada,'',"Se finalizó la tarea correctamente!");
				}else{
					error("Error",'Se produjo un error al enviar respuesta.');
					recargaBandejaEntrada();
				}
            },
            error: function(data) {
                wc();
                alert("Error al finalizar tarea");
            }
        });
	}
</script>