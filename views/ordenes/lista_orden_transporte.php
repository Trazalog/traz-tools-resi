
<!-- ESTILOS PARA LA IMPRESION -->
<style>
@media print {
    /* Reset para impresión */
    body, html {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
    }
    
    /* Ocultar elementos no deseados */
    .no-print,
    .modal-footer,
    .modal-header .close {
        display: none !important;
    }
    
    /* Forzar el modal a ocupar toda la página */
    .modal {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        height: auto !important;
        overflow: visible !important;
        background: white !important;
    }
    
    .modal-dialog {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
    }
    
    .modal-content {
        border: none !important;
        box-shadow: none !important;
        page-break-inside: avoid !important;
    }
    
    /* Mantener las columnas de Bootstrap */
    .col-md-1, .col-md-2, .col-md-3, .col-md-4, 
    .col-md-5, .col-md-6, .col-md-7, .col-md-8, 
    .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
        float: left !important;
        display: block !important;
    }
    
    .col-md-12 { width: 100% !important; }
    .col-md-6 { width: 50% !important; }
    .col-md-4 { width: 33.333333% !important; }
    .col-md-8 { width: 66.666667% !important; }
    .col-md-3 { width: 25% !important; }
    
    /* Asegurar que los formularios se muestren correctamente */
    .form-group {
        display: block !important;
        width: 100% !important;
        margin-bottom: 10px !important;
    }
    
    .form-control {
        display: block !important;
        width: 100% !important;
    }
    
    /* Tablas responsivas */
    .table-responsive {
        max-height: none !important;
        overflow: visible !important;
        width: 100% !important;
    }
    
    /* Evitar saltos de página indeseados */
/*     .panel {
        page-break-inside: avoid !important;
    } 
    */
    .table {
        page-break-inside: avoid !important;
    } 
    
    /* Ajustar tamaño de fuente para impresión */
    body {
        font-size: 12px !important;
        line-height: 1.2 !important;
    }
    
    h4 { font-size: 14px !important;color: white !important; }
    h5 { font-size: 12px !important;}
    
    /* Colores para impresión */
    .bg-blue {
        background-color: #dd4b39 !important;
        color: white !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    } 

    /* Forzar color blanco en textos sobre fondos dd4b39 */
    .modal-header .modal-title,
    .modal-header .titulo,
    .panel-title a,
    .bg-blue .modal-title,
    .bg-blue h4,
    .bg-blue h5,
    .panel-heading.bg-blue .panel-title a {
        color: white !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    
    /* También asegurar que los links no tengan subrayado */
    .panel-title a {
        text-decoration: none !important;
    }
    
    /* Forzar fondo azul en los headers */
    .modal-header.bg-blue {
        background-color: #dd4b39 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    
    .panel-heading.bg-blue {
        background-color: #dd4b39 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
}
</style>
<!-- FIN ESTILOS PARA LA IMPRESION -->

<!-- __________________HEADER TABLA___________________________ -->

<table id="tabla_orden_transporte" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Acciones</th>
            <th>N° Orden de Transporte</th>
            <th>Transportista</th>
            <th>Fecha</th>
            <th>Chofer</th>
        </tr>
    </thead>
</table>

<!-- __________________FIN TABLAa___________________________ -->


<!-- Modal detalles ot -->
<div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-blue">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h4 class="modal-title titulo" style="text-align:center;" id="exampleModalLabel">Orden de Transporte</h4>
            <h5 class="modal-title" style="text-align:center;">R.S.U - Ley 1114-L - San Juan</h5>
		</div>
      <div class="modal-body" id="contenido_modal">
           <?php $this->load->view(RESI . 'ordenes/mdl_orden_transporte'); ?>
      </div>
    </div>
  </div>
</div>



<script>
    $(document).ready(function() {
    $('#tabla_orden_transporte').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo RESI; ?>estructura/Ordentransporte/Listar_OrdenTransporte",
            "type": "GET"
        },
        "columns": [
            { 
                    "data": "acciones",
                    "render": function(data, type, row, meta) {
                        return `
                            <div class="btn-group">
                                <button class="btn btn-sm btn-search"
                                        title="Ver detalles"
                                        data-row='${JSON.stringify(row).replace(/'/g, "&apos;")}'
                                        onclick="verOrden(this)">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        `;
                    },
                    "orderable": false,
                    "searchable": false
            },
            { "data": "ortr_id" },
            { "data": "transportista" },
            {
                "data": "fec_alta",
                "render": function(data) {
                    return data.split("T")[0];
                }
            },
            {
                "data": null,
                "render": function(data, type, row, meta) {
                    return `${row.chofer} ${row.apellidoChofer}`;
                }
            }

        ],
        "language": {
            "emptyTable":     "No hay datos disponibles",
            "zeroRecords":    "No se encontraron resultados"
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: { columns: [0,1,2,3] },
                footer: true,
                title: 'Ordenes de Transporte',
                filename: 'ordenes_transporte',
                text: '<button class="btn btn-success ml-2 mt-3">Exportar a Excel <i class="fa fa-file-excel-o"></i></button>'
            },
            {
                extend: 'pdf',
                exportOptions: { columns: [0,1,2,3] },
                footer: true,
                title: 'Ordenes de Transporte',
                filename: 'ordenes_transporte',
                text: '<button class="btn btn-danger ml-2 mt-3">Exportar a PDF <i class="fa fa-file-pdf-o"></i></button>'
            },
            {
                extend: 'copy',
                exportOptions: { columns: [0,1,2,3] },
                footer: true,
                title: 'Ordenes de Transporte',
                filename: 'ordenes_transporte',
                text: '<button class="btn btn-primary ml-2 mt-3">Copiar <i class="fa fa-copy"></i></button>'
            },
            {
                extend: 'print',
                exportOptions: { columns: [0,1,2,3] },
                footer: true,
                title: 'Ordenes de Transporte',
                filename: 'ordenes_transporte',
                text: '<button class="btn btn-default ml-2 mt-3">Imprimir <i class="fa fa-print"></i></button>'
            }
        ]
       
    });
});


