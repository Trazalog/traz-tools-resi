<style>
    .form-control,
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        border-radius: 0px !important;
    }
</style>
<div id="filtros" class="row" style="padding-left:20px;padding-right:20px">
    <div class="col-md-12">
        <div>
            <!--class="box-body" -->
            <form id="formulario">

                <div class="form-group">
                    <?php if (isset($calendarioDesde) && $calendarioDesde) { ?>
                        <div class="form-group col-md-3">
                            <label for="datepickerDesde">Fecha desde:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" id="datepickerDesde" name="datepickerDesde" placeholder="Seleccione fecha">
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (isset($calendarioHasta) && $calendarioHasta) { ?>
                        <div class="form-group col-md-3">
                            <label for="datepickerHasta">Fecha hasta:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" id="datepickerHasta" name="datepickerHasta" placeholder="Seleccione fecha">
                            </div>
                        </div>
                    <?php } ?>
                    <?php foreach ($filtro as $key => $o) { ?>
                        <div class="form-group col-md-3">
                            <label class="text-withe" for="flt-<?php echo $key ?>"><?php echo ucfirst($key) ?>:</label>
                            <select id="flt-<?php echo $key ?>" name="<?php echo $key ?>" class="form-control">
                                <option value="" selected>Todos</option>
                                <?php foreach ($o as $opt) {
                                    if ($opt->id) {
                                        // echo "<option value='$opt->id' onchange='filtrar(this)'>$opt->nombre</option>";
                                        echo "<option value='$opt->id'> $opt->nombre</option>";
                                    } else {
                                        echo "<option value='$opt->nombre'>$opt->nombre</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                    <?php } ?>
                    <input name="reporte" hidden value="<?php echo $reporte?>"></input>
                    <br>
                    <div class="form-group col-md-3" style="padding-top:5px">
                        <button type="button" value="Filtrar" class="btn-sm btn-primary" onclick="filtrar()">Filtrar</button>
                        <button type="button" value="Limpiar" class="btn-sm btn-danger flt-clear">Limpiar Todo</button>
                        <input type="hidden" value="<?php echo $op ?>" id="op" hidden="true">
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- bootstrap datepicker -->

<script>    

    $('.flt-clear').click(function() {
        $('#formulario')[0].reset();       
    });
    $('.datepicker').datepicker({
        autoclose: true
    })

    function filtrar(){
        var formulario = new FormData($('#formulario')[0]);
        if (typeof formToObject !== 'function') {
            window.formToObject = function(fd){
                var obj = {};
                if (fd && typeof fd.forEach === 'function') {
                    fd.forEach(function(v,k){
                        if (obj[k] === undefined) obj[k] = v; 
                        else {
                            if(!Array.isArray(obj[k])) obj[k] = [obj[k]];
                            obj[k].push(v);
                        }
                    });
                }
                return obj;
            }
        }
        var data = formToObject(formulario);
        debugger;
        $.ajax({
            type: 'POST',
            data: {
                data
            },
            url:'<?php echo base_url(RESI) ?>/Reportes/' + data.reporte,
            success: function(data){
                $('#reportContent').empty();
                $('#reportContent').html(data);
            },
            error: function(){
                alert('Error');
            },
            complete: function(){
                wc();
            }
        })
    }

    function filtroAajax(data, filtro){
        $.ajax({
            type: 'POST',
            data: {
                data
            },
            url: '<?php echo base_url(RESI) ?>/Reportes/' + filtro,
            success: function(result) {
                console.log(result);
                $('#reportContent').empty();
                $('#reportContent').html(result);
            },
            error: function() {
                alert('Error');
            },
            complete: function(data) {
                wc();
            }
        });
    }
</script>