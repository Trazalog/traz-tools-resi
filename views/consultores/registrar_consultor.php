<div class="box box-primary animated fadeInLeft">
    <div class="box-header with-border">
        <h4>Registrar Consultores</h4>
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
        <form class="formConsultores" id="formConsultores" method="POST" autocomplete="off">
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h4 class="mb-3"><strong>Información Personal</strong></h4>
                    <br>
                </div>

                <!--Nombre -->
                <div class="col-md-6 col-sm-6 col-xs-12">
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
            
                <!--Registro-->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="registro">Nº de Registro:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-check"></i>
                            </div>
                            <input type="text" class="form-control" name="registro" id="registro">
                        </div>
                    </div>
                </div>

                <!--Profesión-->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="profesion">Profesión:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-check"></i>
                            </div>
                            <select class="form-control select2" name="profesion" id="profesion">
                                <option value="" disabled selected>-Seleccione opción-</option>
                                <?php foreach ($profesiones as $profesion): ?>
                                    <option value="<?= $profesion->tabl_id ?>"><?= $profesion->valor ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div> <!-- /.col-md-6 -->

                <!--Vigencia-->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="vigencia">Vigencia:</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </div>
                            <input type="date" class="form-control" name="vigencia" id="vigencia">
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
        <button type="submit" class="btn btn-primary pull-right" onclick="Guardar_Consultor(event)">
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
                <h5 class="modal-title titulo" id="exampleModalLabel">Editar Consultor</h5>
            </div>

            <div class="modal-body">
                <!--__________________ FORMULARIO MODAL __________________-->
                <form method="POST" autocomplete="off" id="formConsultoresEdit" class="registerForm">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="e_nombre_razon">Nombre y Apellido:</label>
                                    <input type="text" class="form-control habilitar" id="E_nombre" name="e_nombre">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="e_vigencia">Vigencia:</label>
                                    <input type="date" class="form-control habilitar" id="E_vigencia" name="e_vigencia">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ____________________________________________________________________________________________ -->
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="e_cuit">Registro:</label>
                                    <input type="text" class="form-control habilitar" id="E_registro" name="e_registro">
                                </div>
                                <div class="form-group">
                                    <label for="Telefono">Teléfono:</label>
                                    <input type="text" class="form-control habilitar" id="E_telefono" name="e_telefono">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                               <div class="form-group"> 
                                <label for="profesion" >Profesión:</label> 
                                    <br> 
                                    <select class="form-control select2 select2-hidden-accesible habilitar ocultar" id="E_profesion"name="e_profesion"> 
                                        <option value="" disabled selected>-seleccione opción-</option> 
                                            <?php foreach ($profesiones as $c) { echo '<option value="'.$c->tabl_id.'">'.$c->valor.'</option>'; } ?> 
                                    </select> 
                                    <input type="text" class="form-control mostrar" id="text_profesion" name="" style="display:none"> 
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
                <h5 class="modal-title" id="exampleModalLabel"> Eliminar Consultor</h5>
            </div>
            <input type="text" id="registro_consultor" style="display:none">
            <div class="modal-body">
            <center>
					<h4>
						<p>¿DESEA ELIMINAR EL CONSULTOR?</p>
					</h4>
			</center>
           

            <!--__________________ FIN FORMULARIO MODAL ___________________________-->

            </div>
            <div class="modal-footer">
                <center>
                    <button type="submit" class="btn btn-primary" id="btndelete" onclick="deleteConsultor()">SI</button>
                    <button type="submit" class="btn btn-default" id="btncancelar" data-dismiss="modal" id="cerrar">NO</button>
                </center>
            </div>
        </div>
    </div>
</div>

