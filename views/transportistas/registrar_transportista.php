<!-- ocultar/eliminar el botón que guardar de el form dinámico -->
<style>
.frm-new .frm-save { display: none !important; }

    .edit-padding {
        padding-left: 0 !important;
        padding-right: 10px;
    }

</style>

<!--- HEADER --->
<div class="box box-primary animated fadeInLeft">
    <div class="box-header with-border">
            <h4>Registrar Transportista</h4>
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
<!--- FIN HEADER --->

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
    <!--_____________________________________________-->
    <div class="box-body">
        <form class="formTransportistas" id="formTransportistas" method="POST" autocomplete="off">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <!--Nombre / Razon social-->
                    <div class="form-group">
                            <label for="Nombre/Razon social" >Nombre / Razon social <strong class="text-danger"> *</strong>:</label>
                            <div class="input-group date"><div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                            <input type="text" class="form-control" name="razon_social" id="razon_social" required>
                            </div>
                    </div>
                <!--_____________________________________________-->

                 <!--cuit-->
                <div class="form-group">
                            <label for="Contacto" >Cuit <strong class="text-danger"> *</strong>:</label>
                            <div class="input-group date"><div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                            <input type="text" class="form-control" name="cuit" id="cuit" size="11" required>

                            </div>
                    </div>
                <!--_____________________________________________-->

                <!--Direccion-->
                    <div class="form-group">
                            <label for="Direccion">Domicilio <strong class="text-danger"> *</strong>:</label>
                            <div class="input-group date"><div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                            <input type="text" class="form-control"   name="direccion" id="direccion" required>
                            </div>
                    </div>
                <!--_____________________________________________-->

                <!--Telefono-->
                    <div class="form-group">
                        <label for="Telefono" >Teléfono <strong class="text-danger"> *</strong>:</label>
                        <div class="input-group date">
                            <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                            <input type="text" class="form-control"  name="telefono" id="telefono" required>
                        </div>
                    </div>
                <!--_____________________________________________-->

                <!--contacto-->
                    <div class="form-group">
                        <label for="Contacto" >Contacto:</label>
                        <div class="input-group date">
                            <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                            <input type="text" class="form-control" name="contacto" id="contacto">
                        </div>
                    </div>
                <!--_____________________________________________-->

                <!--email-->
                    <div class="form-group">
                        <label for="Email" >Email <strong class="text-danger"> *</strong>:</label>
                        <div class="input-group date">
                            <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                            <input type="text" class="form-control" name="email" id="email" required>
                        </div>
                    </div>
                <!--_____________________________________________-->
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">             
                <!--Resolucion-->
                <div class="form-group">
                        <label for="Resolucion" >N° Resolución <strong class="text-danger"> *</strong>:</label>
                        <div class="input-group date"><div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                        <input type="text" class="form-control"  name="resolucion" id="resolucion" required>
                        </div>
                </div>
                <!--_____________________________________________-->

                <!--Registro-->
                <div class="form-group">
                        <label for="Registro" >N° Registro <strong class="text-danger"> *</strong>:</label>
                        <div class="input-group date"><div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                        <input type="text" class="form-control" name="registro" id="registro" required>
                        </div>
                </div>
                    <!--_____________________________________________-->								
                <!--Tipo de residuo-->
                <div class="form-group">
                    <label for="tipoResiduos">Tipos de residuo <strong class="text-danger"> *</strong>:</label>
                    <div class="input-group date">
                        <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                        <select class="form-control select3" multiple="multiple"  data-placeholder="Seleccione tipo residuo"  style="width: 100%;"  id="tica_id" name="tica_id" required>                            
                                <?php
                                        foreach ($Rsu as $i) {     
                                                echo '<option  value="'.$i->tabl_id.'">'.$i->valor.'</option>';
                                        }
                                ?>
                        </select>            
                    </div>
                </div>				
                <!--_____________________________________________-->

                <!--Fecha de alta-->
									<div class="form-group">
											<label for="Fechalta"class="form-label label-sm">Fecha de alta <strong class="text-danger"> *</strong>:</label>                                              
											<div class="input-group date">
													<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
													</div>
													<input type="date" class="form-control pull-right"  name="fec_alta_efectiva"  id="fec_alta_efectiva" required>
											</div>  
									</div>
                <!--_____________________________________________-->

                <!--Fecha de baja-->
									<div class="form-group">
											<label for="Fechabaja" >Fecha de baja <strong class="text-danger"> *</strong>:</label>
											<div class="input-group date">
													<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
													</div>
													<input type="date" class="form-control pull-right" name="fec_baja_efectiva" id="fec_baja_efectiva" required>
											</div>
									</div>
                <!--_____________________________________________--> 
                
               
            </div>          

           <!--  <div class="col-md-12 col-sm-12 col-xs-12"><hr></div> -->

        </form>

        <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                        echo (!empty($form_id)) ? '<div class="frm-new" data-form="'.$form_id.'"></div>' : '<div class="frm-new" data-form="0"></div>';
                    ?>
                    <!-- Campo oculto para almacenar form_id -->
                    <input type="hidden" id="FormId" value="<?php echo $form_id; ?>">
        </div>

        <!--___________________BOTON GUARDAR__________________________-->
		<br>
			<button type="submit" class="btn btn-primary pull-right" onclick="Guardar_Transportista(event)">Guardar</button>
		<br>
		<!--___________________FIN BOTON GUARDAR__________________________-->

    </div>
	</div>
	</div>
