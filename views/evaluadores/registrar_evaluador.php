<div class="box box-primary animated fadeInLeft">
    <div class="box-header with-border">
        <h4>Registrar Evaluadores</h4>
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

<!---//////////////////////////////////////--- BOX AGREGAR ---///////////////////////////////////////////////////////----->

<div class="box box-primary animated bounceInDown" id="boxDatos" hidden>
    <div class="box-header with-border">
        <div class="box-tittle">
            <h5>Informacion</h5>
        </div>
        <div class="box-tools pull-right">
            <button type="button" id="btnclose" title="cerrar" class="btn btn-box-tool" data-widget="remove"
                data-toggle="tooltip" data-original-title="Remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>

    <div class="box-body">
        <form class="formEvaluadores" id="formEvaluadores" method="POST" autocomplete="off">
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h4 class="mb-3"><strong>Información Personal</strong></h4>
                    <br>
                </div>

                <!--Nombre -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label for="nombre_apellido">Nombre y Apellido:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-check"></i>
                            </div>
                            <input type="text" class="form-control" name="nombre" id="nombre">
                        </div>
                    </div>
                </div>
            
                <!--DNI-->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="dni">DNI:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-check"></i>
                            </div>
                            <input type="text" class="form-control" name="dni" id="dni">
                        </div>
                    </div>
                </div>

                <!--Formacion-->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="formacion_id">Formacion:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-check"></i>
                            </div>
                            <select class="form-control select2" name="formacion" id="formacion">
                                <option value="" disabled selected>-Seleccione opción-</option>
                                <?php foreach ($formaciones as $formacion): ?>
                                    <option value="<?= $formacion->tabl_id ?>"><?= $formacion->valor ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div> <!-- /.col-md-6 -->

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h4 class="mb-3"><strong>Información de Contacto</strong></h4>
                    <br>
                </div>

                <!--Telefono-->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-check"></i>
                            </div>
                            <input type="text" class="form-control" name="telefono" id="telefono">
                        </div>
                    </div>
                </div>

                <!--Email-->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-check"></i>
                            </div>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                    </div>
                </div> <!-- /.col-md-6 -->
            </div> <!-- /.row -->
        </form>
        <br>
        <button type="submit" class="btn btn-primary pull-right" onclick="Guardar_Evaluador(event)">
            Guardar
        </button>
    </div>
</div>
<!---//////////////////////////////////////--- BOX AGREGAR ---///////////////////////////////////////////////////////----->


<!---//////////////////////////////////////--- MODAL EDITAR ---///////////////////////////////////////////////////////----->

    
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title titulo" id="exampleModalLabel">Editar Evaluador</h5>
            </div>

            <div class="modal-body">
                <!--__________________ FORMULARIO MODAL __________________-->
                <form method="POST" autocomplete="off" id="formEvaluadoresEdit" class="registerForm">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="e_nombre_razon">Nombre y Apellido:</label>
                                    <input type="text" class="form-control habilitar" id="E_nombre" name="e_nombre">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ____________________________________________________________________________________________ -->
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="e_cuit">DNI:</label>
                                    <input type="text" class="form-control habilitar" id="E_dni" name="e_dni">
                                </div>
                                <div class="form-group">
                                    <label for="Telefono">Teléfono:</label>
                                    <input type="text" class="form-control habilitar" id="E_telefono" name="e_telefono">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                               <div class="form-group"> 
                                <label for="Formacion" >Formacion:</label> 
                                    <br> 
                                    <select class="form-control select2 select2-hidden-accesible habilitar ocultar" id="E_formacion"name="e_formacion"> 
                                        <option value="" disabled selected>-seleccione opción-</option> 
                                            <?php foreach ($formaciones as $c) { echo '<option value="'.$c->tabl_id.'">'.$c->valor.'</option>'; } ?> 
                                    </select> 
                                    <input type="text" class="form-control mostrar" id="text_evaluador" name="" style="display:none"> 
                                </div>
                                <div class="form-group">
                                    <label for="e_email">Email:</label>
                                    <input type="text" class="form-control habilitar" id="E_email" name="e_email">  
                                </div>
                            </div>

                        </div>
                    </div>

                </form>
                <!--__________________ FIN FORMULARIO MODAL __________________-->
            </div>

            <div class="modal-footer">
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary" id="btnsave_e">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>
</div>

