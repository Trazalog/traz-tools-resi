<!-- HEADER  -->
<div class="box box-primary animated fadeInLeft">
		<div class="box-header with-border">
			<h4>Registrar Chofer</h4>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-2 col-lg-1 col-xs-12">
					<button type="button" id="botonAgregar" class="btn btn-primary" aria-label="Left Align">
						Agregar
					</button><br>
				</div>
				<div class="col-md-10 col-lg-11 col-xs-12"></div>
			</div>
		</div>
	</div>
		<!-- FIN HEADER -->

		<!--- BOX 1 --->
	<div class="box box-primary animated bounceInDown" id="boxDatos" hidden>
			<div class="box-header with-border">
				<div class="box-tittle">
					<h5>Informacion</h5>
				</div>
					<div class="box-tools pull-right">
					<button type="button" id="btnclose" title="cerrar" class="btn btn-box-tool" data-widget="remove"
						data-toggle="tooltip" title="" data-original-title="Remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
		<div class="box-body">
			<?php $this->load->view('choferes/form') ?>
			<!--Adjuntar imagen--> 
			<div class="col-md-12 pull-left">
						<form action="cargar_archivo" method="post" enctype="multipart/form-data">
								<input type="file" id="img_File" onchange=convertA() style="font-size: smaller">
								<input type="text" name="imagen" id="input_aux_img" style="display:none" >
						</form>
						<img src="" alt="" id="img_Base" width="" height="" style="margin-top: 20px;border-radius: 8px;">
					</div>
				<!--_____________________________________________-->								
			<!--Boton de guardado-->
			<div class="col-md-12">
				<hr>
			</div><br>
			<button type="submit" class="btn btn-primary pull-right" onclick="Guardar_Chofer()">Guardar</button>
			<!--_____________________________________________________________-->

		</div>
	</div>
	<!-- </div> -->
<!--- FIN BOX --->

<!--- TABLA --->
<div class="box box-primary">
  <div class="box-body">
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <div class="row">
        <div class="col-sm-12 table-scroll" id="cargar_tabla">
        </div>
			</div>
		</div>
	</div>
