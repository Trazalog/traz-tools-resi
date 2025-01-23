<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Representa a la Entidad Solicitud_pedido
*
* @autor SLedesma
*/
class Solicitud_pedido extends CI_Controller {
	/**
	* Constructor de Clase
	* @param
	* @return
	*/
	function __construct(){
		parent::__construct();      
		$this->load->model('transporte-bpm/Solicitudpedidos');
	}
   
	/**
	* carga pantalla Solicitud_pedido
	* @param 
	* @return view Lista Solicitud_pedido
	*/
	function templateSolicitudPedidos(){
		log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Solocitud_Pedido | templateSolicitudPedidos()');
		$data['transportista'] = $this->Solicitudpedidos->obtenerTransportista();
		$data['tipocarga'] = $this->Solicitudpedidos->obtener_Tipo_Carga();
		$this->load->view('transporte-bpm/solicitud-pedidos/solicitud_pedido',$data);

	}

	/**
	* obtiene los tipos de residuos por transportista
	* @param  string tran_id
	* @return json tipos de residuos
	*/        
	function obtenerTipoRes(){
		log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Solicitud_pedido | obtenerTipoRes()');
		$tran_id = $this->input->post('tran_id');
		$resp = $this->Solicitudpedidos->obtenerTipoResiduos($tran_id);
		echo json_encode($resp);
	}

	/**
	* Lista las solicitudes de pedidos / la tabla que esta fuera del modal agregar
	* @param 
	* @return view Lista_solicitudes_pedidos
	*/  
	function Listar_SolicitudesPedido(){
		log_message('INFO','#TRAZA |Solicitud_pedido|Listar_SolicitudesPedido() >> '); 
		$data['transportista'] = $this->Solicitudpedidos->obtenerTransportista();
		$data["solicitudes"] = $this->Solicitudpedidos->Listar_Solicitudes_pedido();
		$this->load->view('transporte-bpm/solicitud-pedidos/Lista_solicitudes_pedidos',$data);
	}

	/**
	* Resgistra la solicitud de pedidos
	* @param
	* @return json resp
	*/
	function registrarSolicitud(){
		log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Solicitud_pedido | registrarSolicitud()');
		$usr = userNick();
		$datos = $this->input->post('datos');
		$datos['usuario_app'] = $usr;
		$datos['sotr_id'] = usrIdGeneradorByNick();
		for ($i=0; $i < count($datos['contenedores']); $i++){
			$datos['contenedores'][$i]['usuario_app'] = $usr;
		}

		$resp = $this->Solicitudpedidos->RegistrarPedidoContenedor($datos);
		if($resp == 1){
			echo 'ok';
		}
		else{
			log_message('ERROR','#TRAZA |Solicitud|Eliminar_Zona() >> $resp: '.$resp);
			echo 'error';
		}
	}
   
	/**
	* Obtiene todos los tipos de residos 
	* @param 
	* @return json tipos de residuos
	*/  
	function obtenerTipoResTodos(){
		log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Solicitud_pedido | obtenerTipoResTodos()');
		$resp = $this->Solicitudpedidos->obtener_Tipo_Carga();
		echo json_encode($resp);
	}

	function obtenersolitransp(){
		log_message('INFO','#TRAZA |Solicitud_pedido|obtenersolitransp() >> '); 
		$resp = $this->Solicitudpedidos->Obtenersoltransp($this->input->post('user'));
		// $usuario = userNick(); colocar estas dos lineas cuando userNick funcione bien y borrar la anterior por el momento esta harckodeado con HugoDS
		// $resp = $this->Solicitudpedidos->Obtenersoltransp($usuario);
		if(!$resp){
				echo json_encode($resp);
		}
		else{
				log_message('ERROR','#TRAZA |Solicitud|obtenersolitransp() >> $resp: '.$resp);
				echo 'error';
		}
	}

	/**
	*Lista las solicitudes de contenedores generadas
	* @param 
	* @return view lista_solicitud_pedido
	*/
	function listar_solicitudes(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Solicitud_pedido | listar_solicitudes()');
        $data['solicitudes'] = $this->Solicitudpedidos->Listar_Solicitudes_pedido()->sols_cont->sol_cont;
        
        $this->load->view('transporte-bpm/solicitud-pedidos/lista_solicitud_pedido',$data);
	}
}
?>
