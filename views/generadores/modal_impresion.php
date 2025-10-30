<div class='modal fade' id='modalImpresion' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>

    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' onclick='cierraModalGenerador()' aria-label='Close'><span
                        aria-hidden='true'>&times;</span></button>
                
            </div>
            <div class='modal-body' id='modalBodyGenerador'>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h2 class='modal-title' id='myModalLabel'>Registro de Grandes Generadores de Residuos Sólidos Urbanos</h2>
                            <hr>
                            <h4 class='modal-title' id='myModalLabelsubtitle'>Se otorga constancia de inscripción a la empresa</h4>
                        </div>
                        <hr>
                        <div class="col-xs-12 text-center">
                            <h3 id='generador'></h3>
                        </div>
                        <br>

                        <div class="col-xs-12 text-left">
                            <h4 id='expedienteTexto'></h4>
                        </div>
                        <br>
                        <div class="col-xs-12 text-left">
                            <h4 id='registro'></h4>
                        </div>
                        <br>
                        <div class="col-xs-6 text-left">
                            <h4 id='fecha'></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-primary' onclick='imprimirGenerador()'>Imprimir</button>
                <button type='button' class='btn btn-default' onclick='cierraModalGenerador()'>Cancelar</button>
            </div>
        </div>
    </div>
</div>
<script>
function cierraModalGenerador() {
    $('#modalImpresion').modal('hide');
}

//impresion del remito
function imprimirGenerador() {
        var base = "<?php echo base_url()?>";
        $('#modalBodyGenerador').printThis({
            debug: false,
            importCSS: true,
            importStyle: true,
            pageTitle: "TRAZALOG TOOLS",
            printContainer: true,
            loadCSS: base + "lib/bower_components/bootstrap/dist/css/bootstrap.min.css",
            copyTagClasses: true,
            printDelay: 4000,
            afterPrint: function() {
            },
            base: base
        });
}


</script>