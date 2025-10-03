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
                            <h2 class="col-md-12" style="text-align:center">Reporte de toneldas recepcionadas por residuo y empresa
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

                                    $data = $report->dataStore("data_toneladasPorEmpresa_table")->toArray();

                                    // Agrupamos por tipo de residuo y luego por empresa
                                    $agrupados = [];
                                    $toneladasTotales = [];

                                    foreach($data as $row) {
                                        $res = $row['tipo_residuo'];

                                        // convertir kg a toneladas
                                        $toneladas = floatval($row['cantidad']) / 1000.0;
                                        $toneladas_formateada = number_format($toneladas, 2, ',', '.');

                                        $agrupados[$res][] = [
                                            'generador' => $row['empresa'],
                                            'fecha' => (isset($row['fecha']) && strtotime($row['fecha'])) ? date('d-m-Y', strtotime($row['fecha'])) : '',
                                            'toneladas' => $toneladas_formateada
                                        ];

                                         // Sumar valores numéricos
                                        $toneladasTotales[$res] = ($toneladasTotales[$res] ?? 0) + $toneladas;
                                    }
                                    foreach($agrupados as $residuo => $valor)
                                    {
                                        /* echo "<strong><a class='prueba' onclick=\"$('#".str_replace(" ","-",$clave)."').toggle();\" style='font-size:18px;'><i class='fa fa-minus'></i> <p style='color: black; display:inline'>$clave, " . number_format($toneladasTotales[$clave], 2, ',', '.') . " Tn</p></a></strong><br><br>";
                                        echo "<div id='".str_replace(" ","-",$clave)."'>";
                                        if($valor != null)
                                        {
                                            Table::create(array(
                                                "dataStore" => $valor,
                                                "headers" => array(
                                                ), // Para desactivar encabezado reemplazar "headers" por "showHeader"=>false
                                                "columns" => array(
                                                    "generador" => array(
                                                        "label" => "Generador"
                                                    ),
                                                    "fecha" => array(
                                                        "label" => "Fecha"
                                                    ),
                                                    "toneladas" => array(
                                                        "label" => "Toneladas"
                                                    )
                                                ),
                                                "cssClass" => array(
                                                    "table" => "table table-striped table-scroll table-hover  table-responsive",
                                                    "th" => "sorting"
                                                )
                                            ));
                                        }
                                        echo '</div>';    */    
                                        $idDiv = preg_replace("/[^A-Za-z0-9_]/", "", $residuo . "_" . $valor);
                                            
                                            echo "<a class='residuos' onclick=\"$('#{$idDiv}').toggle();\" style='font-size:17px; cursor:pointer;'>
                                                    <i class='fa fa-minus'></i> 
                                                    <span>" . htmlspecialchars($residuo) . " - {$toneladasTotales[$residuo]} Tn</span>
                                                </a><br><br>";

                                            echo "<div id='{$idDiv}'>";
                                                Table::create([
                                                    "dataSource" => $valor,
                                                    "columns" => [
                                                        "generador" => ["label" => "Generador"],
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
    $('filtro').load('<?php echo base_url(RESI) ?>/Reportes/filtroToneladasPorEmpresa');
    // convierte la tabla en data table para usar las funciones de ordenar por columna y buscar

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
                title: 'Reporte de toneladas entregadas por residuos y por empresa',
                filename: 'Reporte de toneladas entregadas por residuos y por empresa',

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
                title: 'Reporte de toneladas entregadas por residuos ypor empresa',
                filename: 'Reporte de toneladas entregadas por residuos y por empresa',
                text: '<button class="btn btn-danger ml-2 mb-2 mb-2 mt-3">Exportar a PDF <i class="fa fa-file-pdf-o mr-1"></i></button>'
            },
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0, 1, 2]
                },
                footer: true,
                title: 'Reporte de toneladas entregadas por residuos y por empresa',
                filename: 'Reporte de toneladas entregadas por residuos y por empresa',
                text: '<button class="btn btn-primary ml-2 mb-2 mb-2 mt-3">Copiar <i class="fa fa-file-text-o mr-1"></i></button>'
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2]
                },
                footer: true,
                title: 'Reporte de toneladas entregadas por residuos y por empresa',
                filename: 'Reporte de toneladas entregadas por residuos y por empresa',
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

    $('.residuos').click(function() {
        var ban = $(this).find('i').hasClass('fa-plus');
        $(this).find('i').remove();
        if (ban) $(this).prepend('<i class="fa fa-minus"></i>');
        else $(this).prepend('<i class="fa fa-plus"></i>');
    });
    </script>
</body>