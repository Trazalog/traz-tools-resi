<!-- ESTILOS TABLAS -->
<style>
/* Bordes más suaves y mejor alineación */
#tablaContenedores thead th {
    vertical-align: middle !important;
    border: 1px solid #000000ff;
    font-weight: bold;
}

#tablaContenedores tbody td {
    border: 1px solid #000000ff;
}

#tablaOrdenTransporte thead th {
    vertical-align: middle !important;
    border: 1px solid #000000ff;
    font-weight: bold;
}

#tablaOrdenTransporte tbody td {
    border: 1px solid #000000ff;
}
</style>

<div class="row">
    
    <!-- Orden de Transporte -->
    <div class="col-md-4">
        <div class="form-group" style="display: block !important;">
            <label for="ordenTransporte" style="display: block !important;">Orden de Transporte N°:</label>
            <input type="text" class="form-control" id="ordenTransporte" name="ordenTransporte" value="" style="display: block !important; width: 100% !important;" readonly>
        </div>
    </div>

    <!-- Fecha -->
    <div class="col-md-4">
        <div class="form-group" style="display: block !important;">
            <label for="fechaOrden" style="display: block !important;">Fecha:</label>
            <input type="date" class="form-control" id="fechaOrden" name="fechaOrden" value="" style="display: block !important; width: 100% !important;" readonly>
        </div>
    </div>

    <!-- Hora de Egreso -->
    <div class="col-md-4">
        <div class="form-group" style="display: block !important;">
            <label for="horaEgreso" style="display: block !important;">Hora de Egreso:</label>
            <input type="time" class="form-control" id="horaEgreso" name="horaEgreso" value="" style="display: block !important; width: 100% !important;" readonly>
        </div>
    </div>
</div>

<!--__________________SECCION GENERADOR___________________________-->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading bg-blue" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOt"
                    aria-expanded="true" aria-controls="collapseOt">
                    Generador
                </a>
            </h4>
        </div>

        <div id="collapseOt" class="panel-collapse collapse in" role="tabpanel"
            aria-labelledby="headingOne">
            <div class="panel-body">
                <div class="row">

                    <div class="col-md-12">
                        <!--Nombre de la Empresa-->
                        <div class="form-group">
                            <label>Nombre de la Empresa:</label>
                            <input type="text" id="nombre_generador" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!--Cuit-->
                        <div class="form-group">
                            <label>Cuit:</label>
                            <input type="text" id="cuit_generador" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!--Registro-->
                        <div class="form-group">
                            <label>N° de Registro:</label>
                            <input type="text" id="registro_generador" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-12 esMunicipio" style="display:none">
                        <!--Municipio-->
                        <div class="form-group">
                            <label>Municipio:</label>
                            <input type="text" id="municipio_generador" class="form-control" readonly>
                        </div>
                    </div>


                    <div class="col-md-6 esMunicipio" style="display:none">
                        <!--Zona-->
                        <div class="form-group">
                            <label>Zona:</label>
                            <input type="text" id="zona_generador" class="form-control" readonly>
                        </div>
                    </div>    

                    <div class="col-md-6 esMunicipio" style="display:none">
                        <!--Circuito-->
                        <div class="form-group">
                            <label>Circuito:</label>
                            <input type="text" id="circuito_generador" class="form-control" readonly>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--__________________FIN SECCION GENERADOR___________________________-->

<!--__________________SECCION TRANSPORTISTA___________________________-->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading bg-blue" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTransportista"
                    aria-expanded="true" aria-controls="collapseTransportista">
                    Transportista
                </a>
            </h4>
        </div>

        <div id="collapseTransportista" class="panel-collapse collapse in" role="tabpanel"
            aria-labelledby="headingOne">
            <div class="panel-body">
                <div class="row">

                    <div class="col-md-12">
                        <!--Nombre de la Empresa-->
                        <div class="form-group">
                            <label>Nombre de la Empresa:</label>
                            <input type="text" id="nombre_empresaTransportista" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!--Cuit-->
                        <div class="form-group">
                            <label>Cuit:</label>
                            <input type="text" id="cuitTransportista" class="form-control" readonly>
                        </div>
                    </div>    

                    <div class="col-md-6">
                        <!--Registro-->
                        <div class="form-group">
                            <label>Registro N°:</label>
                            <input type="text" id="registroTransportista" class="form-control" readonly>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--__________________FIN SECCION TRANSPORTISTA___________________________-->

