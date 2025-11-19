<!-- ocultar/eliminar el botón que guardar de el form dinámico -->
<style>
.frm-new .frm-save { display: none !important; }

    .edit-padding {
        padding-left: 0 !important;
        padding-right: 10px;
    }

</style>

<!-- /// ----------------------------------- HEADER ----------------------------------- /// -->

<div class="box box-primary animated fadeInLeft">
    <div class="box-header with-border">
        <h4>Registrar Generadores</h4>
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

<!---//////////////////////////////////////--- BOX 1 ---///////////////////////////////////////////////////////----->

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

    <!--_____________________________________________-->

    <div class="box-body">
        <form class="formGeneradores" id="formGeneradores"method="POST" autocomplete="off">
            <div class="col-md-6 col-sm-6 col-xs-12">

                <!--Nombre / Razon social-->
                <div class="form-group">
                    <label for="Nombre/Razon social"> Nombre / Razon social <strong class="text-danger"> *</strong>:</label>
                    <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-check"></i>
                            </div>
                    <input type="text" class="form-control" name="razon_social" id="razon_social">
                    </div>
                </div>
                <!--_____________________________________________-->

                <!--CUIT-->
                <div class="form-group">
                    <label for="CUIT">CUIT <strong class="text-danger"> *</strong>:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>                    
                    <input type="text" class="form-control"  name="cuit" id="cuit">
                    </div>  
                </div>
                <!--_____________________________________________-->

                <!--Departamento-->
                <div class="form-group">
                    <label for="Dpto">Departamento <strong class="text-danger"> *</strong>:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>
                        <select class="form-control select2 select2-hidden-accesible" name="depa_id" id="depa_id">
                            <option value="" disabled selected>-Seleccione opción-</option>
                            <?php
                                foreach ($departamentos as $dep) {
                                    echo '<option  value="'.$dep->depa_id.'">'.$dep->nombre.'</option>';             
                                }
                            ?>
                        </select>
                    </div>
                </div>
                
                <!--_____________________________________________-->

                <!--Rubro-->
                <div class="form-group">
                    <label for="Rubro" >Actividad / Rubro:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>
                        <select class="form-control select2 select2-hidden-accesible" name="rubr_id" id="rubr_id">
                            <option value="" disabled selected>-Seleccione opción-</option>
                            <?php
                            foreach ($Rubro as $i) {
                                echo '<option  value="'.$i->tabl_id.'">'.$i->valor.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!--_____________________________________________-->

                <!--Tipo-->
                <div class="form-group">
                    <label for="TipoG" name="Tipo">Tipo <strong class="text-danger"> *</strong>:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>
                        <select class="form-control select2 select2-hidden-accesible" name="tist_id" id="tist_id">
                            <option value="" disabled selected>-Seleccione opción-</option>
                            <?php
                            foreach ($Tipogenerador as $i) {
                                echo '<option  value="'.$i->tabl_id.'">'.$i->valor.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!--_____________________________________________-->

            
            <!--Domicilio-->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">                
                    <label for="Domicilio">Domicilio de Operación<strong class="text-danger"> *</strong>:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>
                    <input type="text" class="form-control"  name="domicilio" id="domicilio">
                    </div>
                </div>
                <!--_____________________________________________-->
                
                <!--Numero de registro-->
                <div class="form-group">
                    <label for="Numero de registro">N° de Registro<strong class="text-danger"> *</strong>:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>
                    <input type="text" class="form-control" name="num_registro" id="num_registro">
                    </div>
                </div>
                <!--_____________________________________________--> 

                <!--Zona-->
                <div class="form-group">
                    <label for="Zonag">Zona/Circuito:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>
                        <select class="form-control select2 select2-hidden-accesible" name="zona_id" id="zona_id">
                            <option value="" disabled selected>-Seleccione opción-</option>
                        </select>
                    </div>  
                </div>
                <!--_____________________________________________-->

                <!--Tipo de residuo-->								
                <div class="form-group">
                    <label for="tipoResiduos">Tipo de residuo<strong class="text-danger"> *</strong>:</label>
                    <div class="input-group date">
                        <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                        <select class="form-control select3" multiple="multiple"  data-placeholder="Seleccione tipo residuo"  style="width: 100%;"  id="tica_id" name="tica_id">															
                            <?php
                                foreach ($Tiporesiduo as $residuo) {		
                                    echo '<option  value="'.$residuo->tabl_id.'">'.$residuo->valor.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <!--_____________________________________________-->

                <!--Geolocalizacion-->
    
                <div class="form-group">                
                    <label for="Domicilio">Geolocalización<strong class="text-danger"> *</strong>:</label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="glyphicon glyphicon-check"></i>
                        </div>
                    <input type="text" class="form-control"  name="geolocalizacion" id="geolocalizacion">
                    </div>
                </div>
                <!--_____________________________________________-->
            </div>
<!--             <div class="col-md-12 col-sm-12 col-xs-12">
                <hr>
            </div> -->
        </form>
        <div class="col-md-12 col-sm-12 col-xs-12">
                <?php
                    echo (!empty($form_id)) ? '<div class="frm-new" data-form="'.$form_id.'"></div>' : '<div class="frm-new" data-form="0"></div>';
                ?>
                <!-- Campo oculto para almacenar form_id -->
			    <input type="hidden" id="FormId" value="<?php echo $form_id; ?>">
        </div>
        <hr>
        <div class='modal-footer'>
            <button type="submit" class="btn btn-primary pull-right" style="margin-left:10px;" onclick="Guardar_Generador(event)">Guardar</button>
            <button type='submit' class='btn btn-danger pull-right' id='btnImprimir' onclick='abrirModalGenerador()' disabled>Imprimir Registro</button>
        </div>

        <br>
    </div>
</div>

</div>

 <!-- MODAL REMITO -->
    <?php $this->load->view(RESI. "generadores/modal_impresion") ?>
<!-- FIN MODAL REMITO -->

<!---//////////////////////////////////////--- MODAL EDITAR ---///////////////////////////////////////////////////////----->

    
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title titulo" id="exampleModalLabel">Editar Generador</h5>
            </div>
            <div class="modal-body">
            <!--__________________ FORMULARIO MODAL __________________-->
            <form method="POST" autocomplete="off" id="formGeneradoresEdit" class="registerForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="e_nombre_razon">Nombre / Razon social:</label>
                                    <br>
                                    <input type="text" class="form-control habilitar" id="E_Nombre_Razon_social" name="e_nombre_razon">
                                </div>
                                <div class="form-group">
                                    <label for="e_cuit">CUIT:</label>
                                    <br>
                                    <input type="text" class="form-control habilitar" id="E_CUIT" name="e_cuit">
                                </div>
                            </div>
                            <!-- ___________________________________________________________________________________________ -->
                            <div class="col-md-6 col-sm-6">
                           
                            <div class="form-group">
                                    <label for="TipoG" >Tipo de generador:</label>
                                    <br>
                                         <select class="form-control select2 select2-hidden-accesible habilitar ocultar" id="E_TipoG"name="e_tipo">
                                            <option value="" disabled selected>-seleccione opción-</option>
                                            <?php
                                            foreach ($Tipogenerador as $c) {
                                                echo '<option  value="'.$c->tabl_id.'">'.$c->valor.'</option>';
                                            }
                                            ?>
                                        </select>
                                        <input type="text" class="form-control mostrar" id="text_generador" name="" style="display:none">
                                </div>							

                                <div class="form-group">
                                        <label for="Domicilio" >Domicilio:</label>
                                        <input type="text" class="form-control habilitar" id="E_Domicilio" name="e_omicilio">
                                </div>
                               
                                
                                    <input type="text" class="form-control habilitar" id="id_gen"  style="display:none">
                            

                            </div>
                        </div>
                    </div>
                    <!-- ____________________________________________________________________________________________ -->
                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="e_numero_registro">Numero de registro:</label>
                                    <input type="text" class="form-control habilitar" id="E_Numero_registro" name="e_numero_registro">  
                                </div> 
                                <div class="form-group">
                                    <label for="Zonag" >Zona:</label>
                                    <br>
                                    <select class="form-control select2 select2-hidden-accesible habilitar ocultar" id="E_Zonag" name="e_zonag">
                                        <option value="" disabled selected>-Seleccione un departamento-</option>
                                        <?php
                                        foreach ($Zonagenerador as $j) {
                                            echo '<option  value="'.$j->zona_id.'">'.$j->nombre.'</option>';
                                        }
                                        ?>
                                    </select>
                                    <input type="text" class="form-control mostrar" id="text_zona" name="" style="display:none">
                                </div>                                
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="TipoG" >Tipo de rubro:</label>
                                    <br>
                                    <select class="form-control select2 select2-hidden-accesible ocultar" id="E_TipoR"name="e_tipoR">
                                        <option value="" disabled selected></option>
                                        <?php
                                        foreach ($Rubro as $e) {
                                            echo '<option  value="'.$e->tabl_id.'">'.$e->valor.'</option>';
                                        }
                                        ?>
                                    </select>
                                    <input type="text" class="form-control mostrar" id="text_rubro" name="" style="display:none">
                                </div>
                                <div class="form-group">
                                    <label for="tipoResiduos">Tipo de residuo:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                                        <select class="form-control select3" multiple="multiple"  data-placeholder="Seleccione tipo residuo"  style="width: 100%;"  id="tica_edit" name="e_tica_edit">															
                                            <?php
                                            foreach ($Tiporesiduo as $residuo) {		
                                                    echo '<option  value="'.$residuo->tabl_id.'">'.$residuo->valor.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- ./modal-body -->
            </form>
            <div class="col-md-12">
                <div class="col-md-12">
                    <?php
                        echo (!empty($form_id)) 
                        ? '<div class="frm-new frm-edit" data-form="'.$form_id.'" data-info="'.$info_id.'"></div>' 
                        : '<div class="frm-new frm-edit" data-form="0" data-info=""></div>';
                    ?>
                    <!-- Campo oculto para almacenar form_id -->
                    <input type="hidden" id="FormIdEdit" value="<?php echo $form_id; ?>">
                </div>
            </div>

            <!--__________________ FIN FORMULARIO MODAL __________________-->

            </div>
            <div class="modal-footer">
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary" id="btnsave_e">Guardar</button>
                    <button type="submit" class="btn btn-default" id="btnsave" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!---//////////////////////////////////////--- FIN MODAL EDITAR ---///////////////////////////////////////////////////////----->
<!---//////////////////////////////////////--- MODAL BORRAR ---///////////////////////////////////////////////////////----->
    
<div class="modal fade" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel"> Eliminar Generador</h5>
            </div>
            <input type="text" id="id_generador" style="display:none">
            <div class="modal-body">
            <center>
					<h4>
						<p>¿DESEA ELIMINAR EL GENERADOR?</p>
					</h4>
			</center>
           

            <!--__________________ FIN FORMULARIO MODAL ___________________________-->

            </div>
            <div class="modal-footer">
                <center>
                    <button type="submit" class="btn btn-primary" id="btndelete" onclick="deletegenerador()">SI</button>
                    <button type="submit" class="btn btn-default" id="btncancelar" data-dismiss="modal" id="cerrar">NO</button>
                </center>
            </div>
        </div>
    </div>
</div>


<!---//////////////////////////////////////--- FIN MODAL BORRAR ---///////////////////////////////////////////////////////----->

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

<!---//////////////////////////////////////--- SCRIPTS---///////////////////////////////////////////////////////----->

<!--_____________________________________________________________-->

<!-- script modal -->
<script>
$("#btnview").on("click", function() {
    $("#btnadd").removeClass("active");
    $("#btnview").addClass("active");
    $("#tablamodal").show();
    $("#formadd").hide();
    $("#btnsave").hide();
});

$(".close").on("click", function() {
    $('#tica_edit').select2('val', 'All');
    $('#formGeneradoresEdit').data('bootstrapValidator').resetForm();
});


$("#btnadd").on("click", function() {
    $("#btnadd").addClass("active");
    $("#btnview").removeClass("active");
    $("#formadd").show();
    $("#tablamodal").hide();
    $("#btnsave").show();
});

$('#depa_id').change(function(e){
    e.preventDefault();
    var depa_id = $('#depa_id option:selected').val();
    console.info('depa_id : ' + depa_id);
    $('#zona_id').empty();
    $.ajax({
        type: 'POST',
        data:{depa_id: depa_id},
        url: "<?php echo RESI; ?>general/Generador/obtener_Zona_departamento",
        success: function(result) {
            if(result){
                console.table( ' resultado: ' + result);
                $("#zona_id").append("<option value='' disabled selected>-Seleccione opción-</option>");
                $.each(JSON.parse(result), function(key,zona){
                    $('#zona_id').append("<option value='" + zona.zona_id + "'>" +zona.zona_nom+"</option");	
                });
            }else{
                notificar('Error','Departamento seleccionado no posee zonas disponibles.','warning');
            }
        },
        error: function(result){				
        }
    });
});

</script>

<!---/////////////////////////--- BOOTSRAP VALIDATOR---/////////////////////////----->

<!--_____________________________________________________________-->

<!--Script Bootstrap Validacion.FORMULARIO GENERAL -->
<script>
    $('#formGeneradores').bootstrapValidator({
        message: 'This value is not valid',
        /*feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },*/
        //excluded: ':disabled',
        fields: {
            razon_social: {
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
            cuit: {
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
            /* zona_id: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            }, */
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
            rubr_id: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            domicilio: {
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
            depa_id: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            num_registro: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                    regexp: {
                        regexp: /^(0|[1-9][0-9]*)$/,
                        message: 'la entrada no debe ser un numero entero'
                    }
                }
            },
            tist_id: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            tica_id: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            }
        }
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        //guardar();
    });
</script>

<!---/////////////////////////--- FIN BOOTSRAP VALIDATOR---/////////////////////////----->
<script>
//validadores From editar generadores
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
            e_tipo: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            e_tipoR: {
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
                    }
                }
            },
           
           
            e_numero_registro: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
/*             e_zonag: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            }, */
            e_tica_edit: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            }
        }
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        //guardar();
    });



