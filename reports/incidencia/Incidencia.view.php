<?php
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\ColumnChart;
use \koolreport\widgets\google\PieChart;
use \koolreport\widgets\koolphp\Card;
?>

<style>
    .cards-center {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }

    .cards-center>div {
        float: none !important;
    }
</style>
<div id="reportContent">
    <div class="report-content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary"> <!-- Solo una clase "box" -->
                    <div class="box-header with-border">
                        <h2 class="box-title text-center">Reporte de incidencias</h2>
                    </div>

                    <div class="box-body">
                        <!-- FILTROS -->
                        <div id="filtros-container">
                            <!-- Los filtros se cargarán aquí vía AJAX -->
                        </div>

                        <!-- TABLA -->
                        <div class="row">
                            <div class="col-md-12">
                                <table id="tabla_incidencias" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nº Incidencia</th>
                                            <th>Descripcion</th>
                                            <th>Tipo incidencia</th>
                                            <th>Fecha</th>
                                            <th>Inspector</th>
                                            <th>Transportista</th>
                                            <th>Generador</th>
                                            <th>N° Orden</th>
                                            <th>N° Acta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- conteo y cards tipos de incidencias -->
<!-- CARDS (Inicialmente vacías o 0, se llenan por JS) -->
<div id="cardsIncidencias">
    <div class="row d-flex cards-center" id="cardsContainer">
        <!-- Se llenaran dinamicamente -->
    </div>
</div>

<script>

    // Cargar filtros
    $(document).ready(function () {
        $('#filtros-container').load('<?php echo base_url(RESI) ?>/Reportes/filtroIncidencia');
    });

    // Variable global para tabla
    var tablaIncidencias;

    $(document).ready(function () {

        tablaIncidencias = $('#tabla_incidencias').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url(RESI) ?>/Reportes/incidenciaDataTable",
                "type": "POST",
                "data": function (d) {
                    // Agregar filtros del formulario al request
                    d.fecha_desde = $('#flt-fecha_desde').val();
                    d.fecha_hasta = $('#flt-fecha_hasta').val();
                    d.tiposIncidencias = $('#flt-tiposIncidencias').val();
                    d.Generador = $('#flt-Generador').val();
                    d.Transportistas = $('#flt-Transportistas').val();
                },
                "dataSrc": function (json) {
                    // Actualizar Cards con los datos recibidos
                    updateCards(json.cards);
                    return json.data;
                }
            },
            "columns": [
                { "data": "inci_id" },
                { "data": "descripcion" },
                {
                    "data": "tipo_incidencia_html",
                    "render": function (data, type, row) {
                        return data;
                    }
                },
                { "data": "fecha" },
                { "data": "usuario_app" },
                { "data": "transportista" },
                { "data": "solicitante" },
                { "data": "ortr_id" },
                {
                    "data": "num_acta",
                    "defaultContent": "" // Puede venir null
                }
            ],
            dom: "lBfrtip",
            buttons: [{
                extend: 'excel',
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
                footer: true,
                title: 'Reporte de Incidencias',
                filename: 'Reporte de incidencias',
                text: '<button class="btn btn-success ml-2 mb-2 mb-2 mt-3">Exportar a Excel <i class="fa fa-file-excel-o"></i></button>'
            },
            {
                extend: 'pdf',
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
                footer: true,
                title: 'Reporte de Incidencias',
                filename: 'Reporte de incidencias',
                text: '<button class="btn btn-danger ml-2 mb-2 mb-2 mt-3">Exportar a PDF <i class="fa fa-file-pdf-o mr-1"></i></button>'
            },
            {
                extend: 'copy',
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
                footer: true,
                title: 'Reporte de Incidencias',
                filename: 'Reporte de incidencias',
                text: '<button class="btn btn-primary ml-2 mb-2 mb-2 mt-3">Copiar <i class="fa fa-file-text-o mr-1"></i></button>'
            },
            {
                extend: 'print',
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
                footer: true,
                title: 'Reporte de Incidencias',
                filename: 'Reporte de incidencias',
                text: '<button class="btn btn-default ml-2 mb-2 mb-2 mt-3">Imprimir <i class="fa fa-print mr-1"></i></button>'
            }
            ],
            "paging": true,
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            "language": {
                url: '<?php echo base_url() ?>lib/bower_components/datatables.net/js/es-ar.json'
            }
        });
    });

    function updateCards(cardsData) {
        var container = $('#cardsContainer');
        container.empty();

        if (!cardsData || Object.keys(cardsData).length === 0) {
            return;
        }

        // Helper para colores (misma logica que PHP)
        function getColor(tipo) {
            tipo = tipo.toLowerCase();
            if (tipo.includes('infraccion')) return 'bg-red';
            if (tipo.includes('laboral')) return 'bg-light-blue';
            if (tipo.includes('ambiental')) return 'bg-green';
            return 'bg-gray';
        }

        $.each(cardsData, function (tipo, cantidad) {
            var colorClass = getColor(tipo);
            var html = `
            <div class="col-md-3">
                <div class="info-box ${colorClass}">
                    <span class="info-box-icon bg-white">
                        <i class="fa fa-exclamation-circle"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">${tipo}</span>
                        <span class="info-box-number">${cantidad}</span>
                    </div>
                </div>
            </div>`;
            container.append(html);
        });
    }
</script>