<!---//////////////////////////////////////--- FIN MODAL EDITAR ---///////////////////////////////////////////////////////----->


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


<!---//////////////////////////////////////--- MODAL BORRAR ---///////////////////////////////////////////////////////----->
    
<div class="modal fade" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel"> Eliminar Evaluador</h5>
            </div>
            <input type="text" id="dni_evaluador" style="display:none">
            <div class="modal-body">
            <center>
					<h4>
						<p>¿DESEA ELIMINAR EL EVALUADOR?</p>
					</h4>
			</center>
           

            <!--__________________ FIN FORMULARIO MODAL ___________________________-->

            </div>
            <div class="modal-footer">
                <center>
                    <button type="submit" class="btn btn-primary" id="btndelete" onclick="deleteEvaluador()">SI</button>
                    <button type="submit" class="btn btn-default" id="btncancelar" data-dismiss="modal" id="cerrar">NO</button>
                </center>
            </div>
        </div>
    </div>
</div>


<!---//////////////////////////////////////--- FIN MODAL BORRAR ---///////////////////////////////////////////////////////----->

<!-- script que muestra box de datos al dar click en boton agregar -->
<script>

    $("#cargar_tabla").load("<?php echo RESI; ?>general/Evaluador/Listar_Evaluadores");


    /* acciones boton agregar */
    $("#botonAgregar").on("click", function() {
       
        $("#botonAgregar").attr("disabled", "");
        $("#boxDatos").focus();
        $("#boxDatos").show();
    });
    $("#btnclose").on("click", function() {
        $("#boxDatos").hide(500);
        $("#botonAgregar").removeAttr("disabled");
    });

/*  Script Bootstrap Validacion.FORMULARIO GENERAL */
    $('#formEvaluadores').bootstrapValidator({
        message: 'This value is not valid',
        /*feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },*/
        //excluded: ':disabled',
        fields: {
            nombre: {
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
            dni: {
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
            formacion: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'El email no puede estar vacío'
                    },
                    emailAddress: {
                        message: 'La dirección de correo no es válida'
                    }
                }
            },
            telefono: {
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
            }
        }
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        //guardar();
    });

