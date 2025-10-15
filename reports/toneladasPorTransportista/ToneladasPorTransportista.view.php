<?php
use \koolreport\widgets\koolphp\Table;
?>

<body>
<div id="reportContent" class="report-content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box box-primary">
                    <div class="box-title"><br>
                        <h2 class="col-md-12" style="text-align:center">
                            Reporte de toneladas entregadas por transportista
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
                            
                            $data = $report->dataStore("data_toneladasPorTransportista_table")->toArray();

                            $agrupados = [];
                            $totalesTransportista = [];
                            $totalesDep = [];

                            foreach ($data as $row) {
                                $gen = isset($row["transportista"]) ? $row["transportista"] : "Sin Transportista";
                                $dep = isset($row["departamento"]) ? $row["departamento"] : "Sin Departamento";

                                // cantidad -> toneladas
                                $toneladas = floatval($row['cantidad']) / 1000.0;

                                $fecha = isset($row["fecha"]) ? $row["fecha"] : "";
                                if ($fecha && strtotime($fecha)) {
                                    $fecha = date("d-m-Y", strtotime($fecha));
                                }

                                $tipo = isset($row["tipo_residuo"]) ? $row["tipo_residuo"] : "";

                                $agrupados[$gen][$dep][] = [
                                    "tipo_carga" => $tipo,
                                    "fecha" => $fecha,
                                    "toneladas" => $toneladas,  // Valor numérico
                                ];

                                // Sumar valores numéricos
                                $totalesTransportista[$gen] = isset($totalesTransportista[$gen]) ? $totalesTransportista[$gen] + $toneladas : $toneladas;
                                $totalesDep[$gen][$dep] = isset($totalesDep[$gen][$dep]) ? $totalesDep[$gen][$dep] + $toneladas : $toneladas;
                            }

                            // Mostrar la información
                            foreach ($agrupados as $transportista => $deps) {

                                // Obtener el total numérico y formatearlo para mostrar
                                $totalGenNumerico = isset($totalesTransportista[$transportista]) ? $totalesTransportista[$transportista] : 0;
                                $totGen = number_format($totalGenNumerico, 2, ",", ".");
                                
                                $safeGen = preg_replace("/[^A-Za-z0-9_]/", "", $transportista);

                                echo "<br><h4><strong>Transportista: " . htmlspecialchars($transportista) . " - {$totGen} Tn</strong></h4><br>";

                                foreach ($deps as $dep => $residuos) {
                                    $idDiv = preg_replace("/[^A-Za-z0-9_]/", "", $transportista . "_" . $dep);
                                    
                                    // Obtener el total numérico del departamento y formatearlo
                                    $totalDepNumerico = isset($totalesDep[$transportista][$dep]) ? $totalesDep[$transportista][$dep] : 0;
                                    $totDep = number_format($totalDepNumerico, 2, ",", ".");

                                    echo "<a class='muni' onclick=\"$('#{$idDiv}').toggle();\" style='font-size:17px; cursor:pointer;'>
                                            <i class='fa fa-minus'></i> 
                                            <span>Municipalidad: " . htmlspecialchars($dep) . " - {$totDep} Tn</span>
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
                </div>
            </div>
        </div>
    </div>
</div>

<script>
//reemplazar celdas que son exactamente cero
 $('tr > td').each(function() {
    var text = $(this).text().trim();
    var numericValue = parseFloat(text.replace('.', '').replace(',', '.'));
    
    // Solo reemplazar si el valor numérico es exactamente 0
    if (numericValue === 0) {
        $(this).text('-');
        $(this).css('text-align', 'center');
    }
});
$('filtro').load('<?php echo base_url(RESI) ?>/Reportes/filtroToneladasPorTransportista');

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
            title: 'Reporte de toneladas entregadas por transportista',
            filename: 'Reporte de toneladas entregadas por transportista',

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
            title: 'Reporte de toneladas entregadas por transportista',
            filename: 'Reporte de toneladas entregadas por transportista',
            text: '<button class="btn btn-danger ml-2 mb-2 mb-2 mt-3">Exportar a PDF <i class="fa fa-file-pdf-o mr-1"></i></button>'
        },
        {
            extend: 'copy',
            exportOptions: {
                columns: [0, 1, 2]
            },
            footer: true,
            title: 'Reporte de toneladas entregadas por transportista',
            filename: 'Reporte de toneladas entregadas por transportista',
            text: '<button class="btn btn-primary ml-2 mb-2 mb-2 mt-3">Copiar <i class="fa fa-file-text-o mr-1"></i></button>'
        },
        {
            extend: 'print',
            exportOptions: {
                columns: [0, 1, 2]
            },
            footer: true,
            title: 'Reporte de toneladas entregadas por transportista',
            filename: 'Reporte de toneladas entregadas por transportista',
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


</script>
</body>