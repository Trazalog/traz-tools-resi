<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Koolreport extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function depurarJson($url)
    {
        $rsp = $this->rest->callApi('GET', $url);
        if ($rsp['status']) {
            $json = json_decode($rsp['data']);
        }
        log_message('DEBUG', '#TRAZA| #KOOLREPORT.PHP|#KOOLREPORT|#DEPURARJSON| #JSON: >>' . $json);
        return $json;
    }

    public function getPesosDeBascula()
    {

        $url = 'http://localhost:8080/bascula/pesajes';
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data']);
        $aux->pesajes->pesaje = $rsp->pesajes->pesaje;

        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETPESOSDEBASCULA| #ARRAY: >>' . $aux);
        return $aux;
    }

    public function getFiltrosPesos()
    {

        $url = 'http://localhost:8080/zonas';
        $r = $this->rest->callApi('GET', $url);
        $rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : '';
        $aux = null;
        $i = 0;
        foreach ($rsp->zonas->zona as $valor) {
            $aux[$i]->nombre = $valor->nombre;
            $aux[$i]->id = $valor->zona_id;
            $i++;
        }
        $data['filtro']->zonas = $aux;


        $url = 'http://localhost:8080/tablas/tipo_carga';
        $r = $this->rest->callApi('GET', $url);
        $rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : '';
        $aux = null;
        $i = 0;
        foreach ($rsp->valores->valor as $valor) {
            $aux[$i]->nombre = $valor->valor;
            $aux[$i]->id = $valor->tabl_id;
            $i++;
        }
        $data['filtro']->tipoCarga = $aux;


        $url = 'http://localhost:8080/solicitantesTransporte';
        $r = $this->rest->callApi('GET', $url);
        $rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : '';
        $aux = null;
        $i = 0;
        foreach ($rsp->solicitantesTransporte->solicitanteTransporte as $valor) {
            $aux[$i]->nombre = $valor->nombre;
            $aux[$i]->id = $valor->sotr_id;
            $i++;
        }
        $data['filtro']->solicitantesTransporte = $aux;


        $url = 'http://localhost:8080/transportistas';
        $r = $this->rest->callApi('GET', $url);
        $rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : '';
        $aux = null;
        $i = 0;
        foreach ($rsp->transportistas->transportista as $valor) {
            $aux[$i]->nombre = $valor->nombre;
            $aux[$i]->id = $valor->tran_id;
            $i++;
        }
        $data['filtro']->transportistas = $aux;


        $url = 'http://localhost:8080/contenedores';
        $r = $this->rest->callApi('GET', $url);
        $rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : null;
        $aux = null;
        $i = 0;
        if ($rsp && isset($rsp->contenedores)) {
            foreach ($rsp->contenedores->contenedor as $valor) {
                $aux[$i]->nombre = $valor->codigo;
                $aux[$i]->id = $valor->cont_id;
                $i++;
            }
        } else {
            // Mock básico
            $rows = array(
                array('cont_id' => 301, 'codigo' => 'CONT-001'),
                array('cont_id' => 302, 'codigo' => 'CONT-002')
            );
            foreach ($rows as $row) {
                $aux[$i]->nombre = $row['codigo'];
                $aux[$i]->id = $row['cont_id'];
                $i++;
            }
        }
        $data['filtro']->contenedores = $aux;


        $url = 'http://localhost:8080/tablas/disposicion_final';
        $r = $this->rest->callApi('GET', $url);
        $rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : '';
        $aux = null;
        $i = 0;
        foreach ($rsp->valores->valor as $valor) {
            $aux[$i]->nombre = $valor->valor;
            $aux[$i]->id = $valor->tabl_id;
            $i++;
        }
        $data['filtro']->destinos = $aux;


        $data['op'] = "pesoDeBascula";
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETFILTROSPESOS| #ARRAY: >>' . $data);
        return $data;
    }

    public function getCantidadIncidencias($data)
    {
        return $data;
    }

    public function getIncidencias($fecha_desde, $fecha_hasta, $tiin_id, $sotr_id, $tran_id)
    {
        //$url = REST_RESI."/incidencias";
        $url = REST_RESI2 . "/incidencias/fecha_desde/" . $fecha_desde . "/fecha_hasta/" . $fecha_hasta . "/transportista/" . $tran_id . "/solicitante/" . $sotr_id . "/tipo_infraccion/" . $tiin_id;
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data'], true);

        return $rsp['incidencias']['incidencia'];
    }

    public function getIncidenciasPaginado($fecha_desde, $fecha_hasta, $tiin_id, $sotr_id, $tran_id, $limit, $offset, $search)
    {
        if (empty($search))
            $search = 'TODOS'; // API espera un valor, 'TODOS' o vacio segun definicion, pero la URL dice {search}

        // Codificar espacios en search si es necesario
        $search = str_replace(' ', '%20', $search);

        $url = REST_RESI2 . "/incidencias/fecha_desde/" . $fecha_desde .
            "/fecha_hasta/" . $fecha_hasta .
            "/transportista/" . $tran_id .
            "/solicitante/" . $sotr_id .
            "/tipo_infraccion/" . $tiin_id .
            "/limit/" . $limit .
            "/offset/" . $offset .
            "/search/" . $search;

        log_message('DEBUG', '#TRAZA| #KOOLREPORT.PHP|#getIncidenciasPaginado URL: ' . $url);

        $rsp = $this->rest->callApi('GET', $url);

        if ($rsp['status']) {
            $json = json_decode($rsp['data'], true);
            return $json;
        } else {
            return null;
        }
    }



    public function getFiltrosIncidencias()
    {
        $data = [];
        $data['filtro'] = new stdClass();
        $data['filtro']->fecha_desde = true;
        $data['filtro']->fecha_hasta = true;

        // SOLICITANTES
        $url = REST_RESI . '/solicitantesTransporte';
        $r = $this->rest->callApi('GET', $url);
        $rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : null;

        $aux = [];
        if (isset($rsp->solicitantes_transporte->solicitante)) {
            $i = 0;
            foreach ($rsp->solicitantes_transporte->solicitante as $valor) {
                $aux[$i] = new stdClass();
                $aux[$i]->nombre = $valor->razon_social;
                $aux[$i]->id = $valor->sotr_id;
                $i++;
            }
        }
        $data['filtro']->Generador = $aux;

        // TIPOS INCIDENCIA
        $tabla = 'tipos_incidencia';
        $url = REST_RESI . "/tablas/" . $tabla;
        $r = $this->rest->callApi('GET', $url);
        $rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : null;

        $aux = [];
        if (isset($rsp->valores->valor)) {
            $i = 0;
            foreach ($rsp->valores->valor as $valor) {
                $aux[$i] = new stdClass();
                $aux[$i]->nombre = $valor->valor;
                $aux[$i]->id = $valor->tabl_id;
                $i++;
            }
        }
        $data['filtro']->tiposIncidencias = $aux;

        // TRANSPORTISTAS
        $url = REST_RESI . '/transportistas';
        $r = $this->rest->callApi('GET', $url);
        $rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : null;

        $aux = [];
        if (isset($rsp->transportistas->transportista)) {
            $i = 0;
            foreach ($rsp->transportistas->transportista as $valor) {
                $aux[$i] = new stdClass();
                $aux[$i]->nombre = $valor->razon_social;
                $aux[$i]->id = $valor->tran_id;
                $i++;
            }
        }
        $data['filtro']->Transportistas = $aux;

        log_message('DEBUG', '#RESIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#getFiltrosIncidencias|');


        return $data;
    }


    public function getIncidenciasPorTransportista($transportista)
    {
        $url = "http://localhost:8080/transportista/incidencias";
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data']);
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETINCIDENCIASPORTRANSPORTISTA|');
        return $rsp;
    }

    public function getMunicipios()
    {
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETMUNICIPIO');
        $url = 'http://localhost:8080/departamentos';
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data']);
        return $rsp;
    }

    public function getIncidenciasPorMunicipio()
    {
        $url = "http://localhost:8080/departamento/incidencias";
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data']);
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETINCIDENCIASPORMUNICIPIO|');
        return $rsp;
    }

    public function getIncidenciasPorZona()
    {
        $url = "http://localhost:8080/zona/incidencias";
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data']);
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETINCIDENCIASPORZONA|');
        return $rsp;
    }

    public function getFiltroMyA()
    {
        $aux["mes"] = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
        for ($i = ANIO_BASE; $i <= date('Y'); $i++) {
            $aux["año"][$i - ANIO_BASE] = $i;
        }
        $data->filtro = $aux;
        return $data;
    }

    public function getToneladasPorTransportista($desde, $hasta)
    {
        $url = REST_RESI . "/reporteTransportista/" . $desde . "/" . $hasta;
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data']);
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETTONELADASPORTRANSPORTISTA|');
        return $rsp;
    }

    public function getToneladasPorGenerador($desde, $hasta)
    {
        $url = REST_RESI . "/solicitantesTransporte/" . $desde . "/" . $hasta;
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data']);
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETTONELADASPORGENERADOR|');
        return $rsp;
    }

    public function getToneladasPorResiduo()
    {
        $url = "http://localhost:8080/tipoDeCarga/porMunicipios";
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data']);
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETTONELADASPORRESIDUO|');
        return $rsp;
    }

    public function getToneladasPorEmpresa($desde, $hasta)
    {
        $url = REST_RESI . "/reporteEmpresa/" . $desde . "/" . $hasta;
        $r = $this->rest->callApi('GET', $url);
        $json = $r['data'];
        $rsp = json_decode($json);
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETTONELADASPOREMPRESA|');
        return $rsp;
    }

    public function getToneladasPorDisposicion($desde, $hasta)
    {
        $url = REST_RESI . "/reporteDisposicion/" . $desde . "/" . $hasta;
        $r = $this->rest->callApi('GET', $url);
        $json = $r['data'];
        $rsp = json_decode($json);
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETTONELADASPORDISPOSICION|');
        return $rsp;
    }

    public function getGeneradores()
    {
        $url = "http://localhost:8080/generadores";
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data']);
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETGENERADORES|');
        return $rsp;
    }
}
