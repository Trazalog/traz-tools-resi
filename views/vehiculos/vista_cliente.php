<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRAZALOG | TOOLS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Manifest para el desarrollo de la PWA -->
    <link rel="manifest" crossorigin="use-credentials" href="<?php echo base_url();?>manifest.json">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url();?>lib/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>lib/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>lib/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>lib/dist/css/AdminLTE.min.css">
    <!-- css tabla scroll dispositivo movil -->
    <link rel="stylesheet" href="<?php echo base_url();?>lib/table-scroll.css">

    <!-- css sweetalert -->
    <link rel="stylesheet" href="<?php echo base_url();?>lib/sweetalert/sweetalert.css">
    <!-- Estilos case image + vista previa -->
    <link rel="stylesheet" href="<?php echo base_url();?>lib/imageForms/styleImgForm.css">
    
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>lib/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>lib/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet"
        href="<?php echo base_url()?>lib/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

        <!-- Select2 -->
        <link rel="stylesheet" href="<?php echo base_url()?>lib/bower_components/select2/dist/css/select2.min.css">

        
    <link rel="stylesheet" href="<?php echo base_url() ?>lib/bower_components/select2/dist/css/boostrap.css">



    <link rel="stylesheet" href="<?php echo base_url()?>lib/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" href="<?php echo base_url()?>lib/bower_components/bootstrap-daterangepicker/daterangepicker.css">

    <!-- Bootstrap datetimepicker -->
    <link rel="stylesheet" href="<?php echo base_url();?>lib/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url();?>lib/plugins/iCheck/all.css">

    <link rel="stylesheet" href="<?php echo base_url();?>lib/bootstrapValidator/bootstrapValidator.min.css" />

    <!-- alertifyjs -->

    <link rel="stylesheet" href="<?php  echo base_url();?>lib/alertify/css/alertify.css">
    <link rel="stylesheet" href="<?php  echo base_url();?>lib/alertify/css/themes/bootstrap.css">

    <!-- animate.css -->

    <link rel="stylesheet" href="<?php  echo base_url();?>lib/animate/animate.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="<?php echo base_url() ?>lib/swal/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>lib\timepicker\jquery.timepicker.min.css">

    <link href='<?php  echo base_url();?>assets/fullcalendar/lib/main.min.css' rel='stylesheet' />

    <!-- Lupa imagenes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnify/2.3.3/css/magnify.css" integrity="sha512-JxBFHHd+xyHl++SdVJYCCgxGPJKCTTaqndOl/n12qI73hgj7PuGuYDUcCgtdSHTeXSHCtW4us4Qmv+xwPqKVjQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- jQuery -->
    <script src="<?php echo base_url();?>lib/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="<?php echo base_url();?>lib/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Alertify (si lo usás) -->
    <script src="<?php echo base_url();?>lib/alertify/alertify.js"></script>

    <!-- props propios -->
    <script src="<?php echo base_url(); ?>lib/props/navegacion.js"></script>


    <style>
        #btnImprimir {
            display: none;
        }
    </style>