<!--- FIN BOX 1 --->

<!--- BOX TABLA --->
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
<!--- FIN BOX TABLA --->

<!---///////--- MODAL EDITAR ---///////--->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
						<div class="modal-header bg-blue">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
								</button>
								<h5 class="modal-title titulo" id="exampleModalLabel">Editar Transportista</h5>
						</div>

						<div class="modal-body col-md-12 col-sm-12 col-xs-12">
							<!--__________________ FORMULARIO MODAL ___________________________-->
								<form method="POST" autocomplete="off" id="frm_transportista" class="registerForm">	

									<!-- Id de transportista y Usuario-->
										<div class="form-group">                                
											<input type="text" class="form-control habilitar" id="tran_id" name="tran_id" style="display:none;">
											<input type="text" class="form-control habilitar" id="usuario_app_edit" name="usuario_app" style="display:none;">
										</div>
									<!--______________________________-->

									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px;">

											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
												<!--Nombre/Razon social-->
														<div class="form-group">
															<label for="razon_social_edit" name="razon_social_edit">Razon social:</label>
															<input type="text" class="form-control habilitar" id="razon_social_edit" name="razon_social_edit" size="30%">
														</div>
												<!--___________________-->
											</div>
											<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
													<!--Registro-->
														<div class="form-group">
															<label for="registro_edit" name="registro_edit">Registro:</label>
															<input type="text" class="form-control habilitar" id="registro_edit" name="registro_edit" size="20%">
														</div>
													<!--____________________-->
											</div>

									</div>
									
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px;">
										<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
											<!--Direccion-->
											<div class="form-group">
												<label for="direccion_edit" name="direccion_edit">Direccion:</label>
												<input type="text" class="form-control habilitar" id="direccion_edit" name="direccion_edit" size="40%">
											</div>
											<!--_________________-->
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
											<!--Telefono-->
											<div class="form-group">
												<label for="telefono_edit" name="telefono_edit">Telefono:</label>
												<input type="text" class="form-control habilitar" id="telefono_edit" name="telefono_edit" size="40%">
											</div>											
											<!--________-->
										</div>	
									</div>

									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px;">
										<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
											<!--Fecha de alta-->
											<div class="form-group">
												<label for="fec_alta_edit" name="fec_alta_edit" class="form-label label-sm">Fecha de alta:</label>                                              
												<div class="input-group date">
														<div class="input-group-addon">
																<i class="fa fa-calendar"></i>
														</div>
														<input type="date" class="form-control habilitar pull-right" name="fec_alta_edit" id="fec_alta_edit">
												</div>																
											</div>											
											<!--_________-->
										</div>
									
									</div>	

									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px;">
										<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
											<!--Contacto-->
											<div class="form-group">
												<label for="contacto_edit" name="contacto_edit">Contacto:</label>
												<input type="text" class="form-control habilitar" id="contacto_edit" name="contacto_edit" >
											</div>	
											<!--________-->
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
											<!--Fecha baja-->
											<div class="form-group">
												<label for="fec_baja_efectiva_edit" name="fec_baja_efectiva_edit">Fecha de baja:</label>
												<div class="input-group date">
														<div class="input-group-addon">
																<i class="fa fa-calendar"></i>
														</div>
														<input type="date" class="form-control habilitar pull-right" name="fec_baja_efectiva_edit" id="fec_baja_efectiva_edit">
												</div>
											</div>														
											<!--_________-->
										</div>
									</div>	

									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px;">
										<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
											<!--Resolucion-->
											<div class="form-group">
												<label for="resolucion_edit" name="resolucion_edit">Resolucion:</label>
												<input type="text" class="form-control habilitar" id="resolucion_edit" name="resolucion_edit">
											</div>
										<!--__________-->
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
											<!-- Cuit -->
											<div class="form-group">
												<label for="cuit_edit" name="cuit_edit">Cuit:</label>
												<input type="text" class="form-control habilitar" id="cuit_edit" name="cuit_edit">
											</div>											
											<!--______-->
										</div>
									</div>										
									
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px;">
									
										<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
											<!-- Tipo de Residuos -->
												<div class="form-group oculta_edit">
													<label for="tica_edit">Tipos de residuo:</label>		
													<select class="form-control habilitar select4" multiple="multiple"  data-placeholder="Seleccione tipo residuo" id="tica_edit" style="width: 100%; !important" name="ticaedit">
														<?php
																		foreach ($Rsu as $i) {     
																				echo '<option  value="'.$i->tabl_id.'">'.$i->valor.'</option>';
																		}
																?>
													</select>
												</div>
												<div class="form-group oculta_info" style="display:none">
													<label for="tica_edit">Tipos de residuo:</label>		
													<select class="form-control habilitar select4" multiple="multiple" disabled  data-placeholder="Seleccione tipo residuo" id="tica_edit" style="width: 100%; !important">
														<?php
																		foreach ($Rsu as $a) {     
																				echo '<option  value="'.$a->tabl_id.'">'.$a->valor.'</option>';
																		}
																?>
													</select>
												</div>																
											<!--______-->
										</div>
									</div>
																		
								</form>

                                <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <?php
                                        echo (!empty($form_id)) ? '<div class="frm-new frm-edit" data-form="'.$form_id.'"></div>' : '<div class="frm-new" data-form="0"></div>';
                                    ?>
                                    <!-- Campo oculto para almacenar form_id -->
                                    <input type="hidden" id="FormIdEdit" value="<?php echo $form_id; ?>">
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
						<span aria-hidden="true" >&times;</span>
					</button>
					<h5 class="modal-title" id="exampleModalLabel"> Eliminar Transportista</h5>
				</div>
				<input id="transp_delete" style="display: none;">
				<div class="modal-body">
					<center>
					<h4><p>¿ DESEA ELIMINAR EL TRANSPORTISTA ?</p></h4>
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
<!---//////////////////////////////////////--- MODAL AMPLIAR DESCRIPCION ---///////////////////////////////////////////////////////-----> 
<div class="modal fade" id="modalVerDescAmpliada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
    <div class="modal-dialog" role="document"> 
        <div class="modal-content"> 
            <div class="modal-header bg-blue"> 
                <button type="button" class=" close btn-cerrar-modal" data-dismiss="modal" aria-label="Close" onclick="cerrar_Ampliar()"> 
                    <span aria-hidden="true">&times;</span> 
                </button> 
                <h5 class="modal-title" id="exampleModalLabel">Descripcion de Transportista</h5> 
            </div> 
            <div class="modal-body"> 
 
               <textarea name="" id="descrip" cols="30" rows="10" readonly></textarea>  
 
            </div> 
        </div> 
    </div> 
