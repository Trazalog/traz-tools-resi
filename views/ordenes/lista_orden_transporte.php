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

            const tbody = document.getElementById("tbodyContenedores");
            tbody.innerHTML = ""; // limpiamos por las dudas

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

            /* FIN DATOS DE LA TABLA CONTENEDORES */

            

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

</script>