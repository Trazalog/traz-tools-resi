<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/modules/' . RESI . "/reports/toneladasPorEmpresa/ToneladasPorEmpresa.php";
require APPPATH . '/modules/' . RESI . "/reports/toneladasPorDisposicion/ToneladasPorDisposicion.php";
require APPPATH . '/modules/' . RESI . "/reports/toneladasPorGenerador/ToneladasPorGenerador.php";
require APPPATH . '/modules/' . RESI . "/reports/toneladasPorTransportista/ToneladasPorTransportista.php";
require APPPATH . '/modules/' . RESI . "/reports/incidencia/Incidencia.php";

//require APPPATH . "/reports/pesoDeBascula/PesoDeBascula.php";
/*require APPPATH . "/reports/incidenciaPorTransportista/IncidenciaPorTransportista.php";
require APPPATH . "/reports/incidenciaPorMunicipio/IncidenciaPorMunicipio.php";
require APPPATH . "/reports/incidenciaPorZona/IncidenciaPorZona.php";
require APPPATH . "/reports/toneladasPorTransportista/ToneladasPorTransportista.php";
require APPPATH . "/reports/toneladasPorGenerador/ToneladasPorGenerador.php";
require APPPATH . "/reports/toneladasPorResiduo/ToneladasPorResiduo.php";
require APPPATH . "/reports/toneladasPorEmpresa/ToneladasPorEmpresa.php";*/

