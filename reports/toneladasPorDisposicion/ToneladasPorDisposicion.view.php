<?php

use \koolreport\widgets\koolphp\Table;
use \koolreport\widgets\google\ColumnChart;
use \koolreport\widgets\google\PieChart;
use \koolreport\widgets\koolphp\Card;

?>

<body>

    <!--_________________BODY REPORTE___________________________-->

    <div id="reportContent" class="report-content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box box-primary">
                        <div class="box-title"><br>
                            <h2 class="col-md-12" style="text-align:center">Reporte de toneldas recepcionadas por residuo y disposiciones
                            </h2>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>

                        <!--_________________FILTRO_________________-->
                        <filtro></filtro>
                        <!--_________________TABLA_________________-->

                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="box-body">
                            <div class="col-md-12">
                                <?php

                                    $data = $report->dataStore("data_toneladasPorDisposicion_table")->toArray();
                                    
                                    $agrupados = [];
                                    $totalesDisposicion = [];

                                    foreach ($data as $row) {
                                        $difi = $row["disposicion"];
                                        
                                        // cantidad -> toneladas
                                        $toneladas = floatval($row['cantidad']) / 1000.0;

                                        $fecha = $row["fecha"] ?? "";
                                        if ($fecha && strtotime($fecha)) {
                                            $fecha = date("d-m-Y", strtotime($fecha));
                                        }

                                        $tipo = $row["tipo_residuo"] ?? "";

                                        $agrupados[$gen][$dep][] = [
                                            "tipo_carga" => $tipo,
                                            "fecha" => $fecha,
                                            "toneladas" => $toneladas,  
                                        ];

                                        // Sumar valores numéricos
                                        $totalesDisposicion[$difi] = ($totalesDisposicion[$difi] ?? 0) + $toneladas;
                                    }

                                    foreach ($agrupados as $disposiciones => $dis) {
                                        
                                        $safeGen = preg_replace("/[^A-Za-z0-9_]/", "", $disposiciones);
        
                                        foreach ($dis as $dep => $residuos) {
                                            $idDiv = preg_replace("/[^A-Za-z0-9_]/", "", $disposiciones . "_" . $dep);
                                            
                                            echo "<a class='disposiciones' onclick=\"$('#{$idDiv}').toggle();\" style='font-size:17px; cursor:pointer;'>
                                                    <i class='fa fa-minus'></i> 
                                                    <span>Disposicion: " . htmlspecialchars($difi) . " - {$totalesDisposicion[$difi]} Tn</span>
                                                </a><br><br>";

                                            echo "<div id='{$idDiv}'>";
                                                Table::create([
                                                    "dataSource" => $residuos,
                                                    "columns" => [
                                                        "tipo_carga" => ["label" => "Tipo de residuo"],
                                                        "fecha" => ["label" => "Fecha"],
                                                        "toneladas" => [
                                                            "label" => "Toneladas",
                                                            "type" => "float",
                                                            "format" => ["decimals" => 3, "dec_point" => ",", "thousand_sep" => "."]
                                                        ]
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
                            <div class="box box-primary">
                            </div>
                        </div>
                        <!--_________________ FIN BODY REPORTE ____________________________-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $('tr > td').each(function() {
        if ($(this).text() == 0) {
            $(this).text('-');
            $(this).css('text-align', 'center');
        }
    });

    $('filtro').load('<?php echo base_url(RESI) ?>/Reportes/filtroToneladasPorDisposicion');
    // convierte la tabla en data table para usar las funciones de ordenar por columna y buscar
    // $('table').dataTable().fnDestroy();
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
                title: 'Reporte de toneladas entregadas por disposicion',
                filename: 'Reporte de toneladas entregadas por disposicion',

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
                title: 'Reporte de toneladas entregadas por disposicion',
                filename: 'Reporte de toneladas entregadas por disposicion',
                text: '<button class="btn btn-danger ml-2 mb-2 mb-2 mt-3">Exportar a PDF <i class="fa fa-file-pdf-o mr-1"></i></button>'
            },
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0, 1, 2]
                },
                footer: true,
                title: 'Reporte de toneladas entregadas por disposicion',
                filename: 'Reporte de toneladas entregadas por disposicion',
                text: '<button class="btn btn-primary ml-2 mb-2 mb-2 mt-3">Copiar <i class="fa fa-file-text-o mr-1"></i></button>'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2]
                },
                footer: true,
                title: 'Reporte de toneladas entregadas por disposicion',
                filename: 'Reporte de toneladas entregadas por disposicion',
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

    $('.disposiciones').click(function() {
        var ban = $(this).find('i').hasClass('fa-plus');
        $(this).find('i').remove();
        if (ban) $(this).prepend('<i class="fa fa-minus"></i>');
        else $(this).prepend('<i class="fa fa-plus"></i>');
    });
    </script>
</body>