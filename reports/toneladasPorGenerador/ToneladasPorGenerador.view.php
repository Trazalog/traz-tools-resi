<?php
use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\ColumnChart;
use \koolreport\widgets\google\PieChart;
use \koolreport\widgets\koolphp\Card;

?>

<body>


<div id="reportContent" class="report-content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-solid">
                <div class="box box-primary">

                    <div class="box-title"><br>
                        <h2 class="col-md-12" style="text-align:center">
                            Reporte de toneladas entregadas por generador
                        </h2>
                    </div>

                    <div class="col-md-12"><hr></div>

                    <!--_________________FILTRO_________________-->
                    <filtro></filtro>

                    <div class="col-md-12"><hr></div>

                    <!--_________________TABLA_________________-->
                    <div class="box-body">
                        <div class="col-md-12">

                            <?php
                            // Obtenemos los datos del DataSource
                            $data = $report->dataStore('data_toneladasPorGenerador_table')->toArray();

                            // Agrupamos por generador y luego por departamento
                            $agrupados = [];
                            foreach($data as $row) {
                                $gen = $row['generador'];
                                $dep = $row['departamento'];

                                // convertir kg a toneladas
                                $toneladas = floatval($row['toneladas_totales']) / 1000.0;
                                $toneladas_formateada = number_format($toneladas, 2, ',', '.');

                                $agrupados[$gen][$dep][] = [
                                    'tipo_carga' => $row['tipo_residuo'],
                                    'fecha' => (isset($row['fec_alta']) && strtotime($row['fec_alta'])) ? date('d-m-Y', strtotime($row['fec_alta'])) : '',
                                    'toneladas' => $toneladas_formateada,
                                    'toneladas_num' => $toneladas 
                                ];
                            }

                            // Mostramos la información
                            foreach($agrupados as $generador => $deps) {

                                 // Total de toneladas por generador
                                $totalGen = 0;
                                foreach($deps as $dep => $residuos) {
                                    foreach($residuos as $r) {
                                        $totalGen += floatval($r['toneladas_num']);
                                    }
                                }

                                // al mostrar totales:
                                $totalGenFormatted = number_format($totalGen, 2, ',', '.');
                                echo "<br><h4><strong>Generador: $generador - Total: {$totalGenFormatted} Tn</strong></h4><br>";
                                

                                foreach($deps as $dep => $residuos) {
                                    
                                    $totalDep = 0;
                                    foreach($residuos as $r) {
                                        $totalDep += $r['toneladas_num'];
                                    }
                                    
                                    // Formatear el total del departamento
                                    $totalDepFormatted = number_format($totalDep, 2, ',', '.');

                                    // Creamos un ID seguro para el div
                                    $idDiv = preg_replace("/[^A-Za-z0-9_]/", '', $generador . '_' . $dep);

                                     echo "<a class='muni' onclick=\"$('#$idDiv').toggle();\" style='font-size:17px; cursor:pointer;'>
                                                <i class='fa fa-minus'></i> <span>Municipalidad: $dep - Total: $totalDepFormatted Tn</span>
                                            </a><br><br>";

                                    echo "<div id='$idDiv'>";
                                        Table::create([
                                            "dataSource" => $residuos,
                                            "columns" => [
                                                "tipo_carga" => ["label" => "Tipo de residuo"],
                                                "fecha" => ["label" => "Fecha"],
                                                "toneladas" => ["label" => "Toneladas"]
                                            ],
                                            "cssClass" => [
                                                "table" => "table-striped table-scroll table-hover table-responsive"
                                            ]
                                        ]);
                                    echo "</div><br>";
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <!--_________________FIN TABLA_________________-->

                    <div class="col-md-12">
                        <div class="box box-primary"></div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
// Reemplaza ceros por '-'
$('tr > td').each(function() {
    if ($(this).text() == 0) {
        $(this).text('-');
        $(this).css('text-align', 'center');
    }
});

// Carga filtro si lo tienes definido en tu controlador
$('filtro').load('<?php echo base_url(RESI) ?>/Reportes/filtroToneladasPorGenerador');

// Inicializa DataTables
$(document).ready(function() {
    // target: solo las tablas dentro del reporte para no afectar otras
    $('.box-body .table').each(function(index, table){
      // si ya está inicializada, saltar
      if ( $.fn.dataTable.isDataTable(table) ) return;

      $(table).DataTable({
        dom: "Bfrtip", // muestra Buttons + filtros
        buttons: [{
            //Botón para Excel
            extend: 'excel',
            exportOptions: {
                columns: [0, 1, 2]
            },
            footer: true,
            title: 'Reporte de toneladas entregadas por generador',
            filename: 'Reporte de toneladas entregadas por generador',

            //Aquí es donde generas el botón personalizado
            text: '<button class="btn btn-success ml-2 mb-2 mb-2 mt-3">Exportar a Excel <i class="fa fa-file-excel-o"></i></button>'
        },
        // //Botón para PDF
        {
            extend: 'pdf',
            exportOptions: {
                columns: [0, 1, 2]
            },
            footer: true,
            title: 'Reporte de toneladas entregadas por generador',
            filename: 'Reporte de toneladas entregadas por generador',
            text: '<button class="btn btn-danger ml-2 mb-2 mb-2 mt-3">Exportar a PDF <i class="fa fa-file-pdf-o mr-1"></i></button>'
        },
        {
            extend: 'copy',
            exportOptions: {
                columns: [0, 1, 2]
            },
            footer: true,
            title: 'Reporte de toneladas entregadas por generador',
            filename: 'Reporte de toneladas entregadas por generador',
            text: '<button class="btn btn-primary ml-2 mb-2 mb-2 mt-3">Copiar <i class="fa fa-file-text-o mr-1"></i></button>'
        },
        {
            extend: 'print',
            exportOptions: {
                columns: [0, 1, 2]
            },
            footer: true,
            title: 'Reporte de toneladas entregadas por generador',
            filename: 'Reporte de toneladas entregadas por generador',
            text: '<button class="btn btn-default ml-2 mb-2 mb-2 mt-3">Imprimir <i class="fa fa-print mr-1"></i></button>'
        }
    ],
        // exportar solo columnas visibles, o ajustar selector si necesitás excluir columnas (p.ej. acciones)
        exportOptions: {
          columns: ':visible'
        },
        // ajustes opcionales
        paging: true,
        pageLength: 25,
        language: {
           url: '<?php base_url() ?>lib/bower_components/datatables.net/js/es-ar.json'
        }
      });
    });
  });

// Toggle icono +/- al hacer click
$('.muni').click(function() {
    var ban = $(this).find('i').hasClass('fa-plus');
    $(this).find('i').remove();
    if (ban) $(this).prepend('<i class="fa fa-minus"></i>');
    else $(this).prepend('<i class="fa fa-plus"></i>');
});
</script>

</body>