</script>


<!-- Funcion GUARDAR Generador -->
<script>
    $("#cargar_tabla").load("<?php echo RESI; ?>general/Generador/Listar_Generador");
    
    detectarForm();
	initForm();

   async function Guardar_Generador(e) {
        // datos = $('#form').serialize();
                    //FIXME: AGREGAR CAMPOS LAT Y LONG

        if (e && e.preventDefault) e.preventDefault();
        var datos = new FormData($('#formGeneradores')[0]);

        const tistId = datos.get('tist_id');
        const esMunicipio = tistId === 'tipo_generadorMunicipio';

        const num_registro = datos.get('num_registro');
        const existe = await validaRegistro(num_registro);

            if (existe) {
                alertify.error("El N° de Registro ya se encuentra registrado");
                wc();
                return;
            }

        if (esMunicipio) {
            // Para municipio, zona_id es obligatorio
            if (!datos.has('zona_id')) {
                alert('Es municipio es obligatorio seleccionar una zona');
                $("#btnGuardar_generador").removeAttr("disabled");
                return;
            }
        } else {
            // Para otros tipos, si no tiene zona_id, agregar como null
            if (!datos.has('zona_id')) {
                datos.append('zona_id', '');
            }
        }

        datos = formToObject(datos);

        datos.lat = "110";
        datos.lng = "220";
        console.table(datos);
        var datos_tipo_carga = $("#tica_id").val();

        //validacion Evaluador form dinamico
        if (!validaFormDinamico('.frm-new')) return;

        if ($("#formGeneradores").data('bootstrapValidator').isValid()) {
            wo();
            $.ajax({
                type: "POST",
                data: {datos, datos_tipo_carga},
                url: "<?php echo RESI; ?>general/Generador/Guardar_Generador",
                success: async function (r) {
                    console.log(r);
                    const resp = JSON.parse(r);
                    if (resp.status == "ok") {

                        // Guardado del formulario dinamico
                        idFormDinamico = "#"+$('.frm-new').find('form').attr('id');
		
                        if(idFormDinamico != "#undefined"){
                            wo();
                            var newInfoID = await frmGuardarConPromesa($(idFormDinamico));
                        }

                        if(newInfoID){
                            wc();
                            // actualizo solicitantes_transporte con el info_id
                             $.ajax({
                                type: "POST",
                                url: "<?php echo RESI; ?>general/Generador/set_InfoId_generador",
                                data: { sotr_id: resp.sotr_id, info_id: newInfoID },
                                success: function (res) {
                                    if (res === "ok") {
                                        $("#cargar_tabla").load("<?php echo RESI; ?>general/Generador/Listar_Generador");
                                        alertify.success("Generador Agregado con exito");
                                        $('#tica_id').select2('val', 'All');
                                        $('#formGeneradores').data('bootstrapValidator').resetForm();
                                        $("#btnImprimir").removeAttr("disabled");
                                        //$("#formGeneradores")[0].reset();
                                        //$(".frm-new")[0].reset();
                                        //$("#boxDatos").hide(500);

                                        $("#botonAgregar").removeAttr("disabled"); 
                                    } else {
                                        wc();
                                        alertify.error("Error al actualizar Generador con info_id");
                                    }
                                }
                            });
                        }
                        else{
                            wc();
                            alertify.error("Error al Agregar Formulario dinamico");
                            $('#tica_id').select2('val', 'All');
                            $('#formGeneradores').data('bootstrapValidator').resetForm();
                            $("#formGeneradores")[0].reset();
                        }

                    } else {
                        wc();
                        alertify.error("Error al Agregar Generador");
                        $('#tica_id').select2('val', 'All');
                        $('#formGeneradores').data('bootstrapValidator').resetForm();
                        $("#formGeneradores")[0].reset();
                    }
                }
            });
        }else{
            alert("ATENCION!!! Hay campos sin Completar o Mal Ingresados");
        }
    }

    // Funcion Guardar lo que se edito del modal Edit
    /* falta terminar guarda vacio los datos del form_id */
       $("#btnsave_e").click(function(e){
            e.preventDefault();

            var generador = formToObject(new FormData()); // mantiene tu patrón
            generador.sotr_id = $("#id_gen").val();
            generador.razon_social =  $("#E_Nombre_Razon_social").val();
            generador.cuit =  $("#E_CUIT").val();
            generador.domicilio =  $("#E_Domicilio").val();
            generador.num_registro =  $("#E_Numero_registro").val();
            generador.lat =  120;
            generador.lng = 120;
            generador.zona_id =  $("#E_Zonag").val();
            generador.rubr_id =  $("#E_TipoR").val();
            generador.tist_id =  $("#E_TipoG").val();
            console.table(generador);

            // validación rápida
            var requiredOk = $("#E_Nombre_Razon_social").val() !== "" &&
                            $("#E_CUIT").val() !== "" &&
                            $("#E_TipoR").val() !== "" &&
                            $("#E_Domicilio").val() !== "" &&
                            $("#E_Numero_registro").val() !== "" &&
                            $("#E_Zonag").val() !== "" &&
                            $("#E_TipoG").val() !== "" &&
                            $("#tica_edit").val() && $("#tica_edit").val().length > 0;

            if (!requiredOk) return error("Error","Hay campos vacíos o mal ingresados");

            var datos_tipo_carga = $("#tica_edit").val();

            wo();
            $.ajax({
                type: "POST",
                data: {generador, datos_tipo_carga},
                url: "<?php echo RESI; ?>general/Generador/Actualizar_Generador",
                success: async function (r) {
                    console.table(r);
                    wc();
                    if (r != "ok") {
                        alertify.error("Error al Actualizar Generador");
                        $('#tica_edit').select2('val', 'All');
                        $('#formGeneradoresEdit').data('bootstrapValidator').resetForm();
                        return;
                    }

                    // buscar solo el form dinámico dentro del modal de edición
                   var $dynContainer = $("#modalEdit").find('.frm-new.frm-edit');

                    var $form = $dynContainer.is('form') ? $dynContainer : $dynContainer.find('form').first();
                    if (!$form.length) {
                        console.warn('form dinámico no encontrado dentro de modalEdit');
                        return alertify.error("Formulario dinámico no disponible");
                    } 

                    // Asegurar que select2 actualice el elemento real antes de serializar
                     $form.find('.select2-hidden-accessible').each(function(){
                        $(this).trigger('change'); // fuerza que el elemento tenga el valor correcto
                    }); 

                    // validar campos del formulario dinámico
                    if (!validaFormDinamico('#modalEdit .frm-new')) return;

                    // GUARDAR FORMULARIO DINÁMICO
                    wo();
                    var newInfoID = null;
                    try {
                        // Asegurar que el formulario tenga ID
                        if (!$form.attr('id')) {
                            var tempId = 'form-dinamico-edit-' + Date.now();
                            $form.attr('id', tempId);
                            console.log('Asignado ID temporal:', tempId);
                        }

                        console.log('ID del formulario:', $form.attr('id'));
                        
                        // Llamar a nuestra nueva función corregida
                        newInfoID = await editarFormulario($form);

                    } catch(err) {
                        console.error('editarFormulario error:', err);
                        newInfoID = null;
                    } finally {
                        wc();
                    }

                    if (!newInfoID) {
                        return alertify.error("Error al guardar Formulario dinámico");
                    }

                    // actualizar generador con info_id
                    $.ajax({
                        type: "POST",
                        url: "<?php echo RESI; ?>general/Generador/set_InfoId_generador",
                        data: { sotr_id: generador.sotr_id, info_id: newInfoID },
                        success: function(resUpd){
                            if (resUpd === "ok") {
                                $("#cargar_tabla").load("<?php echo RESI; ?>/general/Generador/Listar_Generador");
                                alertify.success("Generador actualizado con éxito");
                                $("#modalEdit").modal('hide');
                                $('#tica_edit').select2('val', 'All');
                                $('#formGeneradoresEdit').data('bootstrapValidator').resetForm();
                                // resetear el form dinámico correctamente
                                if ($form.length) $form[0].reset();
                            } else {
                                alertify.error("Error al actualizar Generador con info_id");
                            }
                        },
                        error: function(){
                            alertify.error("Error al actualizar Generador con info_id");
                        }
                    });

                },
                error: function(){
                    wc();
                    alertify.error("Error al Actualizar Generador");
                }
            });
        }); 

