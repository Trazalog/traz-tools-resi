<style>
    .form-control,
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        border-radius: 0px !important;
    }
</style>

<div id="filtros" class="row" style="padding-left:20px;padding-right:20px">
    <div class="col-md-12">
        <div>
            <form id="formulario">
                <div class="form-group">
                    <input value="<?php echo isset($funcion) ? $funcion : '' ?>" class="hidden funcion" name="funcion">

                    <!-- Filtros de fecha -->
                    <div class="form-group col-md-6">
                        <label class="text-withe" for="flt-fecha_desde">Fecha Desde:</label>
                        <input type="date" id="flt-fecha_desde" name="fecha_desde" class="form-control filtro-fecha">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="text-withe" for="flt-fecha_hasta">Fecha Hasta:</label>
                        <input type="date" id="flt-fecha_hasta" name="fecha_hasta" class="form-control filtro-fecha">
                    </div>

                    <?php
                    if (isset($filtro) && is_object($filtro)):
                        foreach ($filtro as $key => $o):
                            if ($key == 'fecha_desde' || $key == 'fecha_hasta')
                                continue;

                            if (is_array($o) && count($o) > 0):
                                ?>
                                <div class="form-group col-md-3">
                                    <label class="text-withe" for="flt-<?php echo $key ?>">
                                        <?php echo ucfirst(preg_replace('/([a-z])([A-Z])/', '$1 $2', str_replace('_', ' ', $key))); ?>:
                                    </label>
                                    <select id="flt-<?php echo $key ?>" name="<?php echo $key ?>" class="form-control filtro">
                                        <option value="" selected>Todos</option>
                                        <?php
                                        foreach ($o as $opt):
                                            if (is_object($opt) && isset($opt->id, $opt->nombre)):
                                                echo "<option value='{$opt->id}'>{$opt->nombre}</option>";
                                            elseif (is_object($opt) && isset($opt->nombre)):
                                                echo "<option value='{$opt->nombre}'>{$opt->nombre}</option>";
                                            else:
                                                echo "<option value='{$opt}'>{$opt}</option>";
                                            endif;
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            <?php
                            endif;
                        endforeach;
                    endif;
                    ?>

                    <!-- Botones con estilo similar al otro código -->
                    <br>
                    <div class="form-group col-md-3" style="padding-top:5px">
                        <button type="button" value="Filtrar" class="btn-sm btn-primary" onclick="filtrar()">
                            Filtrar
                        </button>
                        <button type="button" value="Limpiar" class="btn-sm btn-danger flt-clear">
                            Limpiar Todo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<script>

    function filtrar() {
        // Recargar DataTables (esto disparará el ajax con los nuevos valores de filtros)
        if ($.fn.DataTable.isDataTable('#tabla_incidencias')) {
            $('#tabla_incidencias').DataTable().ajax.reload();
        } else {
            console.error('La tabla de incidencias no está inicializada');
        }
    }


    // Limpiar filtros
    $('.flt-clear').click(function () {
        $('#formulario')[0].reset();
    });

    // Filtrado automático (opcional)
    $('.filtro, .filtro-fecha').change(function () {
        // aplicarFiltros(); // Descomentar para filtrado automático
    });

    // Inicializar datepicker si existe
    if ($('.datepicker').length) {
        $('.datepicker').datepicker({
            autoclose: true
        });
    }
</script>