<script>

  $("#cargar_tabla").load("<?php echo RESI; ?>general/Consultor/Listar_Consultores");

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
    $('#formConsultores').bootstrapValidator({
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
            registro: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    }
                }
            },
            vigencia: {
                message: 'la entrada no es valida',
                validators: {
                        notEmpty: {
                        message: 'La fecha de vigencia no puede estar vacía'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'La fecha de vigencia no es válida'
                    }
                }
            },
            profesion: {
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

    /*  Script Bootstrap Validacion.FORMULARIO GENERAL */
    $('#formConsultoresEdit').bootstrapValidator({
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
            e_registro: {
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
            e_vigencia: {
                message: 'la entrada no es valida',
                validators: {
                        notEmpty: {
                        message: 'La fecha de vigencia no puede estar vacía'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'La fecha de vigencia no es válida'
                    }
                }
            },
            e_profesion: {
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

    async function Guardar_Consultor(event) { 
    event.preventDefault();

    let registro = $('#registro').val();
    wo();

    if ($("#formConsultores").data('bootstrapValidator').isValid()) {

        try {
             const existe = await validaRegistro(registro); 

            if (existe) {
                alertify.error("El N° de Registro ya se encuentra registrado");
                wc();
                return;
            }

            // Si no existe, continúa con el guardado
            var datos = new FormData($('#formConsultores')[0]);
            datos = formToObject(datos);

             $.ajax({
                url: "<?php echo RESI; ?>general/Consultor/Guardar_Consultor",
                type: "POST",
                data: {datos},
                success: function (respuesta) {
                    wc();
                    console.log(respuesta);
                    $("#cargar_tabla").load("<?php echo RESI; ?>general/Consultor/Listar_Consultores");
                    alertify.success("Evaluador agregado correctamente");
                    $('#formConsultores').data('bootstrapValidator').resetForm();
                    $("#formConsultores")[0].reset();
                },
                error: function (xhr, status, error) {
                    wc();
                    console.error("Error:", error);
                    alertify.error("Error al guardar el consultor");
                }
            });
            wc();
        } catch (error) {
            console.error(error);
            alertify.error("Error al validar el registro");
            wc();
        }

    } else {
        wc();
        alertify.error("Error: complete todos los datos");
        $('#formConsultores').data('bootstrapValidator').resetForm();
        $("#formConsultores")[0].reset();
    }
}


function validaRegistro(registro) {
    debugger;
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "GET",
            data: { registro: registro },
            url: "<?php echo RESI; ?>general/Consultor/valida_registro", 
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
                        $("#E_registro").val() !== "" &&
                        $("#E_telefono").val() !== "" &&
                        $("#E_profesion").val() !== "" &&
                        $("#E_vigencia").val() !== "" &&
                        $("#E_email").val() !== "";

        if (!requiredOk) return error("Error","Hay campos vacíos o mal ingresados");

        $('#formConsultoresEdit').bootstrapValidator('validate');

        if($("#formConsultoresEdit").data('bootstrapValidator').isValid()){

            wo();
            // Si no existe, continúa con el guardado
            var consultor = formToObject(new FormData());

            consultor.nombre = $("#E_nombre").val();
            consultor.registro = $("#E_registro").val();
            consultor.telefono = $("#E_telefono").val();
            consultor.profesion = $("#E_profesion").val();
            consultor.email = $("#E_email").val();
            consultor.vigencia = $("#E_vigencia").val();

             $.ajax({
                url: "<?php echo RESI; ?>general/Consultor/Actualizar_Consultor",
                type: "POST",
                data: {consultor},
                success: function (respuesta) {
                    wc();

                    if (respuesta != "ok") {
                        alertify.error("Error al Actualizar consultor");
                        $('#formConsultoresEdit').data('bootstrapValidator').resetForm();
                        return;
                    }
                    $("#cargar_tabla").load("<?php echo RESI; ?>general/Consultor/Listar_Consultores");
                    $("#modalEdit").modal('hide');
                    $('#formConsultoresEdit').data('bootstrapValidator').resetForm();
                    $("#formConsultoresEdit")[0].reset();
                    alertify.success("Consultor actualizado correctamente");
                },
                error: function (xhr, status, error) {
                    wc();
                    console.error("Error:", error);
                    alertify.error("Error al actualizar el consultor");
                }
            });
        }
 }); 



 //Funcion para elimiar consultor 
function deleteConsultor (){
    var elimina = new FormData();
        elimina = formToObject(elimina);
        elimina.registro = $("#registro_consultor").val();
        elimina.estado = true;
        console.table(elimina);
        wo();
        
            // Si no esta asociado, continúa con el eliminado
            $.ajax({
                type: "POST",
                data: {elimina},
                url: "<?php echo RESI; ?>general/Consultor/Eliminar_Consultor",
                success: function (r) {
                    console.table(r);
                    if(r == "ok") {
                        wc();
                        $('#btndelete').hide();
                        $("#cargar_tabla").load("<?php echo RESI; ?>general/Consultor/Listar_Consultores");
                        alertify.success("Consultor eliminado con éxito");
                        $("#modalBorrar").modal('hide');
                    } else {                     
                        wc();   
                        alertify.error("Error al eliminar Consultor");
                        
                    }
                }
            }); 

}

</script>