//Funcion para elimiar generador 
function deletegenerador (){
    var elimina = new FormData();
        elimina = formToObject(elimina);
        elimina.sotr_id = $("#id_generador").val();
        elimina.eliminado = 1;
        console.table(elimina);
        wo();
        $.ajax({
                type: "POST",
                data: {elimina},
                url: "<?php echo RESI; ?>general/Generador/Eliminar_Generador",
                success: function (r) {
                    console.table(r);
                    if(r == "ok") {
                        wc();
                        $('#btndelete').hide();
                        $("#cargar_tabla").load("<?php echo RESI; ?>general/Generador/Listar_Generador");
                        alertify.success("Generador eliminado con éxito");
                        $("#modalBorrar").modal('hide');
                    } else {                     
                        wc();   
                        alertify.error("Error al eliminar Generador");
                        
                    }
                }
            });

}


function validaFormDinamico(formContainer) {

    // formContainer puede ser '.frm-new' o '.frm-edit-mode'
    var $dynForm = $(formContainer).find('form').first();
    if (!$dynForm.length) return true; // si no hay formulario dinámico, para adelante

    // Validar Evaluador
    var $eval = $dynForm.find('[name="evaluadores_resi"]');
    if ($eval.length) {
        var bv = $dynForm.data('bootstrapValidator');
        if (bv) {
            bv.validate();
            if (!bv.isValid()) {
                error('Error..', 'Debes completar los campos obligatorios del formulario dinámico (*)');
                return false;
            }
        } else if (!$eval.val()) {
            error('Error..', 'Seleccioná un Evaluador');
            return false;
        }
    }

    // Validar Consultor
    var $consultor = $dynForm.find('[name="consultor_resi"]');
    if ($consultor.length) {
        var bv = $dynForm.data('bootstrapValidator');
        if (bv) {
            bv.validate();
            if (!bv.isValid()) {
                error('Error..', 'Debes completar los campos obligatorios del formulario dinámico (*)');
                return false;
            }
        } else if (!$consultor.val()) {
            error('Error..', 'Seleccioná un Consultor');
            return false;
        }
    }

    var $email = $dynForm.find('[name="email"]');
    if ($email.length) {
        var bv = $dynForm.data('bootstrapValidator');
        if (bv) {
            bv.validate();
            if (!bv.isValid()) {
                error('Error..', 'Debes completar los campos obligatorios del formulario dinámico (*)');
                return false;
            }
        } else if (!$email.val()) {
            error('Error..', 'Seleccioná un email');
            return false;
        }
    }

      var $telefono = $dynForm.find('[name="telefono"]');
    if ($telefono.length) {
        var bv = $dynForm.data('bootstrapValidator');
        if (bv) {
            bv.validate();
            if (!bv.isValid()) {
                error('Error..', 'Debes completar los campos obligatorios del formulario dinámico (*)');
                return false;
            }
        } else if (!$telefono.val()) {
            error('Error..', 'Seleccioná un telefono');
            return false;
        }
    }

      var $expediente = $dynForm.find('[name="expediente"]');
    if ($expediente.length) {
        var bv = $dynForm.data('bootstrapValidator');
        if (bv) {
            bv.validate();
            if (!bv.isValid()) {
                error('Error..', 'Debes completar los campos obligatorios del formulario dinámico (*)');
                return false;
            }
        } else if (!$expediente.val()) {
            error('Error..', 'Seleccioná un expediente');
            return false;
        }
    }

    return true;
}


