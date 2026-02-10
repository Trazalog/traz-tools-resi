<style>
.frm-save {
    display: none;
}

.edit-padding {
    padding-left: 0 !important;
    padding-right: 10px;
}

</style>


<!-- /// ----------------------------------- HEADER ----------------------------------- /// -->

<div class="box box-primary animated fadeInLeft">
    <div class="box-header with-border">
        <h4>Registrar Vehículo</h4>
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

<!-- /// ----------------------------------- HEADER ----------------------------------- /// -->

<!---//////////////////////////////////////--- BOX 1 ---//////////////////////////////////////----->

<div class="box box-primary animated bounceInDown" id="boxDatos" hidden>
    <div class="box-header with-border">
        <div class="box-tittle">
        <h5>Información</h5>  
        </div>
        <div class="box-tools pull-right">
            <button type="button" id="btnclose" title="cerrar" class="btn btn-box-tool" data-widget="remove"
                data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>

       <!--_____________________________________________________________-->

        <div class="box-body">
            <input type="hidden" value="<?php echo $tran_id ?>" id="transportistaLogeado">
            <input type="hidden" value="<?php echo $empr_id ?>" id="empr_id">

            <form class="formVehiculo" id="formVehiculo"  method="POST" autocomplete="off" class="registerForm">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <!--Condicion-->
                        <div class="form-group">
                            <label for="transportista" >Transportista <strong class="text-danger"> *</strong>:</label>
                            <select class="form-control select2 select2-hidden-accesible" id="tran_id" name="tran_id" disabled required>
                                <option value="" disabled selected>-Seleccione opción-</option>
                                <?php
                                    foreach ($transportista as $i) {
                                        echo '<option value="'.$i->tran_id.'">'.$i->razon_social.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                   <!--_____________________________________________________________-->

                    <!--Dominio-->
                        <div class="form-group dominio">
                            <label for="Dominio">Dominio <strong class="text-danger"> *</strong>:</label>
                            <input type="text" class="form-control" id="dominio" name="dominio" required>
                        </div>
                   <!--_____________________________________________________________-->

                    <!--Marca-->
                        <div class="form-group">
                            <label for="Marca" >Marca <strong class="text-danger"> *</strong>:</label>
                            <input type="text" class="form-control" id="marca" name="marca" required>
                        </div>
                   <!--_____________________________________________________________-->

                    <!--Descripcion-->
                        <div class="form-group">
                            <label for="Descripcion" >Descripción <strong class="text-danger"> *</strong>:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                   <!--_____________________________________________________________-->
                   <!--Adjuntar imagen--> 
                   <div class="form-group">
                        <!-- <form action="cargar_archivo" method="post" enctype="multipart/form-data"  id="fileimage"> -->
                            <label for="img_File">Seleccione Imagen</label>
                            <input type="file" name="imagen" id="img_File" onchange="convertA()" style="font-size: smaller">
                            <input type="text" id="input_aux_img" style="display:none" >
                        <!-- </form> -->
                        <br>
                        <img src="" alt="" id="imagen" width="" height="">
                    </div>
                    <!--_____________________________________________________________-->
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <!--Registro-->
                    <div class="form-group codigo">
                        <label for="codigo" >N° de Registro <strong class="text-danger"> *</strong>:</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" required>
                    </div>
                   <!--_____________________________________________________________--> 

                    <!--Fecha de habilitacion-->
                    <div class="form-group" >
                        <label for="fecha_ingreso" >Fecha de Ingreso <strong class="text-danger"> *</strong>:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control pull-right" id="fecha_ingreso" name="fecha_ingreso" required>
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label for="optolva" >Es Movilidad Contenedor? <strong class="text-danger"> *</strong>:</label>
                        <select class="form-control select2 select2-hidden-accesible opcionTolva" id="optolva" name="optionsTolva" required>
                            <option value="" disabled selected>-Seleccione opción-</option>
                            <option value="si">SI</option>
                            <option value="no">NO</option>
                        </select>
                    </div>

                    <div class="form-group Capacidad" style="display:none;">
                        <label for="capacidad" >Capacidad(m<sup>3</sup>) <strong class="text-danger"> *</strong>:</label>
                        <input type="number" class="form-control" id="capacidad" name="capacidad" required>
                    </div>

                    <!--Tipo carga-->
                     <div class="form-group RSU" style="display:none;">
                        <label for="rsu">Tipo de residuo <strong class="text-danger"> *</strong>:</label>
                        <div class="input-group date" id="carg">
                            <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                                <select class="form-control select3" multiple="multiple"  data-placeholder="Seleccione tipo residuo"  style="width: 100%;"  id="rsu" name="rsu" required>
                                    <?php
                                        foreach ($Rsu as $i) {
                                            echo '<option  value="'.$i->tabl_id.'">'.$i->valor.'</option>';
                                        }
                                    ?>
                                </select>
                        </div>
                    </div>               
                    <!--_____________________________________________________________-->
                    <!--Tara-->
                    <div class="form-group">
                        <label for="Tara" >Tara(Kg) <strong class="text-danger"> *</strong>:</label>
                        <div class="input-group date">
                            <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                                <input type="number" class="form-control" name="tara" id="tara" required>
                        </div>
                    </div>
                   <!--_____________________________________________________________-->
                </div>

            </form>
             <!--__________________FORM DINAMICO__________________-->
                    <div class="col-md-12 col-sm-12 col-xs-12">
                                <?php
                                    echo (!empty($form_id)) ? '<div class="frm-new" data-form="'.$form_id.'"></div>' : '<div class="frm-new" data-form="0"></div>';
                                ?>
                                <!-- Campo oculto para almacenar form_id -->
                                <input type="hidden" id="FormId" value="<?php echo $form_id; ?>">
                    </div>
                    <!--_____________________________________________________________--> 


                    <!--__________________SEPARADOR__________________-->            

                <div class="col-md-12"><hr></div>

                    <!--__________________SEPARADOR__________________-->

                    <!--Boton de guardado--> 
                        <button type="submit" class="btn btn-primary pull-right" onclick="GuardarVhiculo()">Guardar</button>
                    <!--_____________________________________________________________--> 
        </div>
    </div>
</div>

<!---//////////////////////////////////////--- FIN BOX---//////////////////////////////////////----->

<!---//////////////////////////////////////--- TABLA ---//////////////////////////////////////----->

<div class="box box-primary">
    <div class="box-body">
        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6"></div>
            </div>
            <div class="row"><div class="col-sm-12 table-scroll" id="cargar_tabla">
            </div>
        </div>



    <!---//////////////////////////////////////--- MODAL EDITAR ---//////////////////////////////////////----->

    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-blue">
                    <button type="button" class="close cerrar_modal_e" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title titulo" id="exampleModalLabel">Editar Vehiculo</h5>
                </div>

                <!-- MODAL BODY -->
                <div class="modal-body">
                    <!-- FORMULARIO MODAL -->
                    <form class="formVehiculoEdit" id="formVehiculoEdit" method="POST" autocomplete="off" class="registerForm">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <!--TRansportista-->
                                <div class="form-group ocultaTransedit">
                                    <label for="tran_id">Transportista:</label>
                                    <select class="form-control select2 select2-hidden-accesible redimensionar" id="e_tran_id" name="e_tran_id">
                                        <option value="" disabled selected>-seleccione opcion-</option>
                                        <?php 
                                            foreach ($transportista as $j) { 
                                                echo '<option value="'.$j->tran_id.'">'.$j->razon_social.'</option>'; 
                                            } 
                                        ?> 
                                    </select>
                                </div> 
                                
                                <div class="form-group textTransinfo" style="display:none"> 
                                    <label for="tran_id_info">Transportista:</label> 
                                    <br> 
                                    <input type="text" class="form-control redimensionar" id="tran_id_info"> 
                                </div>
                                
                                <!--Descripcion-->
                                <div class="form-group">
                                    <label for="descripcion">Descripcion:</label>
                                    <br>
                                    <input type="text" class="form-control habilitar redimensionar" id="e_descripcion" name="e_descripcion">
                                    <span class="glyphicon glyphicon-eye-open esconder" aria-hidden="true" style="left: -2rem; top: -2rem;" title="Ampliar Descripcion" onclick="ampliarDesc()"></span> 
                                </div>

                                <div class="form-group" style="display:none">
                                    <input type="text" class="form-control habilitar redimensionar" id="e_equi_id" name="e_equi_id">
                                </div>
                                
                                <!--Dominio-->
                                <div class="form-group redimensionarDominio">
                                    <label for="dominio">Dominio:</label>
                                    <br>
                                    <input type="text" class="form-control habilitar redimensionar" id="e_dominio" name="e_dominio">
                                </div>          
                                
                                <!--Tara-->
                                <div class="form-group">
                                    <label for="Tara">Tara:</label>
                                    <br>
                                    <input type="number" class="form-control habilitar redimensionar" name="taraedit" id="taraedit">
                                </div>
                                
                                  
                            </div>
                            
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <!--Registro-->
                                <div class="form-group redimensionarCodigo">
                                    <label for="codigo">Nº de Registro:</label>
                                    <br>
                                    <input type="text" class="form-control habilitar redimensionar" id="e_codigo" name="e_codigo">
                                </div>
                                
                                
                                <!--Fecha de habilitacion-->
                                <div class="form-group">
                                    <label for="FechaIngreso">Fecha de Ingreso:</label>
                                    <div class="input-group date">
                                        <input type="date" class="form-control habilitar redimensionar" name="id_fecha_ingreso" id="id_fecha_ingreso">
                                    </div>
                                </div>

                                 <!--Marca-->
                                <div class="form-group">
                                    <label for="marca">Marca:</label>
                                    <br>
                                    <input type="text" class="form-control habilitar redimensionar" id="e_marca" name="e_marca">
                                </div>    
                            </div>
                            
                            <!--Imagen (ocupa toda la fila)-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="CircR" name="img">Imagen:</label>
                                    <input type="file" class="ocultar" name="img" id="img_file" onchange="convert()" style="font-size: smaller;">
                                    <input type="text" id="input_aux_img64" style="display:none">
                                    <input type="text" id="input_aux_zonaID" style="display:none"> 
                                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>  
                                    <br>                                
                                    <img src="" alt="no hay imagen! cargue una" id="img_base" width="" height="">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12"><hr></div>
                        
                       
                    </form>
                     <!-- FORMULARIO DINÁMICO -->
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <?php
                                echo (!empty($form_id)) ? '<div class="frm-new frm-edit" data-form="'.$form_id.'"></div>' : '<div class="frm-new" data-form="0"></div>';
                            ?>
                            <input type="hidden" id="FormIdEdit" value="<?php echo $form_id; ?>">
                        </div>
                </div>
                <!-- FIN MODAL BODY -->

                <!-- MODAL FOOTER -->
                <div class="modal-footer">
                    <div class="col-md-12"><hr></div>
                    <div class="form-group text-right" style="width: 100%;">
                        <button type="button" class="btn btn-primary" id="btnsave_e">Guardar</button>
                        <button type="button" class="btn btn-default cerrar_modal_edit" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!---//////////////////////////////////////--- FIN MODAL EDITAR ---//////////////////////////////////////----->
<!---//////////////////////////////////////--- MODAL BORRAR ---///////////////////////////////////////////////////////----->
    
<div class="modal fade" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header bg-blue">
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                <h5 class="modal-title" id="exampleModalLabel"> Eliminar Vehiculo</h5>
			</div>
			<input id="id_vehiculo" style="display: none;">
			<div class="modal-body">
				<center>
					<h4>
						<p>¿DESEA ELIMINAR EL VEHICULO?</p>
					</h4>
				</center>
			</div>
            <div class="modal-footer">
                <center>
                    <button type="submit" class="btn btn-primary" id="btndelete" onclick="deletevehiculo()">SI</button>
                    <button type="submit" class="btn btn-default" id="btncancelar" data-dismiss="modal" id="cerrar">NO</button>
                </center>
            </div>
        </div>
    </div>
</div>


<!---//////////////////////////////////////--- FIN MODAL BORRAR ---///////////////////////////////////////////////////////----->

<!---//////////////////////////////////////--- MODAL AMPLIAR DESCRIPCION ---///////////////////////////////////////////////////////-----> 
<div class="modal fade" id="modalVerDescAmpliada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog" role="document"> 
        <div class="modal-content"> 
            <div class="modal-header bg-blue"> 
                <button type="button" class=" close btn-cerrar-modal" data-dismiss="modal" aria-label="Close" onclick="cerrar_Ampliar()"> 
                    <span aria-hidden="true">&times;</span> 
                </button> 
                <h5 class="modal-title" id="exampleModalLabel">Descripcion de Vehiculo</h5> 
            </div> 
            <div class="modal-body"> 
 
               <textarea name="" id="descrip" cols="30" rows="10" readonly></textarea>  
 
            </div> 
        </div> 
    </div> 
</div> 
 
<!---//////////////////////////////////////--- FIN MODAL DESCRIPCION ---///////////////////////////////////////////////////////-----> 
 

<!---//////////////////////////////////////--- SCRIPTS---//////////////////////////////////////----->

<!--_____________________________________________________________-->

<!-- script que muestra box de datos al dar click en boton agregar -->
<script>

detectarForm();
initForm();

// deshabilita img y spinner	
$(document).ready(function(){		
                var aux= "";	
				$("#img_base").val(aux);
				$(".fa-spinner").hide();
                $(".redimensionar").attr("style","width: 24rem;");
               
		});

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

async function convertA(){
       
       
       var file = document.getElementById('img_File').files[0];
       console.table(document.getElementById('img_File').files[0]);
           if (file) {
               var archivo = await GetFile(file);
               console.table(archivo);
               if(archivo.fileType == "image/jpeg"){
                  var cod = "data:image/jpeg;base64,"+archivo.base64StringFile;
                  //var cod = "data:image/png;base64,"+archivo.base64StringFile;
                    $("#input_aux_img").val(cod);
                    $("#imagen").attr("src",$("#input_aux_img").val());
                    $("#imagen").attr("width",100);
                    $("#imagen").attr("height",100);
               }else{
                   if(archivo.fileType == "application/pdf"){
                      var cod = "data:application/pdf;base64,"+archivo.base64StringFile;
                   }
                 
               }
               
                $("#input_aux_img").val(cod);
                console.table($("#input_aux_img").val());
                
               
           }
          
           
           
   }

</script>
<script>


    $("#botonAgregar").on("click", function() {
        //crea un valor aleatorio entre 1 y 100 y se asigna al input nro
        var aux = "";
        $("#img_File").val(aux);
		$("#imagen").attr("src",aux);
        var aleatorio = Math.round(Math.random() * (100 - 1) + 1);
        $("#nro").val(aleatorio);
        $("#botonAgregar").attr("disabled", "");
        
        /* Si la empresa esta como admin o authorizada puede seleccionar otros transportistas, si no lo es se selecciona el transportista por defecto asociado al usuario logeado*/
        var empr_id = <?php echo $empr_id; ?>;
        var empresas = JSON.parse('<?php echo EMPRESAS_RESI_ADMIN; ?>');
        const empresaHabilitada = empresas.includes(empr_id);

        if(empr_id){
            if(empresaHabilitada){
                $('#tran_id').prop('disabled', false);
            }
            else{
                var tran_id = $("#transportistaLogeado").val();
                $("#tran_id").val(tran_id);//Solo se puede cargar choferes para el transportista logeado
            }
        }
        setTimeout(function() {
            $("#formVehiculo").data('bootstrapValidator').updateStatus('tran_id', 'NOT_VALIDATED').validateField('tran_id');
        }, 100);
        $("#boxDatos").focus();
        $("#boxDatos").show();
    });

    $("#btnclose").on("click", function() {
        $("#formVehiculo")[0].reset();
        $("#boxDatos").hide(500);
        $("#botonAgregar").removeAttr("disabled");
        $('#formDatos').data('bootstrapValidator').resetForm();
        $("#formDatos")[0].reset();
        $('#selecmov').find('option').remove();
        $('#chofer').find('option').remove();
    });

    $(".cerrar_modal_edit").click(function(e){
    $("#formVehiculoEdit").data('bootstrapValidator').resetForm();
   
    });

    $(".cerrar_modal_e").click(function(e){
    $("#formVehiculoEdit").data('bootstrapValidator').resetForm();
   
});
//Modal Editar
    $(".btnEditar").click(function(e){
    $("#modalEdit").modal("show"); 
    var data = JSON.parse($(this).parents("tr").attr("data-json")); 
    console.table(data);
    var fecha = data.fecha_ingreso;
    var fechaaux="";
    for(var i=0; i<fecha.length-6;i++)
    {
        fechaaux= fechaaux + fecha[i];
    }
    $(".frm-edit").removeAttr("style");
    $(".redimensionarDominio").removeAttr("style");
    $(".redimensionarCodigo").removeAttr("style");
    $(".titulo").text('Editar Vehiculo');
    $('#btnsave_e').show(); 
    $(".habilitar").removeAttr("readonly");
    $(".textTransinfo").attr("style","display:none"); 
    $(".ocultaTransedit").removeAttr("style"); 
    $("#div_ver").attr("style","display:none");
    $("#tran_ver").attr("style","display:none");
    $(".ocultar").removeAttr("style");
    $("#e_descripcion").val( data.descripcion);
    $("#e_marca").val(data.marca); 
    $("#e_dominio").val(data.dominio);
    $("#e_codigo").val(data.codigo);
    $(".esconder").attr("style","display:none"); 
    $("#e_ubicacion").val(data.ubicacion);
    $("#e_fechaingreso").val(fechaaux);
    $("#id_fecha_ingreso").val(fechaaux);
    console.table($("#id_fecha_ingreso").val());
    $("#e_equi_id").val(data.equi_id);
    var tranid = data.tran_id; 
    $("#e_tran_id").val(tranid); 
    $("#taraedit").val(data.tara); 
    ExtraerImagen(data);
    });

//Modal Info
    $(".btnInfo").click(function(e){
    $("#modalEdit").modal("show"); 
    var data = JSON.parse($(this).parents("tr").attr("data-json")); 
    console.table(data);
    var fecha = data.fecha_ingreso;
    var fechaaux="";
    for(var i=0; i<fecha.length-6;i++)
    {
        fechaaux= fechaaux + fecha[i];
    }
    $(".frm-edit").removeAttr("style");
    $(".redimensionarDominio").attr("style","margin-top: 1rem;");
    $(".redimensionarCodigo").attr("style","margin-top: 1rem;");
    $(".titulo").text('Informacion Vehiculo');
    $('#btnsave_e').hide();
    $(".habilitar").attr("readonly","readonly"); 
    $("#div_ver").removeAttr("style");
    $("#tran_ver").removeAttr("style");
    $("#tran_ver").attr("readonly","readonly");
    $(".ocultar").attr("style","display:none");
    $("#e_descripcion").val( data.descripcion);
    $("#e_marca").val(data.marca); 
    $("#e_dominio").val(data.dominio);
    $("#e_codigo").val(data.codigo);
    $("#e_ubicacion").val(data.ubicacion);
    $("#e_fechaingreso").val(fechaaux);
    $("#id_fecha_ingreso").val(fechaaux);
    $(".esconder").attr("style","left: -25rem; top: -2rem; "); 
    $("#tran_id_info").attr("readonly","readonly");  
    console.table($("#id_fecha_ingreso").val());
    var tranid = data.tran_id; 
    $("#e_tran_id").val(tranid); 
    $(".ocultaTransedit").attr("style","display:none"); 
    $(".textTransinfo").removeAttr("style"); 
    //para asiganrle nombre del transportista al input tipo text 
    $("#e_equi_id").val(data.equi_id); 
    var tranid = data.tran_id; 
    $("#e_tran_id").val(tranid); 
    $sel = $("#e_tran_id"); 
    for(var j=0; j<= $sel[0].length-1; j++){ 
 
        if(data.tran_id == $sel[0][j].value) 
        { 
            $("#tran_id_info").val($sel[0][j].text); 
        } 
    } 
    $("#taraedit").val(data.tara); 
    ExtraerImagen(data);
    });

//Modal Eliminar
    $(".btnEliminar").click(function(e){
    var data = JSON.parse($(this).parents("tr").attr("data-json")); 
    $('#btndelete').show();    
    $("#id_vehiculo").val(data.equi_id);
});



</script>
​<!--_____________________________________________________________-->


<!--Script de guardado pantalla Registrar Vehiculo-->
<script>
    $("#cargar_tabla").load("<?php echo RESI; ?>general/Vehiculo/Listar_Vehiculo");

    async function GuardarVhiculo() {

        var datos = new FormData($('#formVehiculo')[0]);
        datos = formToObject(datos);
        datos.imagen = $("#input_aux_img").val();
        datos.tara = $("#tara").val();
        datos.tran_id = $("#tran_id").val();
        datos.ubicacion = "Sin Ubicacion"; //HARCODE - falta asignar funcion que asigne ubicacion
        //datos.imagen = $("#input_aux_img").val();
        //datos.usuario_app = "nachete"; //HARCODE - falta asignar funcion que asigne tipo usuario
        
        const dominio = $('#dominio').val();
        const existe = await validaDominio(dominio);        

        if (existe) {
                alertify.error("El Dominio ya se encuentra registrado");
                wc();
                return;
        }


         if (!validarFormularioVahiculo()) {
            return; // Detiene el guardado si hay errores
        }
        console.table(datos);
  
        //--------------------------------------------------------------
        if(datos.imagen != "")
        {
            if ($("#formVehiculo").data('bootstrapValidator').isValid()) {
                if($(".opcionTolva").val() != "")
                {
                    if($(".opcionTolva").val()=="si")
                    {
                        datos.optionsTolva = "si";
                        if($("#capacidad").val()!="")
                        {
                            datos.capacidad = $("#capacidad").val();
                            if($("#rsu").val()!=""){
                                var tipocarga= $('#rsu').val(); 
                                //llama funcion controller
                                wo();
                                $.ajax({
                                    type: "POST",
                                    data: {datos, tipocarga},
                                    url: "<?php echo RESI; ?>general/Vehiculo/Guardar_Vehiculo",
                                    success:async function (r) {
                                        const resp = JSON.parse(r);
                                        console.log(r);
                                        if (resp.status == "ok") {
                                          idFormDinamico = "#"+$('.frm-new').find('form').attr('id');

                                                if(idFormDinamico != "#undefined"){
                                                    var newInfoID = await frmGuardarConPromesa($(idFormDinamico));
                                                }

                                                if(newInfoID){
                                                    $.ajax({
                                                    type: "POST",
                                                    url: "<?php echo RESI; ?>general/Vehiculo/set_InfoId_vehiculo",
                                                    data: { equi_id: resp.equi_id, info_id: newInfoID },
                                                    success: function (res) {
                                                        if (res === "ok") {
                                                            wc();
                                                            $("#cargar_tabla").load("<?php echo RESI; ?>general/Vehiculo/Listar_Vehiculo");
                                                            alertify.success("Vehiculo Agregado con exito");
                                                            $("#formVehiculo")[0].reset();
                                                            $('#formVehiculo').data('bootstrapValidator').resetForm();
                                                            

                                                            $("#boxDatos").hide(500);
                                                            $("#botonAgregar").removeAttr("disabled"); 
                                                        } else {
                                                            wc();
                                                            alertify.error("Error al actualizar Generador con info_id");
                                                        }
                                                    }
                                                });
                                                }                                      

                                        } else {
                                            //console.log(r);
                                            wc();
                                            error = resp.message;
                                            alertify.error(error);
                                        }
                                    }
                                });
                            }else{
                                alert("ATENCION!!! NO selecciono tipo de residuos");
                            }
                        }else{
                            alert("ATENCION!!! No ingreso capacidad");
                        }

                    }else{
                        datos.optionsTolva = "no";
                        datos.capacidad = 1;
                        //llama funcion controller
                        wo();
                        $.ajax({
                        type: "POST",
                        data: {datos},
                        url: "<?php echo RESI; ?>general/Vehiculo/Guardar_Vehiculo",
                        success: async function (r) {
                            debugger;
                            const resp = JSON.parse(r);
                            if (resp.status == "ok") {
                                 debugger;           
                                 idFormDinamico = "#"+$('.frm-new').find('form').attr('id');

                                if(idFormDinamico != "#undefined"){
                                    var newInfoID = await frmGuardarConPromesa($(idFormDinamico));
                                }

                                if(newInfoID){
                                    $.ajax({
                                    type: "POST",
                                    url: "<?php echo RESI; ?>general/Vehiculo/set_InfoId_vehiculo",
                                    data: { equi_id: resp.equi_id, info_id: newInfoID },
                                    success: function (res) {
                                        if (res === "ok") {
                                            wc();
                                            $("#cargar_tabla").load("<?php echo RESI; ?>general/Vehiculo/Listar_Vehiculo");
                                            alertify.success("Vehiculo Agregado con exito");
                                            $("#formVehiculo")[0].reset();
                                            $('#formVehiculo').data('bootstrapValidator').resetForm();
                                            

                                            $("#boxDatos").hide(500);
                                            $("#botonAgregar").removeAttr("disabled"); 
                                        } else {
                                            wc();
                                            alertify.error("Error al actualizar Generador con info_id");
                                        }
                                    }
                                });
                                }
                                
                            } else {
                                //console.log(r);
                                wc();
                                alertify.error("Error al Agregar Vehiculo");
                            }
                        }
                        });

                    }

                }else{
                    alert("ATENCION!!! no selecciono si tiene o no tolva");
                }
              
            }else{
                alert("ATENCION!!! Hay Campos Sin Completar o Mal Ingresados");
                // swal("Atencion Hay campos sin completar o mal Ingresados");
            }
        }else{
            alert("ATENCION!!! No cargo Imagen");
        }
       
    }

    
$(".opcionTolva").change(function(){
    debugger;
    if($(".opcionTolva").val()=="si")
    {
            $(".Capacidad").removeAttr("style");
            $(".RSU").removeAttr("style");
    }
    if($(".opcionTolva").val()=="no")
    {
            $(".Capacidad").attr("style","display:none;");
            $(".RSU").attr("style","display:none;");
    }
});

//Funcion Editar el vehiculo

    $("#btnsave_e").click(async function(e){
        var vehiculo = new FormData();
        vehiculo = formToObject(vehiculo);
        vehiculo.equi_id = $("#e_equi_id").val();
        vehiculo.descripcion = $("#e_descripcion").val();
        vehiculo.marca = $("#e_marca").val();
        vehiculo.codigo = $("#e_codigo").val();
        vehiculo.ubicacion =  $("#e_ubicacion").val();
        vehiculo.tran_id =  $("#e_tran_id").val();
        vehiculo.dominio = $("#e_dominio").val();
        vehiculo.fecha_ingreso = $("#id_fecha_ingreso").val();
        vehiculo.imagen =  $("#input_aux_img64").val();
        vehiculo.tara =  $("#taraedit").val();
        vehiculo.ubicacion = "Sin Ubicacion"; //HARCODE - falta asignar funcion que asigne ubicacion

        console.table(vehiculo);
        //faltaria la ubicaion, el codigo y tran_id
        var aux =0; 
        if(vehiculo.descripcion != ""){
            if(vehiculo.dominio != ""){
                if(vehiculo.tara != ""){
                    if(vehiculo.marca != ""){
                        if(vehiculo.ubicacion != ""){
                            if(vehiculo.codigo != ""){
                                if(vehiculo.tran_id != ""){
                                    if(vehiculo.fecha_ingreso != ""){
                                        aux = 1;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        if(aux == 1){
            if( vehiculo.imagen != ""){
                wo();
                $.ajax({
                    type: "POST",
                    data: {vehiculo},
                    url: "<?php echo RESI; ?>general/Vehiculo/Actualizar_Vehiculo",
                    success:async function (r) {
                        console.table(r);
                        if (r == "ok") {
                            var $dynContainer = $("#modalEdit").find('.frm-new.frm-edit');

                            var $form = $dynContainer.is('form') ? $dynContainer : $dynContainer.find('form').first();
                            // Llamar a nuestra nueva función corregida
                            newInfoID = await editarFormulario($form);

                            if(newInfoID){
                                 $.ajax({
                                            type: "POST",
                                            url: "<?php echo RESI; ?>general/Vehiculo/set_InfoId_vehiculo",
                                            data: { equi_id: vehiculo.equi_id, info_id: newInfoID },
                                            success: async function (res) {
                                                if (res === "ok") {
                                                    wc();
                                                    $("#cargar_tabla").load("<?php echo RESI; ?>general/Vehiculo/Listar_Vehiculo");
                                                    alertify.success("Vehiculo Actualizado con exito");
                                                    $("#formVehiculoEdit").data('bootstrapValidator').resetForm();
                                                    $("#modalEdit").modal('hide');
                                                    $("#modalEdit").modal("hide"); 
                                                    $(".esconder").attr("style","left: 38rem; top: -2rem; "); 
                                                    
                                                
                                                                        
                                                    $("#modalEdit").hide(500);
                                                } else {
                                                    wc();
                                                    alertify.error("Error al actualizar Generador con info_id");
                                                }
                                            }
                                        });
                            }

                        } else {
                            wc();
                            alertify.error("Error al actualizar Vehiculo");
                            $("#formVehiculoEdit").data('bootstrapValidator').resetForm();
                            $("#modalEdit").modal("hide"); 
                            $(".esconder").attr("style","left: 38rem; top: -2rem; "); 
                        }
                    }
                });
            }else{
                alert("Atencion!!! No ha cargado una imagen");
            }
        }else{
            alert("Atencion!!! hay un campo que esta vacio");
        }
    });

//Funcion Eliminar Vehiculo
     function deletevehiculo(){
        var eliminar = new FormData();
        eliminar = formToObject(eliminar);
        eliminar.equi_id = $("#id_vehiculo").val();
       // datos.eliminado = 1;
        console.table(eliminar);
        wo();
        $.ajax({
                type: "POST",
                data: {eliminar},
                url: "<?php echo RESI; ?>general/Vehiculo/Borrar_Vehiculo",
                success: function (r) {
                    console.table(r);
                    if(r == "ok") {
                        wc();
                        $('#btndelete').hide();
                        $("#cargar_tabla").load("<?php echo RESI; ?>general/Vehiculo/Listar_Vehiculo");
                         alertify.success("Vehiculo Eliminado con exito");
                         $("#modalBorrar").modal('hide');
                    } else {          
                        wc();              
                        alertify.error("Error al Eliminar Vehiculo");
                        
                    }
                }
            });

     }
 

</script>
​<!--_____________________________________________________________-->

<!--Script Bootstrap Validacion.-->
<script>
    $('#formVehiculo').bootstrapValidator({
        message: 'This value is not valid',
        /*feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },*/
        //excluded: ':disabled',
        fields: {
            descripcion: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                      /*stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The username must be more than 6 and less than 30 characters long'
                      },*/
                    regexp: {
                        regexp: /[A-Za-z]/,
                        message: 'la entrada no debe ser un numero entero'
                    }
                }
            },
            dominio: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                      /*stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The username must be more than 6 and less than 30 characters long'
                      },*/
                      regexp: {
                        regexp: /[A-Za-z]/,
                        message: 'la entrada no debe ser un numero entero'
                    }
                }
            },
            marca: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                       /*stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The username must be more than 6 and less than 30 characters long'
                      },*/
                    regexp: {
                        regexp: /[A-Za-z]/,
                        message: 'la entrada no debe ser un numero entero'
                    }
                }
            },
            condicion: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            tran_id: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            optionsTolva: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            rsu: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            ubicacion: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            codigo: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            modelo: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                      /*stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The username must be more than 6 and less than 30 characters long'
                      },*/
                    regexp: {
                        regexp: /[A-Za-z]/,
                        message: 'la entrada no debe ser un numero entero'
                    }
                }
            },
            capacidad: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                      /*stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The username must be more than 6 and less than 30 characters long'
                      },*/
                    regexp: {
                        regexp: /^(0|[1-9][0-9]*)$/,
                        message: 'la entrada no debe ser un numero entero'
                    }
                }
            },
            tara: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                      /*stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The username must be more than 6 and less than 30 characters long'
                      },*/
                    regexp: {
                        regexp: /^(0|[1-9][0-9]*)$/,
                        message: 'la entrada no debe ser un numero entero'
                    }
                }
            },
            habilitacion: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                      /*stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The username must be more than 6 and less than 30 characters long'
                      },*/
                    regexp: {
                        regexp: /^(0|[1-9][0-9]*)$/,
                        message: 'la entrada no debe ser un numero entero'
                    }
                }
            },
            registro: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                      /*stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The username must be more than 6 and less than 30 characters long'
                      },*/
                }
            },
            fecha_ingreso: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                      /*stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The username must be more than 6 and less than 30 characters long'
                      },*/
                }  
            }
        }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        //guardar();
    });

