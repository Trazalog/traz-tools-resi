<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Koolreport extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

	/* ==========================
	   Helpers de MOCK/Offline
	   ========================== */

	private function readLocalJson($filename)
	{
		$path = FCPATH . 'json/' . $filename;
		if (file_exists($path)) {
			$contents = file_get_contents($path);
			$json = json_decode($contents);
			if ($json) {
				return $json;
			}
		}
		return null;
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

    public function getPesosDeBascula(){

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
        $i=0;
        foreach ($rsp->zonas->zona as $valor)
        {
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
        foreach ($rsp->valores->valor as $valor)
        {
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
        foreach ($rsp->solicitantesTransporte->solicitanteTransporte as $valor)
        {
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
        foreach ($rsp->transportistas->transportista as $valor)
        {
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
			foreach ($rsp->contenedores->contenedor as $valor)
			{
				$aux[$i]->nombre = $valor->codigo;
				$aux[$i]->id = $valor->cont_id;
				$i++;
			}
		} else {
			// Mock básico
			$rows = array(
				array('cont_id'=>301,'codigo'=>'CONT-001'),
				array('cont_id'=>302,'codigo'=>'CONT-002')
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
        foreach ($rsp->valores->valor as $valor)
        {
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
    public function getIncidencias()
    {
        $url = "http://localhost:8080/incidencias";
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data']);
        $aux->incidencias->incidencia = $rsp->incidencias->incidencia;

        $a = $this->getCantidadIncidencias(count($aux->incidencias->incidencia));
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETINCIDENCIAS| #ARRAY: >>' . $aux);

        return $aux;
    }

    public function getFiltrosIncidencias()
    {
		$url = "http://localhost:8080/departamentos";
		$r = $this->rest->callApi('GET', $url);
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : $this->mockDepartamentos();
        $aux = null;
        $i = 0;
        foreach ($rsp->departamentos->departamento as $valor)
        {
            $aux[$i]->nombre = $valor->nombre;
            $aux[$i]->id = $valor->id;
            $i++;
        }
        $data['filtro']->municipios = $aux;
        $data['cantidadMunicipios'] = $i;

		$url = "http://localhost:8080/tablas/tipo_incidencia";
		$r = $this->rest->callApi('GET', $url);
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : '';
        $aux = null;
        $i = 0;
        foreach ($rsp->valores->valor as $valor)
        {
            $aux[$i]->nombre = $valor->valor;
            $aux[$i]->id = $valor->tabl_id;
            $i++;
        }
        $data['filtro']->tiposIncidencias = $aux;

		$url = 'http://localhost:8080/solicitantesTransporte';
		$r = $this->rest->callApi('GET', $url);
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : '';
        $aux = null;
        $i = 0;
        foreach ($rsp->solicitantesTransporte->solicitanteTransporte as $valor)
        {
            $aux[$i]->nombre = $valor->nombre;
            $aux[$i]->id = $valor->sotr_id;
            $i++;
        }
        $data['filtro']->solicitantesTransporte = $aux;

		$url = 'http://localhost:8080/zonas';
		$r = $this->rest->callApi('GET', $url);
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : '';
        $aux = null;
        $i=0;
        foreach ($rsp->zonas->zona as $valor)
        {
            $aux[$i]->nombre = $valor->nombre;
            $aux[$i]->id = $valor->zona_id;
            $i++;
        }
        $data['filtro']->zonas = $aux;
        $data['cantidadZonas'] = $i;

		$url = 'http://localhost:8080/transportistas';
		$r = $this->rest->callApi('GET', $url);
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : '';
        $aux = null;
        $i = 0;
        foreach ($rsp->transportistas->transportista as $valor)
        {
            $aux[$i]->nombre = $valor->nombre;
            $aux[$i]->id = $valor->tran_id;
            $i++;
        }
        $data['filtro']->transportistas = $aux;

        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETFILTROSINCIDENCIAS| #ARRAY: >>' . $data);

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
        $aux["mes"] = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
        for($i = ANIO_BASE; $i <= date('Y'); $i++)
        {
            $aux["año"][$i - ANIO_BASE] = $i;
        }
        $data->filtro = $aux;
        return $data;
    }

    public function getToneladasPorTransportista($desde, $hasta)
    {
        $url = REST_RESI."/reporteTransportista/".$desde."/".$hasta;
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data']);
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETTONELADASPORTRANSPORTISTA|');
        return $rsp;
    }

    public function getToneladasPorGenerador($desde, $hasta)
    {
        $url = REST_RESI."/solicitantesTransporte/".$desde."/".$hasta;
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
		$url = REST_RESI."/reporteEmpresa/".$desde."/".$hasta;
		$r = $this->rest->callApi('GET', $url); 
		$json = $r['data'];
        $rsp = json_decode($json);
		log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETTONELADASPOREMPRESA|');
		return $rsp;
    }

    public function getToneladasPorDisposicion($desde, $hasta)
    {
        $url = REST_RESI."/reporteDisposicion/".$desde."/".$hasta;
        $r = $this->rest->callApi('GET', $url);
       	$json = $r['data'];
        $rsp = json_decode($json);
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETTONELADASPORDISPOSICION|');
        return $rsp;
    }

    public function getGeneradores()
    {
        $url = "http://localhost:8080/generadores";
        $rsp = $this->rest->callApi('GET',$url);
        $rsp = json_decode($rsp['data']);
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETGENERADORES|');
        return $rsp;
    }
}