</div>			
<!--- FIN TABLA --->
<!---///////--- MODAL EDITAR ---///////--->
	<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-blue">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title titulo" id="exampleModalLabel">Editar Chofer</h5>
			</div>
			<div class="modal-body col-md-12 col-sm-12 col-xs-12">
				<!--__________________ FORMULARIO MODAL __________________-->
				<form method="POST" autocomplete="off" id="frm_chofer_edit" class="registerForm">
					<!-- Id de chofer -->
					<div class="form-group">
						<input type="text" class="form-control habilitar" id="chof_id_edit" name="chof_id" style="display:none;">							
					</div>
					<!--______________________________-->
					<div class="col-md-6 col-sm-6 col-xs-12">
						<!--Nombre-->
						<div class="form-group">
							<label for="Nombre">Nombre:</label>
							<input type="text" class="form-control habilitar" id="nombre_edit" name="nombre">
						</div>
						<!--_____________________________________________________________-->

						<!--Apellido-->
						<div class="form-group">
							<label for="Apellido">Apellido:</label>
							<input type="text" class="form-control habilitar" id="apellido_edit" name="apellido">
						</div>
						<!--_____________________________________________________________-->

						<!--DNI-->
						<div class="form-group">
							<label for="DNI">DNI:</label>
							<input type="number" class="form-control habilitar" id="dni_edit" name="documento">
						</div>
						<!--_____________________________________________________________-->
						<!--Fecha de nacimiento-->
						<div class="form-group">
							<label for="FechaNacimiento">Fecha de nacimiento:</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control habilitar" id="fec_nacimiento_edit" name="fec_nacimiento">
							</div>
						</div>
						<!--_____________________________________________________________-->
						<!--Direccion-->
						<div class="form-group">
							<label for="Direccion">Direccion:</label>
							<input type="text" class="form-control habilitar" id="direccion_edit" name="direccion">
						</div>
						<!--_____________________________________________________________-->

						<!--Celular-->
						<div class="form-group">
							<label for="Celular">Celular:</label>
							<input type="number" class="form-control habilitar" id="celular_edit" name="celular">
						</div>
						<!--_____________________________________________________________-->
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<!--Codigo-->
						<div class="form-group">
							<label for="Codigo">Codigo:</label>
							<input type="text" class="form-control habilitar" id="codigo_edit" name="codigo">
						</div>
						<!--_____________________________________________________________-->
						<!--Empresa-->
						<div class="form-group">
							<label for="Empresa">Empresa:</label>
							<select class="form-control select2 selec_habilitar select2-hidden-accesible " id="tran_id_edit" name="tran_id">
								<option value="" disabled selected>-Seleccione opcion-</option>
								<?php
                                    foreach ($empresa as $emp) {												
                                        echo '<option value="'.$emp->tran_id.'">'.$emp->razon_social.'</option>';
                                    }
								?>
							</select>
						</div>
						<!--_____________________________________________________________-->
						<!--Carnet-->
						<div class="form-group">
							<label for="Carnet">Carnet:</label>
							<select class="form-control select2 selec_habilitar select2-hidden-accesible" id="carnet_edit" name="carnet">
								<option value="" disabled selected>-Seleccione opcion-</option>
								<?php
                                    foreach ($carnet as $carn) {											
                                        echo '<option value="'.$carn->tabl_id.'">'.$carn->valor.'</option>';
                                    }
								?>
							</select>
						</div>
						<!--_____________________________________________________________-->

						<!--Categoria-->
						<div class="form-group">
							<label for="Categoria">Categoria:</label>
							<select class="form-control select2 selec_habilitar select2-hidden-accesible" id="cach_id_edit" name="cach_id">
								<option value="" disabled selected>-Seleccione opcion-</option>
								<?php
                                    foreach ($categoria as $c) {
                                        echo '<option value="'.$c->tabl_id.'">'.$c->valor.'</option>';
                                    }
								?>
							</select>
						</div>
						<!--_____________________________________________________________-->

						<!--Vencimiento-->
						<div class="form-group">
							<label for="Vencimiento">Vencimiento:</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="date" class="form-control pull-right habilitar" id="vencimiento_edit" name="vencimiento">
							</div>
							<!-- /.input group -->
						</div>
						<!--_____________________________________________________________-->

						<!--Habilitacion-->
						<div class="form-group">
							<label for="Habilitacion">Habilitacion:</label>
							<input type="text" class="form-control habilitar" id="habilitacion_edit" name="habilitacion">
						</div>
						<!--_____________________________________________________________-->
					</div>

				</form>
				<!--_____________________________________________-->	
				<div class="col-md-12">
					<form action="cargar_archivo" method="post" enctype="multipart/form-data">	
						<label for="img_file" class="col-sm-4 control-label" name="img">Imagen:</label>
						<div class="col-sm-8">
							<input type="file" class="ocultar habilitar" name="img" id="img_file" onchange=convert_Edit()>
							<input type="text" id="input_aux_img64" style="display:none">
							<input type="text" id="input_aux_zonaID" style="display:none">                 
							<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>  
                            <br>                       
							<img src="" alt="imagen" id="img_base" width="" height="" style="margin-top: 20px;border-radius: 8px;">
						</div>
					</form>	
				</div>					
				<!--__________________ FIN FORMULARIO MODAL ___________________________-->
			</div>
			<div class="modal-footer">
				<div class="form-group text-right">
					<button type="submit" class="btn btn-primary" data-dismiss="modal" id="btnsave">Guardar</button>
					<button type="submit" class="btn btn-default" id="" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!---///////--- FIN MODAL EDITAR ---///////--->
<!---///////--- MODAL AVISO ---///////--->
<div class="modal fade" id="modalaviso">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-blue">
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h5 class="modal-title" id="exampleModalLabel"> Eliminar Chofer</h5>

				
               						
			</div>
			<input id="chof_delete" style="display: none;">
			<div class="modal-body">
				<center>
					<h4>
						<p>¿DESEA ELIMINAR EL CHOFER?</p>
					</h4>
				</center>
			</div>
			<div class="modal-footer">
				<center>
					<button type="button" class="btn btn-primary" onclick="eliminar()">SI</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
				</center>
			</div>
		</div>
	</div>
</div>
<!---///////--- FIN MODAL AVISO ---///////--->

<script>
$(document).ready(function(){		
    var aux= "";	
    $("#img_base").val(aux);
    $(".fa-spinner").hide();
    
});
	//////// Tratamiento de Imagen en Registrar nuevo circuito
async function convertA(){      
    var file = document.getElementById('img_File').files[0];
    console.table('imagen en convertA: ' + document.getElementById('img_File').files[0]);

    if (file) {
        var archivo = await GetFile(file);
        console.table(archivo);
        if(archivo.fileType == "image/jpeg"){
            var cod = "data:image/jpeg;base64,"+archivo.base64StringFile;
            //var cod = "data:image/png;base64,"+archivo.base64StringFile;
            $("#input_aux_img").val(cod);
            $("#img_Base").attr("src",$("#input_aux_img").val());
            $("#img_Base").attr("width",100);
            $("#img_Base").attr("height",100);
        }else{
            if(archivo.fileType == "application/pdf"){
                var cod = "data:application/pdf;base64,"+archivo.base64StringFile;
            }				
        }               
        $("#input_aux_img").val(cod);
        console.table($("#input_aux_img").val());  
    }        
}

