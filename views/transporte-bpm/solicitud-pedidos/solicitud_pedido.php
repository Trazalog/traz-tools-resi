<!-- /// ----------------------------------- HEADER ----------------------------------- /// -->

<div class="box box-primary animated fadeInLeft">
    <div class="box-header with-border">
            <h4>Solicitud de Pedido de Contenedor</h4>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-2 col-lg-1 col-xs-12">
                <button type="button" id="botonAgregar" class="btn btn-primary" aria-label="Left Align">Agregar</button><br>
            </div>
            <div class="col-md-10 col-lg-11 col-xs-12"></div>
        </div>
    </div>
</div>
<!-- /// ----------------------------------- HEADER ----------------------------------- /// -->

<!---//////////////////////////////////////--- BOX 1 ---///////////////////////////////////////////////////////----->
<div class="box box-primary animated bounceInDown" id="boxDatos" hidden>
    <div class="box-header with-border">
        <div class="box-tittle">
                <h5>Información</h5>
        </div>
        <div class="box-tools pull-right border ">
                <button type="button" id="btnclose" title="cerrar" class="btn btn-box-tool" data-widget="remove"
                        data-toggle="tooltip" title="" data-original-title="Remove">
                        <i class="fa fa-times"></i>
                </button>
        </div>
    </div>
    <!--_____________________________________________-->
    <div class="box-body">
        <form class="formCircuitos" id="formPedidos">
            <!--_____________________________________________-->
            <!--NRO-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="Nro" class="form-label">Nro:</label>
                    <div class="input-group date">
                        <div class="input-group-addon"> <i class="fa fa-"></i></div>
                        <input type="text" name="nro" id="Nro" value="<?php echo rand(1,100);?>" class="form-control"readonly>
                    </div>
                </div>
            </div>
            <!--_____________________________________________-->
            <!--FECHA RETIRO-->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control"   name="fecha" id="Fecha" value="<?php echo date("Y-m-d");?>">
                    </div>
                </div>
            </div>
            <!--_____________________________________________-->
            <!--TRANSPORTISTA-->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="transportista" class="form-label">Transportista:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>
                        <select class="form-control select2-hidden-accesible" id="transportista_id" name="transportista" required onchange="getTipoResiduos()">
                            <option value="" disabled selected>-Seleccione Transportista-</option>
                            <?php
                                foreach ($transportista as $i) {
                                    echo '<option value="'.$i->tran_id.'">'.$i->razon_social.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!--_____________________________________________-->  
        </form>		      
        <!--_____________________________________________-->					
        <!--_____________ SEPARADOR _____________-->
        <div class="col-md-12 col-sm-12 col-xs-12"> <br> <br></div>
        <!--__________________________-->
        <!---//////////////////////////////////////--- REGISTRAR PEDIDOS ---///////////////////////////////////////////////////////----->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4>Registrar Pedido de contendor</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form class="formPedidos" id="formPedidos">
                <!--TIPO RESIDUOS-->
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for="tipores" class="form-label">Tipo residuo<?php echo hreq() ?>:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                    <i class="glyphicon glyphicon-check"></i>
                            </div>
                            <select class="form-control select2 select2-hidden-accesible" id="tipores" name="tipo_residuo" required>
                                <option value="" disabled selected>-Seleccione opción-</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--_____________________________________________-->
                <!--CANTIDAD-->
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for="Dpto" >Cantidad de contenedores<?php echo hreq() ?>:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-check"></i>
                            </div>
                            <input type="number" class="form-control cant" name="cantidad" id="cantidadContenedores">
                        </div>          
                    </div>
                </div>
                <!--_____________________________________________-->
                <!--Mts3-->
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for="Volumen" >Mts3:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-check"></i>
                            </div>
                            <input type="number" class="form-control" name="volumen" id="volumen">
                        </div>          
                    </div>
                </div>
                <!--_____________________________________________-->
            </form>
        <!--_________________SEPARADOR_________________-->
        <div class="col-md-12 col-sm-12 col-xs-12"><hr></div>
        <!--_________________SEPARADOR_________________-->

        <!--_____________ Boton agregar _____________-->	
        <div class="col-md-12">
                <button type="submit" class="btn btn-default pull-right" onclick="Agregar_pedido()">AGREGAR</button>
        </div>
        <!--__________________________-->

        <!--_________________SEPARADOR_________________-->
        <div class="col-md-12 col-sm-12 col-xs-12"> <br></div>
        <!--_________________SEPARADOR_________________-->
        </div>
        <!--_____________ SEPARADOR _____________-->
        <div class="col-md-12 col-sm-12 col-xs-12"> <br></div>
        <!--_____________ SEPARADOR _____________-->
        <!--_____________ Tabla Punto Critico _____________-->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="box" id="pedidos" style="display:none">
                <div class="box-body table-responsive">											
                    <table style="width: 100%" class="table table-striped" id="tabla_contenedores">
                        <thead class="thead-dark" bgcolor="#eeeeee">
                            <th>Acciones</th>
                            <th>Cantidad Solicitada</th>
                            <th style="display:none;">tica_id</th>
                            <th>Tipo de carga</th>
                            <th>Mts3</th>
                        </thead>	
                        <tbody>	</tbody>
                    </table>										
                </div>
            </div>
        </div>
        <!--_____________________________________________-->
        <!--_________________SEPARADOR_________________-->
        <div class="col-md-12 col-sm-12 col-xs-12"><hr></div>
        <!--_________________SEPARADOR_________________-->
        <div class="col-md-5 col-sm-5 col-xs-12">
            <div class="form-group">
                <label for="observaciones" >Observaciones:</label>
                <div class="input-group date">
                    <textarea name="observaciones" id="observaciones" cols="170" rows="2"></textarea>
                </div>
            </div>
        </div>                                                                                            
        <!--_________________ GUARDAR_________________-->
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary pull-right btn-guardar-pedido" style="display:none;" onclick="Guardar_pedidoContenedor()">GUARDAR</button>
        </div>
        <!--__________________________________-->
    </div><!--./box-body-->
</div><!--./box-->
<!---//////////////////////////////////////--- FIN BOX 1---///////////////////////////////////////////////////////----->
<!---//////////////////////////////////////---BOX TABLA ---///////////////////////////////////////////////////////----->

<div class="box box-primary">
    <div class="box-body">
        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6"></div>
            </div>        

                <!--__________________TABLA___________________________-->

                    <div class="row"><div class="col-sm-12 table-scroll" id="cargar_tabla"></div>

                <!--__________________TABLA___________________________-->                  

        </div>
    </div>

<!---//////////////////////////////////////--- FIN BOX TABLA ---///////////////////////////////////////////////////////----->
<script>
    $(document).ready(function () {
        cargarTabla();
    });
    //Carga listado de solicitudes de contenedores
    function cargarTabla(){
        wo();
        $("#cargar_tabla").load("<?php echo RESI; ?>transporte-bpm/Solicitud_pedido/listar_solicitudes", () =>{
            wc();
        });
    }
	// remueve registro de tabla temporal
	$(document).on("click",".fa-minus",function() {
        $('#tabla_contenedores').DataTable().row( $(this).closest('tr') ).remove().draw();
	});

    function getTipoResiduos(){
        var tran_id = $("#transportista_id").val();
        if (tran_id == '') return;
        $.ajax({
            type: "POST",
            data: {tran_id : tran_id},
            url: "<?php echo RESI; ?>transporte-bpm/Solicitud_pedido/obtenerTipoRes",
            success: function($r){
                var res = JSON.parse($r);
                console.table(res);
                if(res){
                    $("#tipores").find('option').remove();
                    for(var i=0; i <= res.length-1; i++){
                        $("#tipores").append("<option value= '"+res[i].tabl_id+"' >" + res[i].valor + "</option>");
                    }
                }else{
                    alertify.error("error al traer tipo de carga");
                }
            }
        });
    }

	//agrega pedido de contedor a la tabla para guardar
	function Agregar_pedido() {
        cantidadPedido = $("#cantidadContenedores").val();
        tipoResPedido = $("#tipores").val();
        volumenPedido = $("#volumen").val();
		if(cantidadPedido != "" && tipoResPedido != ""){
			console.table($("#tipores").val());
			$('#pedidos').show();
			var data = new FormData();
			data = formToObject(data);
			data.otro = ""; //No lleva nada ?
			data.tica_id = $("#tipores").val();
			var tipocarga = data.tica_id.substring(10);
			data.cantidad = cantidadPedido;
			data.volumen = volumenPedido;
			var table = $('#tabla_contenedores').DataTable();
			var row =  `<tr data-json='${JSON.stringify(data)}'> 
                            <td> <i class='fa fa-fw fa-minus text-light-blue' style='cursor: pointer; margin-left: 15px;' title='Nuevo'></i> </td>
                            <td>${data.cantidad}</td>
                            <td style="display:none;">${data.tica_id}</td>
                            <td>${tipocarga}</td>
                            <td>${volumenPedido}</td>
                        </tr>`;
			table.row.add($(row)).draw();
			$(".btn-guardar-pedido").removeAttr("style");
		}else{
			error("No cargo los campos obligatorios");
		}        
	}

	// Crea unnuevo pedido de contenedores
	function Guardar_pedidoContenedor(){
		if(  $('#tabla_contenedores').DataTable().data().any() ){
            // console.info("tabla insumos (artículos) vacía");
            if($("#Fecha").val() != ""){
                var datos = new FormData();
                datos = formToObject(datos);
                datos.observaciones = $("#observaciones").val();
                datos.tran_id = $("#transportista_id option:selected").val();
                // recorre tabla guardando los contenedores pedidos en array
                    var datos_contenedores = [];
                    var rows = $('#tabla_contenedores tbody tr');
                    rows.each(function(i,e) {  
                        datos_contenedores.push(getJson(e));
                    });
                datos.contenedores = datos_contenedores;
                $.ajax({
                    type: "POST",
                    data: {datos},
                    url: "<?php echo RESI; ?>transporte-bpm/Solicitud_pedido/registrarSolicitud",
                    success: function(r) {
                        console.log(r);
                        if (r == 'ok') {
                            alertify.success("Agregado con éxito");
                            $("#formPedidos")[0].reset();
                            cargarTabla();
                            $("#boxDatos").hide(500);
                            $("#botonAgregar").removeAttr("disabled");
                            $(".cant").val("");
                            $("#observaciones").val("");
                            var table = $('#tabla_contenedores').DataTable();
                            table.clear().draw();
                        } else {
                            console.log(r);
                            alertify.error("Error al agregar solicitud");
                        }
                    }
                });
            }else{
                alert("ATENCION!!! No selecciono Fecha");
            }
		}else{
			alert("ATENCION!!! No agrego contenedores al Pedido");
		}
	}

	// script que muestra box de datos al dar click en boton agregar
    $("#botonAgregar").on("click", function() {
            $("#botonAgregar").attr("disabled", "");
            $("#boxDatos").focus();
            $("#boxDatos").show();
    });

    $("#btnclose").on("click", function() {
            $("#boxDatos").hide(500);
            $("#botonAgregar").removeAttr("disabled");
            $("#formDatos")[0].reset();
            $('#selecmov').find('option').remove();

    });

    //script Datatables
    DataTable($('#tabla_contenedores'));
</script>