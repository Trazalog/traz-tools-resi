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

	private function mockDepartamentos()
	{
		// Estructura esperada: $obj->departamentos->departamento[] con (id, nombre)
		$local = $this->readLocalJson('departamento.json');
		if ($local && isset($local->departamentos)) {
			return $local;
		}
		$obj = new stdClass();
		$obj->departamentos = new stdClass();
		$obj->departamentos->departamento = array();
		foreach (array(
			array('id'=>1,'nombre'=>'Departamento A'),
			array('id'=>2,'nombre'=>'Departamento B')
		) as $row) {
			$r = new stdClass();
			$r->id = $row['id'];
			$r->nombre = $row['nombre'];
			$obj->departamentos->departamento[] = $r;
		}
		return $obj;
	}

	private function mockZonas()
	{
		// Esperado: $obj->zonas->zona[] con (zona_id, nombre)
		$local = $this->readLocalJson('zonas.json');
		if ($local && isset($local->zonas)) {
			return $local;
		}
		$obj = new stdClass();
		$obj->zonas = new stdClass();
		$obj->zonas->zona = array();
		foreach (array(
			array('zona_id'=>10,'nombre'=>'Zona Norte'),
			array('zona_id'=>20,'nombre'=>'Zona Sur')
		) as $row) {
			$r = new stdClass();
			$r->zona_id = $row['zona_id'];
			$r->nombre = $row['nombre'];
			$obj->zonas->zona[] = $r;
		}
		return $obj;
	}

	private function mockValores($filename, $claveValor = 'valor')
	{
		// Esperado: $obj->valores->valor[] con (tabl_id, valor)
		$local = $this->readLocalJson($filename);
		if ($local && isset($local->valores)) {
			return $local;
		}
		$obj = new stdClass();
		$obj->valores = new stdClass();
		$obj->valores->valor = array();
		$items = array('Tipo A','Tipo B','Tipo C');
		$idx = 1;
		foreach ($items as $v) {
			$r = new stdClass();
			$r->tabl_id = $idx++;
			$r->$claveValor = $v;
			$obj->valores->valor[] = $r;
		}
		return $obj;
	}

	private function mockTransportistas()
	{
		// Esperado: $obj->transportistas->transportista[] con (tran_id, nombre)
		$local = $this->readLocalJson('registrartransportistas.json');
		if ($local && isset($local->transportistas)) {
			return $local;
		}
		$obj = new stdClass();
		$obj->transportistas = new stdClass();
		$obj->transportistas->transportista = array();
		foreach (array(
			array('tran_id'=>101,'nombre'=>'Trans A'),
			array('tran_id'=>102,'nombre'=>'Trans B')
		) as $row) {
			$r = new stdClass();
			$r->tran_id = $row['tran_id'];
			$r->nombre = $row['nombre'];
			$obj->transportistas->transportista[] = $r;
		}
		return $obj;
	}

	private function mockSolicitantesTransporte()
	{
		// Esperado: $obj->solicitantesTransporte->solicitanteTransporte[] con (sotr_id, nombre)
		$obj = new stdClass();
		$obj->solicitantesTransporte = new stdClass();
		$obj->solicitantesTransporte->solicitanteTransporte = array();
		foreach (array(
			array('sotr_id'=>201,'nombre'=>'Empresa X'),
			array('sotr_id'=>202,'nombre'=>'Empresa Y')
		) as $row) {
			$r = new stdClass();
			$r->sotr_id = $row['sotr_id'];
			$r->nombre = $row['nombre'];
			$obj->solicitantesTransporte->solicitanteTransporte[] = $r;
		}
		return $obj;
	}

	private function mockToneladasPorEmpresa()
	{
		// Estructura esperada por Reportes::toneladasPorEmpresa:
		// $rsp->tiposDeCarga->tipoDeCarga[] con:
		//  - nombre
		//  - pesajeTotal
		//  - empresas->empresa[] con (nombre, fecha, pesaje)
		$obj = new stdClass();
		$obj->tiposDeCarga = new stdClass();
		$obj->tiposDeCarga->tipoDeCarga = array();
		$tipos = array('Residuos Industriales','Residuos Orgánicos');
		foreach ($tipos as $t) {
			$tipo = new stdClass();
			$tipo->nombre = $t;
			$tipo->empresas = new stdClass();
			$tipo->empresas->empresa = array();
			$total = 0;
			$rows = array(
				array('nombre'=>'Empresa Alfa','fecha'=>date('Y-m-d'),'pesaje'=>rand(5,20)),
				array('nombre'=>'Empresa Beta','fecha'=>date('Y-m-d', strtotime('-1 day')),'pesaje'=>rand(3,15)),
				array('nombre'=>'Empresa Gamma','fecha'=>date('Y-m-d', strtotime('-2 days')),'pesaje'=>rand(1,10))
			);
			foreach ($rows as $r) {
				$e = new stdClass();
				$e->nombre = $r['nombre'];
				$e->fecha = $r['fecha'];
				$e->pesaje = $r['pesaje'];
				$total += $r['pesaje'];
				$tipo->empresas->empresa[] = $e;
			}
			$tipo->pesajeTotal = $total;
			$obj->tiposDeCarga->tipoDeCarga[] = $tipo;
		}
		return $obj;
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
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : $this->mockZonas();
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
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : $this->mockValores('tipos.json');
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
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : $this->mockSolicitantesTransporte();
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
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : $this->mockTransportistas();
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
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : $this->mockValores('disposiciones_finales.json');
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
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : $this->mockValores('tipos.json');
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
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : $this->mockSolicitantesTransporte();
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
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : $this->mockZonas();
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
		$rsp = ($r['status'] && $r['data']) ? json_decode($r['data']) : $this->mockTransportistas();
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

    public function getToneladasPorTransportista()
    {
        $url = "http://localhost:8080/departamentos/pesajes";
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data']);
        log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETTONELADASPORTRANSPORTISTA|');
        return $rsp;
    }

    public function getToneladasPorGenerador()
    {
        $url = "http://localhost:8080/solicitantesTransporte";
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

	public function getToneladasPorEmpresa($url=null)
    {
		$url = "http://localhost:3000/tipoDeCarga/porEmpresa";
		$r = $this->rest->callApi('GET', $url); 
		$json = $r['data'];
        $json = utf8_encode($json);
        $rsp = json_decode($json);
		log_message('DEBUG', '#RECIDUOS| #KOOLREPORT.PHP|#KOOLREPORT|#GETTONELADASPOREMPRESA|');
		return $rsp;
    }

    public function getToneladasPorDisposicion()
    {
        $url = "http://localhost:8080/tipoDeCarga/porDisposicionFinal";
        $rsp = $this->rest->callApi('GET', $url);
        $rsp = json_decode($rsp['data']);
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