</div> 
 
<!---//////////////////////////////////////--- FIN MODAL DESCRIPCION ---///////////////////////////////////////////////////////-----> 

<!--- SCRIPTS --->
<script>
    detectarForm();
	initForm();

	// script habilitar panel de formulario agregar 
	$(".close").on("click", function() {
		$('#tica_edit').select2('val', 'All');
            $('#frm_transportista').data('bootstrapValidator').resetForm();
		});														
		$("#btnview").on("click", function() {
            $("#btnadd").removeClass("active");
            $("#btnview").addClass("active");
            $("#tablamodal").show();
            $("#formadd").hide();
            $("#btnsave").hide();
		});

		$("#btnadd").on("click", function() {
            $('.frm-new').addClass('edit-padding');
            $("#btnadd").addClass("active");
            $("#btnview").removeClass("active");
            $("#formadd").show();
            $("#tablamodal").hide();
            $("#btnsave").show();
		});
	
    $("#cargar_tabla").load("<?php echo RESI; ?>general/Transportista/Listar_Transportista");

    //Script Bootstrap Validacion.
    $('#formTransportistas').bootstrapValidator({
        message: 'Este valor no es válido',
        excluded: [':disabled'],
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            razon_social: {
                validators: {
                    notEmpty: {
                        message: 'El nombre o razón social no puede estar vacío'
                    },
                    regexp: {
                        regexp: /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s\.\-]+$/,
                        message: 'Solo se permiten letras, números y espacios'
                    }
                }
            },
            cuit: {
                validators: {
                    notEmpty: {
                        message: 'El CUIT no puede estar vacío'
                    },
                    regexp: {
                        regexp: /^[0-9]{11}$/,
                        message: 'El CUIT debe tener exactamente 11 dígitos numéricos'
                    }
                }
            },
            direccion: {
                validators: {
                    notEmpty: {
                        message: 'La dirección no puede estar vacía'
                    }
                }
            },
            telefono: {
                validators: {
                    notEmpty: {
                        message: 'El teléfono no puede estar vacío'
                    },
                    regexp: {
                        regexp: /^[0-9\s\+\-\(\)]+$/,
                        message: 'Ingrese un teléfono válido'
                    }
                }
            },
            contacto: {
                validators: {
                    regexp: {
                        regexp: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\.\-]*$/,
                        message: 'El contacto solo puede contener letras y espacios'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'El email no puede estar vacío'
                    },
                    emailAddress: {
                        message: 'Ingrese un correo electrónico válido'
                    }
                }
            },
            resolucion: {
                validators: {
                    notEmpty: {
                        message: 'El número de resolución es obligatorio'
                    },
                    regexp: {
                        regexp: /^[A-Za-z0-9\-\/]+$/,
                        message: 'Ingrese un número o código de resolución válido'
                    }
                }
            },
            registro: {
                validators: {
                    notEmpty: {
                        message: 'El número de registro es obligatorio'
                    },
                    regexp: {
                        regexp: /^[A-Za-z0-9\-\/]+$/,
                        message: 'Ingrese un número o código de registro válido'
                    }
                }
            },
            'tica_id[]': {
                selector: '#tica_id',
                validators: {
                    notEmpty: {
                        message: 'Debe seleccionar al menos un tipo de residuo'
                    }
                }
            },
            fec_alta_efectiva: {
                validators: {
                    notEmpty: {
                        message: 'La fecha de alta es obligatoria'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Ingrese una fecha válida (YYYY-MM-DD)'
                    }
                }
            },
            fec_baja_efectiva: {
                validators: {
                    notEmpty: {
                        message: 'La fecha de baja es obligatoria'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Ingrese una fecha válida (YYYY-MM-DD)'
                    }
                }
            }
        }
    });




	//guardar transportista	
    async function Guardar_Transportista(e) {    
        if (e && e.preventDefault) e.preventDefault(); 

        if (!validarFormularioTransportista()) {
            return; // Detiene el guardado si hay errores
        }

        var datos = new FormData($('#formTransportistas')[0]);
        datos = formToObject(datos);
        
        datos.usuario_app = "nachete"; //FIXME: - falta asignar funcion que asigne tipo usuario
        console.table(datos);

        //validacion Evaluador form dinamico
        if (!validaFormDinamico('.frm-new')) return;

        //necesito guardar descripcion porque la api crea en bonita la empresa con la descripcion
        datos.descripcion = $("#razon_social").val().trim();
		var tipocarga = $("#tica_id").val();

        const cuit = $('#cuit').val();
        const existe = await validaCuit(cuit);        

        if (existe) {
                alertify.error("El Cuit ya se encuentra registrado");
                wc();
                return;
            }

        if ($("#formTransportistas").data('bootstrapValidator').isValid()) {
			wo();
            $.ajax({
                type: "POST",
                data: {datos, tipocarga},
                url: "<?php echo RESI; ?>general/Transportista/Guardar_Transportista",
                success: async function (r) {
                    console.log(r);
                    const resp = JSON.parse(r);
                    if (resp.status == "ok") {
                        debugger;
                         // Guardado del formulario dinamico
                            idFormDinamico = "#"+$('.frm-new').find('form').attr('id');

                            if(idFormDinamico != "#undefined"){
   
                                var newInfoID = await frmGuardarConPromesa($(idFormDinamico));
                            }

                            if(newInfoID){
                                 $.ajax({
                                type: "POST",
                                url: "<?php echo RESI; ?>general/Transportista/set_InfoId_transportista",
                                data: { tran_id: resp.tran_id, info_id: newInfoID },
                                success: function (res) {
                                    if (res === "ok") {
                                        wc();
                                        $("#cargar_tabla").load("<?php echo RESI; ?>general/Transportista/Listar_Transportista");
                                        alertify.success("Transportista Agregado con exito");
                                        $('#tica_id').select2('val', 'All');
                                        $('#formTransportistas').data('bootstrapValidator').resetForm();
                                        $("#formTransportistas")[0].reset();                       
                                        $("#boxDatos").hide(500);
                                        $("#botonAgregar").removeAttr("disabled");

                                        $("#botonAgregar").removeAttr("disabled"); 
                                    } else {
                                        wc();
                                        alertify.error("Error al actualizar Generador con info_id");
                                    }
                                }
                            });
                            }
						wc();
                    } else {
                        //console.log(r);
						wc();
                        alertify.error("Error al Agregar Transportista");
                    }
                }
            });
        }else{
			alert("ATENCION!!! Hay campos Vacios o Mal Ingresados");
		}
    }

    

    function validaCuit(cuit) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: "GET",
                data: { cuit: cuit },
                url: "<?php echo RESI; ?>general/Transportista/valida_cuit", 
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

	//boton guardar
		$("#btnsave").on("click", async function() {
			//tomo datos del form y hago objeto
			
			var transportista = new FormData($('#frm_transportista')[0]);
			console.table( transportista);
			transportista = formToObject(transportista);
            
            // Mapear los nombres de campos
            var transportista = {
                tran_id: transportista.tran_id,
                usuario_app: transportista.usuario_app || "nachete",
                razon_social: transportista.razon_social_edit,
                registro: transportista.registro_edit,
                direccion: transportista.direccion_edit,
                telefono: transportista.telefono_edit,
                fec_alta: transportista.fec_alta_edit,
                contacto: transportista.contacto_edit,
                fec_baja_efectiva: transportista.fec_baja_efectiva_edit,
                resolucion: transportista.resolucion_edit,
                cuit: transportista.cuit_edit,
                descripcion: transportista.descripcion_edit || "" // Campo requerido
            };

            console.table(transportista);

            // Validación MEJORADA (reemplaza el "código judas")
            var camposRequeridos = [
                'razon_social', 'registro', 'direccion', 'telefono', 
                'fec_alta', 'fec_baja_efectiva', 'resolucion', 'cuit'
            ];
            
            var camposVacios = [];
            var esValido = true;

            // Validar campos requeridos
            camposRequeridos.forEach(function(campo) {
                if (!transportista[campo] || transportista[campo].toString().trim() === '') {
                    camposVacios.push(campo);
                    esValido = false;
                }
            });

            // Validar select múltiple
            var tipo_carga = $("#tica_edit").val();
            if (!tipo_carga || tipo_carga.length === 0) {
                esValido = false;
                camposVacios.push('tipos_residuo');
            }

            if (!esValido) {
                alertify.error("Campos obligatorios vacíos: " + camposVacios.join(', '));
                return;
            }


            
			   //codigo judas se hizo a las apuradas pero hay que optimizarlo XD
			   /* var aux =0;
				if(transportista.contacto != "")
				{
					if(transportista.cuit != "")
					{
						if(transportista.descripcion != "")
						{
							if(transportista.direccion != "")
							{
								if(transportista.fec_alta != "")
								{
									if( transportista.fec_baja_efectiva != "")
									{
										if(transportista.razon_social != "")
										{
											if(transportista.registro != "")
											{
												if( transportista.resolucion != "")
												{
													if(transportista.telefono != "")
													{
														if(transportista.tran_id != "")
														{
															if($("#tica_edit").val() != "")
															{
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
				} */
				//fin codigo judas

			var tipo_carga = $("#tica_edit").val();		
			
				$("#frm_transportista")[0].reset();
					wo();
				 	$.ajax({
							type: "POST",
							data: {transportista, tipo_carga},
							url: "<?php echo RESI; ?>general/Transportista/Modificar_Transportista",
							success: async function (result) {
								if(result == "error_transportista"){
									wc();
									alertify.error("Error al Actualizar Transportista");
								
									
                        			       
								}else{
                                    var $dynContainer = $("#modalEdit").find('.frm-new.frm-edit');

                                    var $form = $dynContainer.is('form') ? $dynContainer : $dynContainer.find('form').first();
                                    // Llamar a nuestra nueva función corregida
                                    newInfoID = await editarFormulario($form);

                                    if(newInfoID){
                                            $.ajax({
                                            type: "POST",
                                            url: "<?php echo RESI; ?>general/Transportista/set_InfoId_transportista",
                                            data: { tran_id: transportista.tran_id, info_id: newInfoID },
                                            success: async function (res) {
                                                if (res === "ok") {
                                                    wc();
                                                    $('#tica_edit').select2('val', 'All');
                                                    
                                                    $('#frm_transportista').data('bootstrapValidator').resetForm();
                                                    $("#cargar_tabla").load("<?php echo RESI; ?>general/Transportista/Listar_Transportista");
                                                    alertify.success("Transportista Actualizado con exito");
                                                    
                                                
                                                                        
                                                    $("#modalEdit").hide(500);
                                                } else {
                                                    wc();
                                                    alertify.error("Error al actualizar Generador con info_id");
                                                }
                                            }
                                        });
                                    }
								}	
							}
					});
	
		});	

		//elimina transp y recarga la tabla
		function eliminar(){
			var tran_id = $("#transp_delete").val();
			wo();
			$.ajax({
					type: "POST",
					data: {tran_id:tran_id},
					url: "<?php echo RESI; ?>general/Transportista/Borrar_Transportista",
					success: function(result) {
						wc();
						$("#cargar_tabla").load("<?php echo RESI; ?>general/Transportista/Listar_Transportista");
						$("#modalaviso").modal('hide');
						alertify.success("Transportista Eliminado con exito");
					},
					error: function(result){
						wc();
						$("#modalaviso").modal('hide');
						alertify.success("Error al Eliminar Transportista");
					}
			});
		}

	//script que muestra box de datos al dar click en boton agregar	
    $("#botonAgregar").on("click", function() {      

        $("#botonAgregar").attr("disabled", "");
        //$("#boxDatos").removeAttr("hidden");
        $("#boxDatos").focus();
        $("#boxDatos").show();

    });

	//modal ojo ampliar descripcion 
	function ampliarDesc () 
	{ 
		$("#modalEdit").modal("hide"); 
		$("#modalVerDescAmpliada").modal("show"); 
		var valor = $("#descripcion_edit").val(); 
		$("#descrip").val(valor); 
     
	} 
	function cerrar_Ampliar()
	{ 
		$("#modalVerDescAmpliada").modal("hide"); 
		$("#modalEdit").modal("show"); 
    } 

	//cierra box de datos
    $("#btnclose").on("click", function() {
		$('#tica_id').select2('val', 'All');
        $('#formTransportistas').data('bootstrapValidator').resetForm();
        $("#formTransportistas")[0].reset();                       
        $("#boxDatos").hide(500);
        $("#botonAgregar").removeAttr("disabled");
        $('#formDatos').data('bootstrapValidator').resetForm();
        $("#formDatos")[0].reset();
        $('#selecmov').find('option').remove();
        $('#chofer').find('option').remove();
    });

	

	$('#frm_transportista').bootstrapValidator({
        message: 'This value is not valid',
        /*feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },*/
        //excluded: ':disabled',
        fields: {
            razon_social_edit: {
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
            descripcion_edit: {
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
            direccion_edit: {
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
            telefono_edit: {
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
            contacto_edit: {
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
            cuit_edit: {
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
            resolucion_edit: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                    
                }
            },
           
            registro_edit: {
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
            fec_alta_edit: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                }
            },
            fec_baja_efectiva_edit: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                }
            },
           
			ticaedit: {
                message: 'la entrada no es valida',
                validators: {
                    notEmpty: {
                        message: 'la entrada no puede ser vacia'
                    },
                }
            }
        }
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        //guardar();
    });
	
	// este script me permite limpiar la validacion una vez cerrado el modal
    $("#modalEdit").on("hidden.bs.modal", function (e) {
        $("#frm_transportista").data('bootstrapValidator').resetForm();
    });

	// script Datatables 
		DataTable($('#tabla_transportistas'));	

	// Initialize Select2 Elements
		$('.select3').select2();

/* no funca bootstrapValidator  */
function validarFormularioTransportista() {
    const razon_social = $("#razon_social").val().trim();
    const cuit = $("#cuit").val().trim();
    const direccion = $("#direccion").val().trim();
    const telefono = $("#telefono").val().trim();
    const email = $("#email").val().trim();
    const resolucion = $("#resolucion").val().trim();
    const registro = $("#registro").val().trim();
    const tipo_residuo = $("#tica_id").val();
    const fec_alta = $("#fec_alta_efectiva").val();
    const fec_baja = $("#fec_baja_efectiva").val();

    if (!razon_social) {
        alertify.error("Debe ingresar el nombre o razón social");
        $("#razon_social").focus();
        return false;
    }
    if (!cuit) {
        alertify.error("Debe ingresar el CUIT");
        $("#cuit").focus();
        return false;
    }
    if (!/^\d{11}$/.test(cuit)) {
        alertify.error("El CUIT debe tener 11 dígitos numéricos");
        $("#cuit").focus();
        return false;
    }
    if (!direccion) {
        alertify.error("Debe ingresar el domicilio");
        $("#direccion").focus();
        return false;
    }
    if (!telefono) {
        alertify.error("Debe ingresar un teléfono");
        $("#telefono").focus();
        return false;
    }
    if (!email) {
        alertify.error("Debe ingresar un email");
        $("#email").focus();
        return false;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        alertify.error("El formato del email no es válido");
        $("#email").focus();
        return false;
    }
    if (!resolucion) {
        alertify.error("Debe ingresar el número de resolución");
        $("#resolucion").focus();
        return false;
    }
    if (!registro) {
        alertify.error("Debe ingresar el número de registro");
        $("#registro").focus();
        return false;
    }
    if (!tipo_residuo || tipo_residuo.length === 0) {
        alertify.error("Debe seleccionar al menos un tipo de residuo");
        $("#tica_id").focus();
        return false;
    }
    if (!fec_alta) {
        alertify.error("Debe ingresar la fecha de alta");
        $("#fec_alta_efectiva").focus();
        return false;
    }
    if (!fec_baja) {
        alertify.error("Debe ingresar la fecha de baja");
        $("#fec_baja_efectiva").focus();
        return false;
    }
    if (fec_baja < fec_alta) {
        alertify.error("La fecha de baja no puede ser anterior a la fecha de alta");
        $("#fec_baja_efectiva").focus();
        return false;
    }

    return true; 
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

    return true;
}
</script>