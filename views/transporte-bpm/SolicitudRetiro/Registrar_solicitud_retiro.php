<!--HEADER-->
<div class="box box-primary animated fadeInLeft">
  <div class="box-header with-border">
    <h4>Solicitud de Retiro Contenedor</h4>
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
<!--HEADER-->
<!--BOX FORMULARIO-->
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
    <div class="box-body">
        <form class="formPedidos" id="formPedidos">
        <div class="col-md-12">
            <div class="row">
            <!--Numero-->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="Nro" class="form-label">Nro:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                        <i class="glyphicon glyphicon-asterisk"></i>
                        </div>
                        <input type="text" id="Nro" value="<?php echo $nuevo_sore_id;?>" disabled class="form-control">
                    </div>
                </div>
            </div>
            <!--_______________________________-->

            <!--Fecha-->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control" id="Fecha">
                    </div>
                </div>
            </div>
            <!--_____________________________________________-->

            <!--Transportistas-->
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="form-group">
                    <label for="transportista">Transportista:</label>
                    <div class="input-group date transportistas">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>
                        <select class="form-control select2 select2-hidden-accesible" id="transportista">
                            <option value="" disabled selected>-Seleccione opcion-</option>
                            <?php
                                foreach ($transportista as $i) {
                                        echo '<option  value="'.$i->tran_id.'">'.$i->razon_social.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <br>
                    <input type="text" id="nom_transportista" style="display:none;">
                </div>
            </div>

            <!--Tipo de residuos-->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="tica_id">Tipo de residuos:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>
                        <select class="form-control" id="tica_id" style="width: 100%;">
                        </select>
                    </div>
                </div>
            </div>
            <!--_____________________________________________-->

            <!--Contenedores-->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="cont_ent">Contenedores:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>
                        <select class="form-control select2 select2-hidden-accesible" name="cont_ent" id="cont_ent">
                        </select>
                    </div>
                </div>
            </div>
            <!--_____________________________________________-->

            <!--Porcentaje llenado-->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                <label for="porcentaje" class="form-label">% Llenado:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                    <i class="glyphicon glyphicon-th"></i>
                    </div>
                    <input type="text" name="porcentaje" id="porcentaje" class="form-control">
                </div>
                </div>
            </div>
            <!--_______________________________-->

            <!--Metros cubicos-->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="metros_cub" class="form-label">mts3:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-th"></i>
                        </div>
                        <input type="text" name="metros_cub" id="metros_cub" value="" class="form-control">
                    </div>
                </div>
            </div>
            <!--_______________________________-->
        </form>

        <div class="col-md-12"></div>
    </div>
</div>

<!--_________________SEPARADOR_________________-->
<div class="col-md-12 col-sm-12 col-xs-12">
  <hr>
</div>
<!--_________________SEPARADOR_________________-->

<!--_________________BTN AGREGAR_________________-->
<div class="col-md-12">
  <button type="submit" class="btn btn-default pull-right" id="btnagregar" onclick="Agregar_contenedor()">AGREGAR</button>
  <button type="submit" class="btn btn-default pull-right" title="Agregar contenedores restanes" id="btnmas" style="display:none;">+ Contenedores Restantes</button>
  <!-- <button type="submit" class="btn btn-default pull-right" onclick="">AGREGAR</button> -->
</div>
<!--_________________BTN AGREGAR_________________-->

<!--_________________SEPARADOR_________________-->
<div class="col-md-12 col-sm-12 col-xs-12"> <br></div>
<!--_________________SEPARADOR_________________-->

<!--_________________Tabla para enviar_________________-->
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="box" id="contenedores" style="display:none">
    <!-- <div class="box " id="contenedores"> -->
    <div class="box-body table-responsive">
      <!--__________________HEADER TABLA___________________________-->
      <table style="width: 100%" class="table table-striped" id="tbl_cont">
        <thead class="thead-dark" bgcolor="#eeeeee">
          <th>Acciones</th>
          <th>Codigo Contenedor</th>
          <th style="display:none;">Contenedor</th>
          <th>% de llenado</th>
          <th>Mts3</th>
        </thead>
        <!--__________________BODY TABLA___________________________-->
        <tbody>

        </tbody>
      </table>
      <!--__________________FIN TABLA___________________________-->
    </div>
  </div>
</div>
<!--_________________Tabla para enviar_________________-->

<!--________________________SEPARADOR_____________________________________-->
<div class="col-md-12 col-sm-12 col-xs-12">
  <hr>
</div>
<!--________________________SEPARADOR_____________________________________-->

<!--_________________BTN GUARDAR_________________-->
<div class="col-md-12">
  <div class="form-group">
    <!-- <button type="submit" class="btn btn-primary pull-right" aria-label="Left Align">Guardar</button> -->
    <button type="submit" class="btn btn-primary pull-right btn-guardar-retiro" style="display:none;" onclick="guardar()">GUARDAR</button>
  </div>
</div>
<!--_________________BTN GUARDAR_________________-->

</div>
</div>
<!--BOX FORMULARIO-->


<!--TABLA LISTADO TODAS LAS SOLICITUDES-->
<!-- <div class="box box-primary">

  <div class="box-header with-border">
    <h5>Listado de Retiro Contenedores</h5>
  </div>

  <div class="box-body">
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <div class="row">

        <div class="col-sm-12 table-scroll">

          <!- -__________________TABLA___________________________- ->
          <table id="tabla_solicitudes" class="table table-bordered table-striped">
            <thead class="thead-dark" bgcolor="#eeeeee">
              <th>Acciones</th>
              <th>N° solicitud</th>
              <th>Fecha</th>
              <th>Transportista</th>
            </thead>

            <tbody>
              <tr>
                <td>
                  <button type="button" title="Editar" class="btn btn-primary btn-circle" data-toggle="modal"
                    data-target="#modalEdit"><span class="glyphicon glyphicon-pencil"
                      aria-hidden="true"></span></button>&nbsp
                  <button type="button" title="Contenedores" class="btn btn-primary btn-circle" data-toggle="modal"
                    data-target="#modalContenedor"><span class="glyphicon glyphicon-info-sign"
                      aria-hidden="true"></span></button>&nbsp
                  <button type="button" title="eliminar" class="btn btn-primary btn-circle"><span
                      class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>&nbsp
                </td>
                <td>DATO</td>
                <td> DATO</td>
                <td>DATO</td>
              </tr>
            </tbody>
          </table>

          <!- -__________________FIN TABLA___________________________- ->
        </div>
      </div>

    </div>
  </div>
  <!- -TABLA LISTADO TODAS LAS SOLICITUDES- ->
  <div class="box-body">
    <div class="row">
      <div class="col-sm-12 table-scroll" id="tbl_listado_contenedores"></div>
    </div>
</div> -->



  <script>
  // FIXME: agregar tabla en este archivo
  //$("#cargar_tabla").load("<?php echo base_url(); ?>index.php/general/Estructura/Contenedor/Listar_SolicitudesPedido");


  //Script Bootstrap Validacion.FORMULARIO GENERAL        
    $('#formGeneradores').bootstrapValidator({
        message: 'This value is not valid',
        /*feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
        },*/
        //excluded: ':disabled',
        fields: {
        Nombre_razon: {
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

        Cuit: {
            message: 'la entrada no es valida',
            validators: {
            notEmpty: {
                message: 'la entrada no puede ser vacia'
            },
            regexp: {
                regexp: /^(0|[1-9][0-9]*)$/,
                message: 'la entrada debe ser un numero entero'
            }
            }
        },

        Zona: {
            message: 'la entrada no es valida',
            validators: {
            notEmpty: {
                message: 'la entrada no puede ser vacia'
            }
            }
        },

        Rubro: {
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

        Tipo: {
            message: 'la entrada no es valida',
            validators: {
            notEmpty: {
                message: 'la entrada no puede ser vacia'
            }
            }
        },

        Domicilio: {
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

        Departamento: {
            message: 'la entrada no es valida',
            validators: {
            notEmpty: {
                message: 'la entrada no puede ser vacia'
            }
            }
        },

        Numero_registro: {
            message: 'la entrada no es valida',
            validators: {
            notEmpty: {
                message: 'la entrada no puede ser vacia'
            },
            regexp: {
                regexp: /^(0|[1-9][0-9]*)$/,
                message: 'la entrada debe ser un numero entero'
            }
            }
        },

        Tipo_Residuo: {
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
        }
        }
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        //guardar();
    });

    //Script Bootstrap Validacion.FORMULARIO MODAL EDITAR             

    $('#formGeneradoresEdit').bootstrapValidator({
        message: 'This value is not valid',
        /*feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
        },*/
        //excluded: ':disabled',
        fields: {
        e_nombre_razon: {
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

        e_cuit: {
            message: 'la entrada no es valida',
            validators: {
            notEmpty: {
                message: 'la entrada no puede ser vacia'
            },
            regexp: {
                regexp: /^(0|[1-9][0-9]*)$/,
                message: 'la entrada debe ser un numero entero'
            }
            }
        },

        e_zonag: {
            message: 'la entrada no es valida',
            validators: {
            notEmpty: {
                message: 'la entrada no puede ser vacia'
            }
            }
        },

        e_rubro: {
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

        e_tipo: {
            message: 'la entrada no es valida',
            validators: {
            notEmpty: {
                message: 'la entrada no puede ser vacia'
            }
            }
        },

        e_omicilio: {
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

        e_departamento: {
            message: 'la entrada no es valida',
            validators: {
            notEmpty: {
                message: 'la entrada no puede ser vacia'
            }
            }
        },

        e_numero_registro: {
            message: 'la entrada no es valida',
            validators: {
            notEmpty: {
                message: 'la entrada no puede ser vacia'
            },
            regexp: {
                regexp: /^(0|[1-9][0-9]*)$/,
                message: 'la entrada debe ser un numero entero'
            }
            }
        },

        e_tipo_Residuo: {
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
        }
        }
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        //guardar();
    });

    //script que muestra box de datos al dar click en boton agregar
    $("#botonAgregar").on("click", function() {
        $("#botonAgregar").attr("disabled", "");
        $("#boxDatos").focus();
        $("#boxDatos").show();
    });
    $("#btnclose").on("click", function() {
        $("#boxDatos").hide(500);
        $("#botonAgregar").removeAttr("disabled");
        $('#formDatos').data('bootstrapValidator').resetForm();
        $("#formDatos")[0].reset();
        $('#selecmov').find('option').remove();
        $('#chofer').find('option').remove();
    });


    // carga tipo de RSU dependiendo de Transportista
    $('#transportista').change(function() {
        var tran_id = this.value;
        wo();
        $.ajax({
            type: "POST",
            data: {
                tran_id: tran_id
            },
            dataType: 'json',
            url: "<?php echo RESI; ?>transporte-bpm/SolicitudRetiro/obtener_Tipo_residuo",
            success: function(respuesta) {
                var selector = $("#tica_id");
                selector.find('option').remove();
                selector.append('<option value="noSelect" disabled selected>-Seleccione opcion-</option>');
                respuesta.forEach(function(e) {
                    selector.append("<option value='" + e.tica_id + "'>" + e.valor + "</option");
                });
                wc();
            },
            error: function() {
                var selector = $("#tica_id");
                selector.find('option').remove();
                selector.append('<option value="" disabled selected>-Error-</option>');
                wc();
            },
            complete: function() {
                wc();
            }
        });
    });

    // carga contenedores dependiendo de RSU	
    $("#tica_id").change(function() {
        wo();
        var tica_id = this.value;
        var tran_id = $("#transportista").val();

        $.ajax({
            type: "POST",
            data: {
                tica_id: tica_id,
                Tran_id: tran_id
            },
            dataType: 'json',
            url: "<?php echo RESI; ?>transporte-bpm/SolicitudRetiro/obtenerContenedor",
            success: function(respuesta) {
                wc();
                debugger;
                if(respuesta != null){
                    var selector_cont = $("#cont_ent");
                    selector_cont.find('option').remove();
                    selector_cont.append('<option value="" disabled selected>-Seleccione opción-</option>');
                    respuesta.forEach(function(e) {
                        selector_cont.append("<option value='" + e.cont_id + "'>" + e.codigo + "</option");
                    });
                }else{
                    error('Error', 'No se encontraron contenedores para el tipo de residuo y transportista seleccionados.');
                }
            },
            error: function() {
                wc();
                var selector_cont = $("#cont_ent");
                selector_cont.find('option').remove();
                selector_cont.append('<option value="" disabled selected>-Sin contenedores de este RSU-</option>');
            },
            complete: function() {
                wc();
            }
    });

  });
  
  $(document).on("click",".fa-minus",function() {
			$('#tbl_cont').DataTable().row( $(this).closest('tr') ).remove().draw();
		});
  // funcion agregar contenedores a tabla 
  function Agregar_contenedor() {
    var validador = 1;
     if($("#porcentaje").val() != "")
     { 
        if($("#metros_cub").val()!= "")
        {
          if($("#cont_ent").val() != "")
          {
            validador = 0;
          }
        }
     }
     if(validador == 0)
     {
          $('#contenedores').show();
        //var data = new FormData($('#formPedidos')[0]);
        var data = new FormData();
        data = formToObject(data);
        data.porc_llenado = $("#porcentaje").val();
        data.mts_cubicos = $("#metros_cub").val();
        data.cont_id = $("#cont_ent").val();
        data.codcont = $("#cont_ent option:selected").text();
        var table = $('#tbl_cont').DataTable();
        var row = `<tr data-json='${JSON.stringify(data)}'>  
                <td> <i class='fa fa-fw fa-minus text-light-blue' style='cursor: pointer; margin-left: 15px;' title='Nuevo'></i> </td>
                <td>${data.codcont}</td>
                <td style='display:none;'>${data.cont_id}</td>
                <td>${data.porc_llenado}</td>
                <td>${data.mts_cubicos}</td>		
            </tr>`;
        table.row.add($(row)).draw();
        $(".btn-guardar-retiro").removeAttr("style");
        //elimina del select los contenedores que se seleccionaron
        // var sel = document.getElementById("tica_id");
  			// sel.remove(sel.selectedIndex);
        var sele = document.getElementById("cont_ent");
  			sele.remove(sele.selectedIndex);
        $(".transportistas").attr("style","display:none;");
        var nomtran = $("#transportista option:selected" ).text();
        $("#nom_transportista").removeAttr("style");
        $("#nom_transportista").attr("style","width: 50rem;");
        $("#nom_transportista").val(nomtran);
        $("#porcentaje").val("");
        $("#metros_cub").val("");
        // $('#formPedidos')[0].reset();
        // $("#btnagregar").attr("style","display:none;");
        // $("#btnmas").removeAttr("style");
       
     }else{
       alert("ATENCION!!! verifique que ingreso contenedor, porcentaje de llenado y mts cubicos")
     }
    
  }

  // $("#btnmas").click(function(e){
  //   $("#btnagregar").removeAttr("style");
  //   $("#btnmas").attr("style","display:none;");
  // });
  // remueve registro de lista temporal de contenedres a agregar
  $(document).on("click", ".fa-minus", function() {
    $(this).parents("tr").remove();
  });

  // crea una nueva solicitud de de retiro e inicia un nuevo proceso
  function guardar() {
    debugger;
    wo();
    var datos = new FormData();
    datos = formToObject(datos);

    var datos_contenedor = [];
    var cont_entregados_listo = [];	
    var contEnt = new FormData();
		contEnt = formToObject(contEnt);

    var rows = $('#tbl_cont tbody tr');
    rows.each(function(i,e) {  
				datos_contenedor.push(getJson(e));
		});

    //llenarlo afuera del each y aca solo armar el arreglo con el push(getJson(e)) por lo tanto usar dos arreglos uno dentro dep each para obtener bien los datos de la tabla y luego afuera recorrerlo ir armando el modelos e ir insertando en otro arreglo que es el que se enviara como final 
    for(var j=0; j<datos_contenedor.length; j++){
        contEnt.cont_id = datos_contenedor[j].cont_id;
        contEnt.porc_llenado = datos_contenedor[j].porc_llenado;
        contEnt.mts_cubicos = datos_contenedor[j].mts_cubicos;
        cont_entregados_listo.push(contEnt);
        var contEnt = new FormData();
        contEnt = formToObject(contEnt);
    }


	  datos.contenedores = cont_entregados_listo;

    if (datos_contenedor.lenght == 0) {
        alert('Sin Datos para Registrar.');
        return;
    }else{

        $.ajax({
        type: "POST",
        data: {datos},
        url: "<?php echo RESI; ?>transporte-bpm/SolicitudRetiro/Guardar_SolicitudRetiro",
        success: function(respuesta) {
            wc();
            console.log(respuesta);
            if (respuesta) {
                alertify.success("Solicitud de Retiro creada con éxito");
                $("#formPedidos")[0].reset();
                $("#boxDatos").hide(500);
                $("#botonAgregar").removeAttr("disabled");
                $(".transportistas").removeAttr("style");
                $("#nom_transportista").attr("style","display:none;");

            } else {
                console.log(respuesta);
                alertify.error("Error al crear Solicitud de Retiro");
                $(".transportistas").removeAttr("style");
                $("#nom_transportista").attr("style","display:none;");
            }
        }
    });

    }

    

  }

  // Initialize Select2 Elements
    $('.select3').select2();

  //Datatables
    DataTable($('#tabla_residuos'));
    DataTable($('#tabla_contenedores'));
    DataTable($('#tabla_solicitudes'));
    DataTable($('#tabla_transportistas'));
    DataTable($('#tbl_cont'));
  // Datatables 
  </script>