class Reportes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('koolreport/Koolreport');
        $this->load->model('koolreport/Opciones_Filtros');
    }

    public function pesoDeBascula()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#PESODEBASCULA|');
        $aux = $this->input->post('data');
        $zona = $aux['zona'];
        $tipoDeResiduo = $aux['tipoDeResiduo'];
        $generador = $aux['generador'];
        $transportista = $aux['transportista'];
        $contenedor = $aux['contenedor'];
        $destino = $aux['destino'];
        $desde = $aux['datepickerDesde'];
        $hasta = $aux['datepickerHasta'];
        if ($desde || $hasta || $zona || $tipoDeResiduo || $generador || $transportista || $contenedor || $destino) {
            $desde = ($desde) ? date("d-m-Y", strtotime($desde)) : null;
            $hasta = ($hasta) ? date("d-m-Y", strtotime($hasta)) : null;
            $url = CONSTANTE . '/ordenTrabajo?desde=' . $desde . '&hasta=' . $hasta . '&zona=' . $zona . '&tipoDeResiduo=' . $tipoDeResiduo . '&generador=' . $generador . '&transportista=' . $transportista . '&contenedor=' . $contenedor . '&destino=' . $destino;
            $data = $this->Koolreport->getpesosDeBascula($url)->pesajes->pesaje;
            $reporte = new PesoDeBascula($data);
            $reporte->run()->render();

        } else {
            $url = CONSTANTE . 'desde//hasta//zona//tipoDeResiduo//generador//transportista//contenedor//destino';
            // $data = $this->Koolreport->getpesosDeBascula($url)->pesajes->pesaje;
            $data = $this->Koolreport->getpesosDeBascula($url)->pesajes->pesaje;
            $reporte = new PesoDeBascula($data);
            $reporte->run()->render();
        }
    }

    public function filtroPesoDeBascula()
    {

        log_message('INFO', '#RESIDUOS| #REPORTES.PHP|#REPORTES|#FILTROPESODEBASCULA|');
        $data = $this->Koolreport->getFiltrosPesos();
        $data['calendarioDesde'] = true;
        $data['calendarioHasta'] = true;
        $this->load->view('layout/Filtro', $data);
    }

    public function incidencia()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#INCIDENCIA|');
        // Cargamos la vista vacía, DataTables se encargará de los datos via AJAX
        $data = [];
        $reporte = new Incidencia($data);
        $reporte->run()->render();
    }

    public function incidenciaDataTable()
    {
        log_message('DEBUG', '#TRAZA| #REPORTES.PHP|#incidenciaDataTable');

        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $searchPost = $this->input->post('search');
        $search = (isset($searchPost['value'])) ? $searchPost['value'] : '';

        // Filtros del formulario
        $fecha_desde = $this->input->post('fecha_desde');
        $fecha_desde = ($fecha_desde !== null) ? $fecha_desde : '';

        $fecha_hasta = $this->input->post('fecha_hasta');
        $fecha_hasta = ($fecha_hasta !== null) ? $fecha_hasta : '';

        $ti_id = $this->input->post('tiposIncidencias');
        $ti_id = ($ti_id !== null) ? $ti_id : '';

        $gen_id = $this->input->post('Generador');
        $gen_id = ($gen_id !== null) ? $gen_id : '';

        $trans_id = $this->input->post('Transportistas');
        $trans_id = ($trans_id !== null) ? $trans_id : '';

        $fecha_desde = $fecha_desde ? date("Y-m-d", strtotime($fecha_desde)) : 'TODOS';
        $fecha_hasta = $fecha_hasta ? date("Y-m-d", strtotime($fecha_hasta)) : 'TODOS';
        $ti_id = $ti_id ? $ti_id : 'TODOS';
        $gen_id = $gen_id ? $gen_id : 'TODOS';
        $trans_id = $trans_id ? $trans_id : 'TODOS';

        // LLamada a API paginada
        // getIncidenciasPaginado($fecha_desde, $fecha_hasta, $tiin_id, $sotr_id, $tran_id, $limit, $offset, $search)
        $rsp = $this->Koolreport->getIncidenciasPaginado($fecha_desde, $fecha_hasta, $ti_id, $gen_id, $trans_id, $length, $start, $search);

        $data = [];
        $recordsTotal = 0;
        $recordsFiltered = 0;

        if ($rsp && isset($rsp['incidencias']['incidencia'])) {
            $data = $rsp['incidencias']['incidencia'];

            if (isset($data['inci_id'])) {
                $data = [$data];
            }

            // TOTAL RECORDS: 
            // Si la query incluye "total_records" en cada fila, lo tomamos del primer elemento.
            if (!empty($data) && isset($data[0]['total_records'])) {
                $recordsTotal = $data[0]['total_records'];
                $recordsFiltered = $recordsTotal;
            } elseif (!empty($data)) {

                $count = count($data);
                $recordsFiltered = $start + $count + ($count < $length ? 0 : 1);
                $recordsTotal = $recordsFiltered;
            }
        }

        // CALCULO DE CARDS

        $cards = [];
        foreach ($data as $r) {
            // Asegurar array
            $r = (array) $r;

            $tipo = $r['tipo_incidencia'];
            if (!isset($cards[$tipo]))
                $cards[$tipo] = 0;
            $cards[$tipo]++;
        }

        // Formateo para DataTables
        $finalData = [];
        foreach ($data as $row) {
            $r = (array) $row;

            // Bolita logic
            $color = 'gray';
            $v = isset($r['tipo_incidencia']) ? strtolower($r['tipo_incidencia']) : '';
            if (strpos($v, 'infraccion') !== false)
                $color = 'red';
            elseif (strpos($v, 'laboral') !== false)
                $color = 'light-blue';
            elseif (strpos($v, 'ambiental') !== false)
                $color = 'green';

            $r['tipo_incidencia_html'] = "<small class='label pull-left bg-$color'>{$r['tipo_incidencia']}</small>";

            $finalData[] = $r;
        }

        echo json_encode([
            "draw" => intval($draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $finalData,
            "cards" => $cards
        ]);
    }

    public function returnCantidadIncidencias()
    {
        return ($this->getCantidadIncidencias());
    }

    public function returnCantidadMunicipalidades($data)
    {
        return ($data);
    }

    public function filtroIncidencia()
    {
        log_message('INFO', '#RESIDUOS| #REPORTES.PHP|#REPORTES|#FILTROINCIDENCIA|');
        $data = $this->Koolreport->getFiltrosIncidencias();
        $data['calendarioDesde'] = true;
        $data['calendarioHasta'] = true;

        $this->load->view('reportes/filtroIncidencia', $data);
    }

    public function incidenciaPorTransportista($generador = null)
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#INCIDENCIAPORTRANSPORTISTA|');
        $filtro = $this->input->post('data');
        $desde = $filtro['datepickerDesde'];
        $hasta = $filtro['datepickerHasta'];
        if ($hasta || $desde || $generador) {
            if ($generador) {
                $url = CONSTANTE . '/incidenciaPorTransportista?generador=' . $generador;
                $data = $this->Koolreport->getIncidenciaPorTransportista($url)->transportistas->transportista;
                $reporte = new IncidenciaPorTransportista($data);
                $reporte->run()->render();
            } else {
                $desde = ($desde) ? date("d-m-Y", strtotime($desde)) : null;
                $hasta = ($hasta) ? date("d-m-Y", strtotime($hasta)) : null;
                $url = CONSTANTE . '/incidenciaPorTransportista?desde=' . $desde . '&hasta' . $hasta;
                $data = $this->Koolreport->getIncidenciaPorTransportista($url)->transportistas->transportista;
                $reporte = new IncidenciaPorTransportista($data);
                $reporte->run()->render();
            }

        } else {
            $url = CONSTANTE . 'desde//hasta';
            $data = $this->Koolreport->getIncidenciasPorTransportista($url)->transportistas->transportista;
            // $data['generadores'] = $this->Koolreport->getGeneradores()->generadores->generador;
            $reporte = new IncidenciaPorTransportista($data);
            $reporte->run()->render();
        }
    }

    public function filtroIncidenciaPorTransportista()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#FILTROINCIDENCIAPORTRANSPORTISTA|');
        $data['calendarioDesde'] = true;
        $data['calendarioHasta'] = true;
        $data['reporte'] = 'incidenciaPorTransportista';
        $this->load->view('layout/Filtro', $data);
    }

    public function incidenciaPorMunicipio()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#INCIDENCIAPORMUNICIPIO|');
        $filtro = $this->input->post('data');
        $desde = $filtro['datepickerDesde'];
        $hasta = $filtro['datepickerHasta'];
        if ($hasta || $desde) {
            $desde = ($desde) ? date("d-m-Y", strtotime($desde)) : null;
            $hasta = ($hasta) ? date("d-m-Y", strtotime($hasta)) : null;
            $url = CONSTANTE . '/incidenciaPorMunicipio?desde=' . $desde . '&hasta' . $hasta;
            $data = $this->Koolreport->getIncidenciasPorMunicipio($url)->departamentos->departamento;
            $reporte = new IncidenciaPorMunicipio($data);
            $reporte->run()->render();
        } else {
            $url = CONSTANTE . 'desde//hasta';
            $url = CONSTANTE . '/incidenciaPorMunicipio?desde=' . $desde . '&hasta' . $hasta;
            $data = $this->Koolreport->getIncidenciasPorMunicipio($url)->departamentos->departamento;
            $reporte = new IncidenciaPorMunicipio($data);
            $reporte->run()->render();
        }
    }

    public function filtroIncidenciaPorMunicipio()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#FILTROINCIDENCIAPORMUNICIPIO|');
        $data['calendarioDesde'] = true;
        $data['calendarioHasta'] = true;
        $data['reporte'] = 'incidenciaPorMunicipio';
        $this->load->view('layout/Filtro', $data);
    }

    public function incidenciaPorZona($zona = null)
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#INCIDENCIAPORZONA|');
        $filtro = $this->input->post('data');
        $desde = $filtro['datepickerDesde'];
        $hasta = $filtro['datepickerHasta'];
        if ($hasta || $desde || $zona) {
            if ($zona) {
                $url = CONSTANTE . '/incidenciaPorZona?zona=' . $zona;
                $data = $this->Koolreport->getIncidenciasPorZona($url)->zonas->zona;
                $reporte = new IncidenciaPorZona($data);
                $reporte->run()->render();
            } else {
                $desde = ($desde) ? date("d-m-Y", strtotime($desde)) : null;
                $hasta = ($hasta) ? date("d-m-Y", strtotime($hasta)) : null;
                $url = CONSTANTE . '/incidenciaPorZona?desde=' . $desde . '&hasta' . $hasta;
                $data = $this->Koolreport->getIncidenciasPorZona($url)->zonas->zona;
                $reporte = new IncidenciaPorZona($data);
                $reporte->run()->render();
            }
        } else {
            $url = CONSTANTE . 'desde//hasta';
            $data = $this->Koolreport->getIncidenciasPorZona($url)->zonas->zona;
            $reporte = new IncidenciaPorZona($data);
            $reporte->run()->render();
        }
    }

    public function filtroIncidenciaPorZona()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#FILTROINCIDENCIAPORZONA|');
        $data['calendarioDesde'] = true;
        $data['calendarioHasta'] = true;
        $data['reporte'] = 'incidenciaPorZona';
        $this->load->view('layout/Filtro', $data);
    }

    public function toneladasPorTransportista()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#TONELADASPORTRANSPORTISTA|');
        $filtro = $this->input->post('data');
        $desde = $filtro['datepickerDesde'];
        $hasta = $filtro['datepickerHasta'];
        if ($hasta || $desde) {
            $desde = ($desde) ? date("Y-m-d", strtotime($desde)) : null;
            $hasta = ($hasta) ? date("Y-m-d", strtotime($hasta)) : null;
            $data = $this->Koolreport->getToneladasPorTransportista($desde, $hasta)->transportistas->transportista;
            $reporte = new ToneladasPorTransportista($data);
            $reporte->run()->render();
        } else {
            $data = $this->Koolreport->getToneladasPorTransportista($desde, $hasta)->transportistas->transportista;
            $reporte = new ToneladasPorTransportista($data);
            $reporte->run()->render();
        }
    }

    public function filtroToneladasPorTransportista()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#FILTROTONELADASPORTRANSPORTISTA|');
        $data['calendarioDesde'] = true;
        $data['calendarioHasta'] = true;
        $data['reporte'] = 'toneladasPorTransportista';
        $this->load->view('layout/Filtro', $data);
    }

    public function toneladasPorGenerador()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#TONELADASPORGENERADOR|');
        $filtro = $this->input->post('data');
        $desde = $filtro['datepickerDesde'];
        $hasta = $filtro['datepickerHasta'];
        if ($hasta || $desde) {
            $desde = ($desde) ? date("Y-m-d", strtotime($desde)) : null;
            $hasta = ($hasta) ? date("Y-m-d", strtotime($hasta)) : null;
            $data = $this->Koolreport->getToneladasPorGenerador($desde, $hasta);
            $reporte = new ToneladasPorGenerador($data);
            $reporte->run()->render();
        } else {
            $data = $this->Koolreport->getToneladasPorGenerador($desde, $hasta);
            $reporte = new ToneladasPorGenerador($data);
            $reporte->run()->render();
        }
    }

    public function filtroToneladasPorGenerador()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#FILTROTONELADASPORGENERADOR|');
        $data['calendarioDesde'] = true;
        $data['calendarioHasta'] = true;
        $data['reporte'] = 'toneladasPorGenerador';
        $this->load->view('layout/Filtro', $data);
    }

    public function toneladasPorResiduos()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#TONELADASPORRESIDUOS|');
        $filtro = $this->input->post('data');
        $desde = $filtro['datepickerDesde'];
        $hasta = $filtro['datepickerHasta'];
        if ($filtro) {
            $desde = ($desde) ? date("d-m-Y", strtotime($desde)) : null;
            $hasta = ($hasta) ? date("d-m-Y", strtotime($hasta)) : null;
            $url = CONSTANTE . '/toneladasPorResiduo?desde=' . $desde . '&hasta' . $hasta;
            $data = $this->Koolreport->getToneladasPorResiduo($url)->tiposDeCarga->tipoDeCarga;
            $reporte = new ToneladasPorResiduo($data);
            $reporte->run()->render();
        } else {
            $url = CONSTANTE . 'desde//hasta';
            $data = $this->Koolreport->getToneladasPorResiduo($url)->tiposDeCarga->tipoDeCarga;
            $reporte = new ToneladasPorResiduo($data);
            $reporte->run()->render();
        }
    }

    public function filtroToneladasPorResiduo()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#FILTROTONELADASPORRESIDUOS|');
        $data['calendarioDesde'] = true;
        $data['calendarioHasta'] = true;
        $data['reporte'] = 'toneladasPorResiduos';
        $this->load->view('layout/Filtro', $data);
    }

    public function toneladasPorEmpresa()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#TONELADASPOREMPRESA|');
        $filtro = $this->input->post('data');
        $desde = $filtro['datepickerDesde'];
        $hasta = $filtro['datepickerHasta'];
        if ($desde || $hasta) {
            $desde = ($desde) ? date("Y-m-d", strtotime($desde)) : null;
            $hasta = ($hasta) ? date("Y-m-d", strtotime($hasta)) : null;
            $data = $this->Koolreport->getToneladasPorEmpresa($desde, $hasta)->empresas->empresa;
            $reporte = new ToneladasPorEmpresa($data);
            $reporte->run()->render();
        } else {
            $data = $this->Koolreport->getToneladasPorEmpresa($desde, $hasta)->empresas->empresa;
            $reporte = new ToneladasPorEmpresa($data);
            $reporte->run()->render();
        }
    }

    public function filtroToneladasPorEmpresa()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#FILTROTONELADASPOREMPRESA|');
        $data['calendarioDesde'] = true;
        $data['calendarioHasta'] = true;
        $data['reporte'] = 'toneladasPorEmpresa';
        $this->load->view('layout/Filtro', $data);
    }

    public function toneladasPorDisposicion()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#TONELADASPORDISPOSICION|');
        $filtro = $this->input->post('data');
        $desde = $filtro['datepickerDesde'];
        $hasta = $filtro['datepickerHasta'];
        if ($desde || $hasta) {
            $desde = ($desde) ? date("Y-m-d", strtotime($desde)) : null;
            $hasta = ($hasta) ? date("Y-m-d", strtotime($hasta)) : null;
            $data = $this->Koolreport->getToneladasPorDisposicion($desde, $hasta)->disposiciones->disposicion;
            $reporte = new ToneladasPorDisposicion($data);
            $reporte->run()->render();
        } else {
            $data = $this->Koolreport->getToneladasPorDisposicion($desde, $hasta)->disposiciones->disposicion;
            $reporte = new ToneladasPorDisposicion($data);
            $reporte->run()->render();
        }
    }

    public function filtroToneladasPorDisposicion()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#FILTROTONELADASPORDISPOSICION|');
        $data['calendarioDesde'] = true;
        $data['calendarioHasta'] = true;
        $data['reporte'] = 'toneladasPorDisposicion';
        $this->load->view('layout/Filtro', $data);
    }

    public function obtenerGeneradores()
    {
        log_message('INFO', '#RECIDUOS| #REPORTES.PHP|#REPORTES|#OBTENERGENERADORES|');
        $rsp = $this->Koolreport->getGeneradores()->generadores->generador;
        $rsp = json_encode($rsp);
        echo $rsp;
    }
}