/*  Script Bootstrap Validacion.FORMULARIO GENERAL editar */
    $('#formEvaluadoresEdit').bootstrapValidator({
        message: 'This value is not valid',
        /*feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },*/
        //excluded: ':disabled',
        fields: {
            e_nombre: {
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
            e_dni: {
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
            e_formacion: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            e_email: {
                validators: {
                    notEmpty: {
                        message: 'El email no puede estar vacío'
                    },
                    emailAddress: {
                        message: 'La dirección de correo no es válida'
                    }
                }
            },
            e_telefono: {
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
            }
        }
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        //guardar();
    });    


async function Guardar_Evaluador(event) { 
    event.preventDefault();

    wo();

    if ($("#formEvaluadores").data('bootstrapValidator').isValid()) {
        let dni = $('#dni').val();

        try {
            const existe = await validaDni(dni); 

            if (existe) {
                alertify.error("El DNI ya se encuentra registrado");
                wc();
                return;
            }
            // Si no existe, continúa con el guardado
            var datos = new FormData($('#formEvaluadores')[0]);
            datos = formToObject(datos);

             $.ajax({
                url: "<?php echo RESI; ?>general/Evaluador/Guardar_Evaluador",
                type: "POST",
                data: {datos},
                success: function (respuesta) {
                    wc();
                    console.log(respuesta);
                    $("#cargar_tabla").load("<?php echo RESI; ?>general/Evaluador/Listar_Evaluadores");
                    alertify.success("Evaluador agregado correctamente");
                    $('#formEvaluadores').data('bootstrapValidator').resetForm();
                    $("#formEvaluadores")[0].reset();
                },
                error: function (xhr, status, error) {
                    wc();
                    console.error("Error:", error);
                    alertify.error("Error al guardar el evaluador");
                }
            });
            wc();

        } catch (error) {
            console.error(error);
            alertify.error("Error al validar el DNI");
            wc();
        }

    } else {
        wc();
        alertify.error("Error: complete todos los datos");
        $('#formEvaluadores').data('bootstrapValidator').resetForm();
        $("#formEvaluadores")[0].reset();
    }
}


function validaDni(dni) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "GET",
            data: { dni: dni },
            url: "<?php echo RESI; ?>general/Evaluador/valida_dni", 
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

// Funcion Guardar lo que se edito del modal Edit
 $("#btnsave_e").click(function(e){ 
    e.preventDefault();

     // validación rápida
        var requiredOk =$("#E_nombre").val() !== "" &&
                        $("#E_dni").val() !== "" &&
                        $("#E_telefono").val() !== "" &&
                        $("#E_formacion").val() !== "" &&
                        $("#E_email").val() !== "";

        if (!requiredOk) return error("Error","Hay campos vacíos o mal ingresados");

        $('#formEvaluadoresEdit').bootstrapValidator('validate');

        if($("#formEvaluadoresEdit").data('bootstrapValidator').isValid()){

            wo();
            // Si no existe, continúa con el guardado
            var evaluador = formToObject(new FormData());

            evaluador.nombre = $("#E_nombre").val();
            evaluador.dni = $("#E_dni").val();
            evaluador.telefono = $("#E_telefono").val();
            evaluador.formacion = $("#E_formacion").val();
            evaluador.email = $("#E_email").val();

             $.ajax({
                url: "<?php echo RESI; ?>general/Evaluador/Actualizar_Evaluador",
                type: "POST",
                data: {evaluador},
                success: function (respuesta) {
                    wc();

                    if (respuesta != "ok") {
                        alertify.error("Error al Actualizar Evaluador");
                        $('#formEvaluadoresEdit').data('bootstrapValidator').resetForm();
                        return;
                    }
                    $("#cargar_tabla").load("<?php echo RESI; ?>general/Evaluador/Listar_Evaluadores");
                    $("#modalEdit").modal('hide');
                    $('#formEvaluadoresEdit').data('bootstrapValidator').resetForm();
                    $("#formEvaluadoresEdit")[0].reset();
                    alertify.success("Evaluador actualizado correctamente");
                },
                error: function (xhr, status, error) {
                    wc();
                    console.error("Error:", error);
                    alertify.error("Error al actualizar el evaluador");
                }
            });
        }
 }); 


 //Funcion para elimiar evaluador 
async function deleteEvaluador (){
    var elimina = new FormData();
        elimina = formToObject(elimina);
        elimina.dni = $("#dni_evaluador").val();
        elimina.estado = true;
        console.table(elimina);
        wo();
        try {
            const asociado = await validaEvaluadorAsosiado(elimina.dni); 

            if (asociado && asociado.length > 0) {
                const razones = asociado.map(a => `• ${a.razon_social}`).join("<br>");
                alertify.error(
                    `No se puede eliminar el evaluador porque está asociado a:<br>${razones}`
                );
                wc();
                $("#modalBorrar").modal('hide');
                return;
            }
            // Si no esta asociado, continúa con el eliminado
            $.ajax({
                type: "POST",
                data: {elimina},
                url: "<?php echo RESI; ?>general/Evaluador/Eliminar_Evaluador",
                success: function (r) {
                    console.table(r);
                    if(r == "ok") {
                        wc();
                        $('#btndelete').hide();
                        $("#cargar_tabla").load("<?php echo RESI; ?>general/Evaluador/Listar_Evaluadores");
                        alertify.success("Evaluador eliminado con éxito");
                        $("#modalBorrar").modal('hide');
                    } else {                     
                        wc();   
                        alertify.error("Error al eliminar Evaluador");
                        
                    }
                }
            }); 
            wc();

        } catch (error) {
            console.error(error);
            alertify.error("Error al validar si el evaluador está asociado");
            wc();
        }

}

// valida antes de eliminar si el evaluador esta asociado a algun solicitante_transporte
function validaEvaluadorAsosiado(dni) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "POST",
            data: { dni: dni },
            url: "<?php echo RESI; ?>general/Evaluador/Validar_Evaluador_Asociado",
            success: function (response) {

                try {
                    if (response === 'error') {
                        resolve(null);
                        return;
                    }
                    // Parseamos el string JSON
                    const datos = JSON.parse(response);
                    
                    // Si no hay registros, devolvemos null


                    // Devolvemos directamente los valores (puede ser array de objetos)
                    resolve(datos);
                } catch (err) {
                    reject("Error al parsear la respuesta JSON: " + err);
                }
            },
            error: function (xhr, status, error) {
                reject(error);
            }
        });
    });
}
                   

</script>