</head>
<body class="hold-transition skin-red sidebar-mini">
    <div class="box box-primary" id="view_cliente">
        <div class="box-header with-border">
            <h4 class="box-title">Información Orden de Transporte</h4>
        </div>

        <div class="box-body" id="mdl-vista">

            <input type="hidden" id="sotr_id" value="<?= $dataOt[0]->sotr_id ?>">
            <input type="hidden" id="tran_id" value="<?= $dataOt[0]->tran_id ?>">
            <input type="hidden" id="ortr_id" value="<?= $dataOt[0]->ortr_id ?>">
            <input type="hidden" id="fec_alta" value="<?= $dataOt[0]->fec_alta ?>">
            <input type="hidden" id="nombre" value="<?= $dataOt[0]->nombre ?>">
            <input type="hidden" id="apellido" value="<?= $dataOt[0]->apellido ?>">
            <input type="hidden" id="registroEquipo" value="<?= $dataOt[0]->registroEquipo ?>">
            <input type="hidden" id="registroChoferEquipo" value="<?= $dataOt[0]->registroChofer ?>">
            <input type="hidden" id="dominio" value="<?= $dataOt[0]->dominio ?>">
            <input type="hidden" id="difi_descripcion" value="<?= $dataOt[0]->difi_descripcion ?>">
            <input type="hidden" id="difi_registro" value="<?= $dataOt[0]->difi_registro ?>">
            <input type="hidden" id="difi_cuil" value="<?= $dataOt[0]->difi_cuil ?>">
            <input type="hidden" id="tara" value="<?= $dataOt[0]->tara ?>">





            <!-- TRAIGO LA VISTA DE LAS ORDENES DE TRANSPORTE -->
            <?php $this->load->view(RESI . 'ordenes/mdl_orden_transporte'); ?>

        </div>
    </div>



    <script>



    function verPedido() {
        wo();
             $.ajax({
                type: "POST",
                data: {sotr_id: $('#sotr_id').val(), tran_id: $('#tran_id').val(), ortr_id: $('#ortr_id').val()},
                dataType: 'json',
                url: "<?php echo base_url(RESI); ?>estructura/Ordentransporte/dataDetalleOT",
                success: function (respuesta) {
                    console.log(respuesta);
                    var resp = respuesta;
                    /* DATA CABECERA */
                        $("#ordenTransporte").val($('#ortr_id').val());

                        const fecAlta = $('#fec_alta').val();
                        const fechaSolo = fecAlta.split('T')[0];   
                        $("#fechaOrden").val(fechaSolo);
                        const horaMinutos = fecAlta.substring(11, 16);
                        $("#horaEgreso").val(horaMinutos);
                    
                    /* FIN DATA CABECERA */

                    
                    /* DATA GENERADOR/SOLICITANTE TRANSPORTE */
                        $("#nombre_generador").val(resp.solicitante_transporte[0].razon_social);
                        $("#cuit_generador").val(resp.solicitante_transporte[0].cuit);
                        $("#registro_generador").val(resp.solicitante_transporte[0].num_registro);

                        //si es municipio muestra campos adicionales
                        tipoGenerador = resp.solicitante_transporte[0].tist_id;
                        if(tipoGenerador == "tipo_generadorMunicipio"){
                            $(".esMunicipio").removeAttr("style");
                            $("#zona_generador").val(resp.solicitante_transporte[0].zona);
                            $("#municipio_generador").val(resp.solicitante_transporte[0].municipio);  
                            $("#circuito_generador").val(resp.solicitante_transporte[0].zona);   
                    
                        }
                        else{
                            $(".esMunicipio").attr("style","display:none"); 
                        }
                    /* FIN DATA GENERADOR/SOLICITANTE TRANSPORTE */


                    /* DATA TRANSPORTISTA */

                        $("#nombre_empresaTransportista").val(resp.transportista.razon_social);
                        $("#cuitTransportista").val(resp.transportista.cuit);
                        $("#registroTransportista").val(resp.transportista.registro);
                    /* FIN DATA TRANSPORTISTA */


                    /* DATA SITIO DE DISPOSICION FINAL */

                        $("#nombre_empresaDisposicionFinal").val($('#difi_descripcion').val());
                        $("#cuitDisposicionFinal").val($('#difi_cuil').val());
                        $("#registroDisposicionFinal").val($('#difi_registro').val());
                        
                    /* FIN DATA SITIO DE DISPOSICION FINAL */


                    /* DATA DATOS DE LA ORDEN DE TRANSPORTE */
                        $("#vehiculoDominioTraslado").val($('#dominio').val());
                        $("#registroOrdenTransporte").val($('#registroEquipo').val());
                        $("#taraOrdenTransporte").val($('#tara').val());

                        let chofer = $('#nombre').val().concat( " ", $('#apellido').val());
                        $("#nombreApellidoChofer").val(chofer);
                        $("#registroChofer").val($('#registroChoferEquipo').val());

                    /* FIN DATOS DE LA ORDEN DE TRANSPORTE */


                     /* DATOS DE LA TABLA CONTENEDORES */

                        tbody = document.getElementById("tbodyContenedores");
                        tbody.innerHTML = ""; // limpiamos por las dudas

                        if(!resp.contenedores){
                            tbody.innerHTML = `
                                <tr>
                                    <td colspan="4" style="text-align:center;">No hay contenedores asignados a esta orden de transporte.</td>
                                </tr>
                            `;
                        }
                        else{
                            resp.contenedores.forEach(item => {
                                tbody.innerHTML += `
                                    <tr>
                                        <td>${item.registroContenedor}</td>
                                        <td>${item.tipoResiduo}</td>
                                        <td>${item.porc_llenado}%</td>
                                        <td>${item.mts_cubicos}</td>
                                    </tr>
                                `;
                            });
                        }
                        /* FIN DATOS DE LA TABLA CONTENEDORES */

                        tbody = document.querySelector('#tablaContenedores tbody');
                        tbody.innerHTML = ""; // limpia
                        const contenedores = resp.contenedores;
                        hasValidData = false;
                        if(!resp.contenedores){
                            tbody.innerHTML = `
                                <tr>
                                    <td colspan="4" style="text-align:center;">No hay contenedores asignados a esta orden de transporte.</td>
                                </tr>
                            `;
                        }
                        else{
                                
                                contenedores.forEach(c => {

                                    // Solo agregar si tiene peso_neto
                                    if (c.peso_neto !== null && c.peso_neto !== "" && c.peso_neto !== undefined) {

                                        hasValidData = true;
                                        let taraCont = parseFloat(c.taraContenedor);
                                        let taraEqui = parseFloat(c.taraEquipo);
                                        let pesoNeto = parseFloat(c.peso_neto);

                                        let taraTotal = (taraCont + taraEqui);
                                        let pesoTotal = (parseFloat(taraTotal) + pesoNeto);

                                        let fecIngreso = (c.fec_entrega) ? c.fec_entrega.split('T')[0] : "";
                                        let horaIngreso = (c.fec_entrega) ? c.fec_entrega.substring(11, 16) : "";

                                        let fecEgreso = (c.fec_descarga) ? c.fec_descarga.split('T')[0] : "";
                                        let horaEgreso = (c.fec_descarga) ? c.fec_descarga.substring(11, 16) : "";

                                        const fila = `
                                            <tr>
                                                <td>${c.registroContenedor}</td>
                                                <td>${(c.dominioPesada) ? c.dominioPesada : ""}</td>
                                                <td>PTA</td>

                                                <td>${(pesoTotal) ? pesoTotal : ""}</td>
                                                <td>${(taraTotal) ? taraTotal : ""}</td>
                                                <td>${c.peso_neto ? c.peso_neto : ""}</td>

                                                <td>${fecIngreso} </td>
                                                <td>${horaIngreso} </td>

                                                <td>${fecEgreso} </td>
                                                <td>${horaEgreso} </td>

                                                <td>${c.observaciones_descarga ? c.observaciones_descarga : ""}</td>
                                            </tr>
                                        `;

                                        tbody.insertAdjacentHTML("beforeend", fila);
                                    }
                                });
                            }

                            if (!hasValidData) {
                                const filaVacia = `
                                    <tr>
                                        <td colspan="11" class="text-center">No se encontraron registros</td>
                                    </tr>
                                `;
                                tbody.insertAdjacentHTML("beforeend", filaVacia);
                            }
                    wc();


                },
                error: function() {
                    alert("ATENCION!!! no hay contenedores asignados para el Vehiculo que selecciono");
                    wc();
                },
                complete: function() {
                    // Abrís el modal
                    $("#modalDetalle").modal("show");
                }
            }) 
        
    }



////////////////////////////////
$(document).ready(function() {
        alertify.success("Cargando datos en la vista aguarde...");
        verPedido(); 
});

    </script>
</body>
</html>