// Evento click dinámico dentro del datatable

function verOrden(e){
    // Parseamos el JSON desde el data-row
    var row = JSON.parse(e.getAttribute('data-row'));

    

    wo();
    $.ajax({
        type: "POST",
        data: {sotr_id: row.sotr_id, tran_id:row.tran_id, ortr_id:row.ortr_id},
        dataType: 'json',
        url: "<?php echo RESI; ?>estructura/Ordentransporte/dataDetalleOT",
        success: function($respuesta) {
            debugger;
            var resp = $respuesta;

            /* DATA CABECERA */
            $("#ordenTransporte").val(row.ortr_id);

            // Extraer solo la fecha de fec_alta
            const fecAlta = row.fec_alta;
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

            $("#nombre_empresaDisposicionFinal").val(row.difi_descripcion);
            $("#cuitDisposicionFinal").val(row.difi_cuil);
            $("#registroDisposicionFinal").val(row.difi_registro);
            
            /* FIN DATA SITIO DE DISPOSICION FINAL */


            /* DATA DATOS DE LA ORDEN DE TRANSPORTE */
            $("#vehiculoDominioTraslado").val(row.dominio);
            $("#registroOrdenTransporte").val(row.registroEquipo);
            $("#taraOrdenTransporte").val(row.tara);

            let chofer = row.chofer.concat( " ", row.apellidoChofer);
            $("#nombreApellidoChofer").val(chofer);
            $("#registroChofer").val(row.registroChofer);

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
    });

}

function imprimirModal() {
    let base = "<?php echo base_url()?>";
    
    $("#modalDetalle .modal-content").printThis({
        importCSS: true,
        importStyle: true,
        loadCSS: [
            base + "lib/bower_components/bootstrap/dist/css/bootstrap.min.css"
        ],
        printContainer: true, 
        copyTagClasses: true,
        copyTagStyles: true,
        removeInline: false, // Importante: mantener estilos inline
        printDelay: 1000, 
        header: null, // No agregar header extra
        formValues: false,
        base: false,
        canvas: false,
        doctypeString: '<!DOCTYPE html>'
    });
}




</script>