<!--__________________SECCION SITIO DE DISPOSICION FINAL___________________________-->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading bg-blue" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSitioDisposicionFinal"
                    aria-expanded="true" aria-controls="collapseSitioDisposicionFinal">
                    Sitio de Disposición Final
                </a>
            </h4>
        </div>

        <div id="collapseSitioDisposicionFinal" class="panel-collapse collapse in" role="tabpanel"
            aria-labelledby="headingOne">
            <div class="panel-body">
                <div class="row">

                    <div class="col-md-12">
                        <!--Nombre de la Empresa-->
                        <div class="form-group">
                            <label>Nombre de la Empresa:</label>
                            <input type="text" id="nombre_empresaDisposicionFinal" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!--Cuit-->
                        <div class="form-group">
                            <label>Cuit:</label>
                            <input type="text" id="cuitDisposicionFinal" class="form-control" readonly>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <!--Registro-->
                        <div class="form-group">
                            <label>Registro N°:</label>
                            <input type="text" id="registroDisposicionFinal" class="form-control" readonly>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--__________________FIN SECCION SECCION SITIO DE DISPOSICION FINAL___________________________-->

<!--__________________SECCION DATOS DE LA ORDEN DE TRANSPORTE___________________________-->
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-default">
        <div class="panel-heading bg-blue" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseDatosOrdenTransporte"
                    aria-expanded="true" aria-controls="collapseDatosOrdenTransporte">
                    Datos de la Orden de Transporte
                </a>
            </h4>
        </div>

        <div id="collapseDatosOrdenTransporte" class="panel-collapse collapse in" role="tabpanel"
            aria-labelledby="headingOne">
            <div class="panel-body">
                <div class="row">

                    <div class="col-md-4">

                        <!--Vehículo / Dominio de traslado-->
                        <div class="form-group">
                            <label>Vehículo / Dominio de traslado:</label>
                            <input type="text" id="vehiculoDominioTraslado" class="form-control" readonly>
                        </div>

                    </div>

                    <div class="col-md-4">

                         <!--Registro-->
                        <div class="form-group">
                            <label>Registro N°:</label>
                            <input type="text" id="registroOrdenTransporte" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">

                         <!--Tara-->
                        <div class="form-group">
                            <label>Tara:</label>
                            <input type="text" id="taraOrdenTransporte" class="form-control" readonly>
                        </div>

                    </div>

                    <div class="col-md-6">

                       <!--Nombre y Apellido del chofer-->
                        <div class="form-group">
                            <label>Nombre y Apellido del chofer:</label>
                            <input type="text" id="nombreApellidoChofer" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!--Registro-->
                        <div class="form-group">
                            <label>Registro N°:</label>
                            <input type="text" id="registroChofer" class="form-control" readonly>
                        </div>
                    </div>

                </div>

                <hr>

                <div class="table-responsive" style="max-height: 350px; overflow-x: auto;">
                    <table id="tablaOrdenTransporte"
                        class="table table-bordered table-striped"
                        style="width: 100%;">

                        <thead class="bg-blue" style="color:white; text-align:center;">
                            <!-- Fila 1 -->
                            <tr>
                                <th rowspan="2">Contenedor Registro N°</th>
                                <th rowspan="2">Tipo de Residuo</th>
                                <th rowspan="2">Porcentaje de llenado</th>
                                <th rowspan="2">Metros cúbicos</th>

                            </tr>
                        </thead>

                        <tbody id="tbodyContenedores">
                            
                        </tbody>

                    </table>
                </div>
            </div> 

            <hr>
          
            <div class="table-responsive" style="max-height: 350px; overflow-x: auto;">
                <table id="tablaContenedores"
                    class="table table-bordered table-striped"
                    style="width: 100%;">

                    <thead class="bg-blue" style="color:white; text-align:center;">
                        <!-- Fila 1 -->
                        <tr>
                            <th rowspan="2">Contenedor</th>
                            <th rowspan="2">Dominio Pesada</th>
                            <th rowspan="2">Sector Derivación</th>

                            <th colspan="3">PESOS (kg)</th>
                            <th colspan="2">INGRESO</th>
                            <th colspan="2">EGRESO</th>

                            <th rowspan="2">Observaciones</th>
                        </tr>

                        <!-- Fila 2 -->
                        <tr>
                            <th>Peso</th>
                            <th>Tara</th>
                            <th>Neto</th>

                            <th>Fecha</th>
                            <th>Hora</th>

                            <th>Fecha</th>
                            <th>Hora</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>
<!--__________________FIN SECCION DATOS DE LA ORDEN DE TRANSPORTE___________________________-->


<div class="row">
    <h5 style="text-align: justify; padding: 15px; color: #dd4b39;">
        <strong>    
            NOTA:
        </strong>
        La totalidad de los datos presentados en esta orde de transporte revisten el carácter de Declaración Jurada, debiendo reflejar su contenido, la realidad de los items declarados.
    </h5>

</div>

<div class='modal-footer'>
            <button type='submit' class='btn btn-danger pull-right no-print' id='btnImprimir' onclick="imprimirModal()">Imprimir</button>
</div>