function ampliarDesc () 
{ 
    $("#modalEdit").modal("hide"); 
    $("#modalVerDescAmpliada").modal("show"); 
    var valor = $("#e_descripcion").val(); 
    $("#descrip").val(valor); 
     
} 
function cerrar_Ampliar(){ 
    $("#modalVerDescAmpliada").modal("hide"); 
    $("#modalEdit").modal("show"); 
} 

</script>
​<!--_____________________________________________________________-->

<!--Script Bootstrap Validacion.MODAL EDITAR -->
<script>
    $('#formVehiculoEdit').bootstrapValidator({
        message: 'This value is not valid',
        /*feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },*/
        //excluded: ':disabled',
        fields: {
           e_descripcion: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                      /*stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The username must be more than 6 and less than 30 characters long'
                      },*/
                    regexp: {
                        regexp: /[A-Za-z]/,
                        message: 'la entrada no debe ser un numero entero'
                    }
                }
            },
            e_dominio: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                      /*stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The username must be more than 6 and less than 30 characters long'
                      },*/
                    regexp: {
                        regexp: /[A-Za-z]/,
                        message: 'la entrada no debe ser un numero entero'
                    }
                }
            },
            taraedit: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                      
                }
            },
            e_marca: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                    regexp: {
                        regexp: /[A-Za-z]/,
                        message: 'la entrada no debe ser un numero entero'
                    }
                }
            },
            e_ubicacion: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                      /*stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The username must be more than 6 and less than 30 characters long'
                      },*/
                    regexp: {
                        regexp: /[A-Za-z]/,
                        message: 'la entrada no debe ser un numero entero'
                    }
                }
            },
            e_codigo: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                     }
                    //   /*stringLength: {
                    //       min: 6,
                    //       max: 30,
                    //       message: 'The username must be more than 6 and less than 30 characters long'
                    //   },*/
                    // regexp: {
                    //     regexp: /^(0|[1-9][0-9]*)$/,
                    //     message: 'la entrada no debe ser un numero entero'
                    // }
                }
            },
            e_tran_id: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            id_fecha_ingreso: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                      /*stringLength: {
                          min: 6,
                          max: 30,
                          message: 'The username must be more than 6 and less than 30 characters long'
                    },*/
                }
            }
        }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        //guardar();
    });


    /* no funca bootstrapValidator  */