//Convertir a base64 el archivo Imagen
function GetFile(file){
    var reader = new FileReader();
    return new Promise((resolve, reject) => {
        reader.onerror = () => {
            reader.abort();
            reject(new Error("Error parsing file"));
        }
        reader.onload = function() {
            //This will result in an array that will be recognized by C#.NET WebApi as a byte[]
            let bytes = Array.from(new Uint8Array(this.result));
            //if you want the base64encoded file you would use the below line:
            let base64StringFile = btoa(bytes.map((item) => String.fromCharCode(item)).join(""));
            //Resolve the promise with your custom file structure
            resolve({
                bytes: bytes,
                base64StringFile: base64StringFile,
                fileName: file.name,
                fileType: file.type
            });
        }
        reader.readAsArrayBuffer(file);
    });
}
//////// Fin Tratamiento de Imagen en Registrar nuevo circuito

//script que muestra box de datos al dar click en boton agregar
$("#botonAgregar").on("click", function() {		
    $("#botonAgregar").attr("disabled", "");
    //$("#boxDatos").removeAttr("hidden");
    $("#boxDatos").focus();
    $("#boxDatos").show();
});
$("#btnclose").on("click", function() {
    $("#boxDatos").hide(500);
    $("#botonAgregar").removeAttr("disabled");
    $('#formChofer').data('bootstrapValidator').resetForm();
    $("#formChofer")[0].reset();
});

//carga listado general	
$("#cargar_tabla").load("<?php echo RESI; ?>general/Chofer/Listar_Chofer");

//guardar chofer	
function Guardar_Chofer() {
    var datos = new FormData($('#formChofer')[0]);
    datos = formToObject(datos);		
    var aux = "";
    aux = $("#input_aux_img").val();
    if(aux != ""){
        datos.imagen = aux;
        console.log('Validacion FRM Chores');
        console.log($("#formChofer").data('bootstrapValidator').isValid());
        if ($("#formChofer").data('bootstrapValidator').isValid()){
            wo();
            $.ajax({
                type: "POST",
                data: { datos },
                url: "<?php echo RESI; ?>general/Chofer/Guardar_Chofer",
                success: function(r) {
                    console.table(r);
                    if (r == "ok") {
                        wc();
                        $("#cargar_tabla").load(
                            "<?php echo RESI; ?>general/Chofer/Listar_Chofer");
                        alertify.success("Chofer Agregado con exito");

                        $('#formChofer').data('bootstrapValidator').resetForm();
                        $("#formChofer")[0].reset();

                        $("#boxDatos").hide(500);
                        $("#botonAgregar").removeAttr("disabled");
                    } else {
                        //console.log(r);
                        wc();
                        alertify.error("Error al Agregar Chofer");
                        
                    }
                }
            });
        }else{
            alert("ATENCION!!! hay campos vacios o mal Ingresados");
        }
    }else{
        alert("ATENCION!!! no cargo imagen");
    }
}

// Script validacion
$('#formChofer').bootstrapValidator({
    message: 'This value is not valid',
}).on('success.form.bv', function(e) {
    e.preventDefault();
    //guardar();
});

// Datatable tabla_choferes
DataTable($('#tabla_choferes'))
//boton guardar edicion
$("#btnsave").on("click", function() {
			//tomo datos del form y hago objeto
			var chofer = new FormData($('#frm_chofer_edit')[0]);
			chofer = formToObject(chofer);
			chofer.imagen = $("#input_aux_img64").val(); 
			var aux = 0;
			if($("#nombre_edit").val() != ""){
				if($("#apellido_edit").val() != ""){
					if($("#dni_edit").val() != ""){
						if($("#fec_nacimiento_edit").val() != ""){
							if($("#direccion_edit").val() != ""){
								if($("#celular_edit").val() != ""){
									if($("#codigo_edit").val() != ""){
										if($("#tran_id_edit").val() != ""){
											if($("#carnet_edit").val() != ""){
												if($("#cach_id_edit").val() != ""){
													if($("#vencimiento_edit").val() != ""){
														if($("#habilitacion_edit").val() != ""){
															aux = 1;
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
			if(aux != 0){
				wo();
				// if ($("#frm_chofer_edit").data('bootstrapValidator').isValid()) {
					$.ajax({
						type: "POST",
						data: {	chofer },
						url: "<?php echo RESI; ?>general/Chofer/Modificar_Chofer",
						success: function(result) {
							if (result == "error") {
								wc();
								alertify.error("Error al Actualizar Chofer");
							} else {
								wc();
								$("#cargar_tabla").load(
									"<?php echo base_url(); ?>index.php/general/Estructura/Chofer/Listar_Chofer");
								$("#modalEdit").modal('hide');
								alertify.success("Chofer Actualizado con exito");
							}
						}
					});
			}else{
				alert("ATENCION!!! Hay campos vacios o mal ingresados");
			}
		//	}
		});
</script>