function validaRegistro(registro) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "GET",
            data: { registro: registro },
            url: "<?php echo RESI; ?>general/Generador/valida_registro", 
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

<!-- script que muestra box de datos al dar click en boton agregar -->
<script>
    $("#botonAgregar").on("click", function() {
        //crea un valor aleatorio entre 1 y 100 y se asigna al input nro
        var aleatorio = Math.round(Math.random() * (100 - 1) + 1);
        $("#nro").val(aleatorio);

        $("#botonAgregar").attr("disabled", "");
        //$("#boxDatos").removeAttr("hidden");
        $("#boxDatos").focus();
        $("#boxDatos").show();
    });
    $("#btnclose").on("click", function() {
        $('#tica_edit').select2('val', 'All');
                        $('#formGeneradoresEdit').data('bootstrapValidator').resetForm();
        $('#tica_id').select2('val', 'All');
        $("#boxDatos").hide(500);
        $("#botonAgregar").removeAttr("disabled");
        $('#formGeneradores').data('bootstrapValidator').resetForm();
        $("#formGeneradores")[0].reset();
        $('#formDatos').data('bootstrapValidator').resetForm();
        $("#formDatos")[0].reset();
        $('#selecmov').find('option').remove();
        $('#chofer').find('option').remove();
    });



    /* modal de impresion formulario generador con los datos*/
    function abrirModalGenerador() {
    // Tomamos los datos del formulario
    let razonSocial = $('#razon_social').val();
    let expediente   = $('#expediente').val();
    let registro     = $('#num_registro').val();

    // Fecha actual
    let fecha = new Date();
    let meses = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];
    let fechaTexto = fecha.getDate() + ' de ' + meses[fecha.getMonth()] + ' de ' + fecha.getFullYear();

    // Cargar datos en el modal
    $('#generador').text(razonSocial);
    $('#expedienteTexto').text("Expediente N°: " + expediente);
    $('#registro').text("Registro N°: " + registro + ", todo en concordancia con la Ley de Residuos Sólidos Urbanos N° 1114-L, Resolución N° 382-SEAyDS-2023 ");
    $('#fecha').text("Fecha: " + fechaTexto);

    // Mostrar modal
    $('#modalImpresion').modal('show');
}
</script>



<!--_____________________________________________________________-->

<!-- script Datatables -->
<script>
//Initialize Select2 Elements
$('.select3').select2();
    DataTable($('#tabla_generadores'))
</script>