function validarFormularioVahiculo() {
    //const razon_social = $("#razon_social").val();
    const dominio = $("#dominio").val().trim();
    const marca = $("#marca").val().trim();
    const descripcion = $("#descripcion").val().trim();
    const codigo = $("#codigo").val().trim();
    const fecha_ingreso = $("#fecha_ingreso").val();
    const movilidad = $("#optolva").is(":checked");
    const num_registro = $("#num_registro").val();
    const modelo = $("#modelo").val();

    /*     if (!razon_social) {
        alertify.error("Debe ingresar el nombre o razón social");
        $("#razon_social").focus();
        return false;
    } */

    if (!dominio) {
        alertify.error("Debe ingresar el dominio");
        $("#dominio").focus();
        return false;
    }

    if (!marca) {
        alertify.error("Debe ingresar marca");
        $("#marca").focus();
        return false;
    }

    if (!descripcion) {
        alertify.error("Debe ingresar descripción");
        $("#descripcion").focus();
        return false;
    }

    if (!codigo) {
        alertify.error("Debe ingresar Numero de registro");
        $("#codigo").focus();
        return false;
    }

    if (!fecha_ingreso) {
        alertify.error("Debe ingresar fecha de ingreso");
        $("#fecha_ingreso").focus();
        return false;
    }

    if(movilidad) {
        alertify.error("Debe ingresar movilidad");
        $("#optolva").focus();
        return false;
    }

    if (!modelo) {
        alertify.error("Debe ingresar modelo");
        $("#modelo").focus();
        return false;
    }



    return true; 
}


function validaDominio(dominio) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: "GET",
                data: { dominio: dominio },
                url: "<?php echo RESI; ?>general/Vehiculo/valida_dominio", 
                success: function (r) {
                    wc();

                    try {

                        let existe = false;
                        if (r === 'true') {
                            existe = true;
                        } else  {
                            existe = false;
                        }

                        resolve(existe);
                    } catch (e) {
                        reject(e);
                    }
                },
                error: function (xhr, status, error) {
                    reject(error);
                }
            });
        });
    }


</script>
<!--_____________________________________________________________-->

<!-- script Datatables -->
<script>
    DataTable($('#tabla_vehiculos'))
    $('.select3').select2();
</script>
<!--_____________________________________________________________-->