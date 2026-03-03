<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ordentransporte extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->model('estructura/Ordentransportes');
  }
  // ---------------- Funcion Cargar vista Orden de transporte y Datos
  function templateOrdentransporte(){
    log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Ordentransporte | templateOrdentransporte()');
    $data['Tiporesiduo'] = $this->Ordentransportes->obtener_Tipo_residuo();
    $data['numero'] = $this->Ordentransportes->obtener_numero_orden();
    $data['chofer'] = $this->Ordentransportes->obtenerChofer();
    $data['dispfinal'] = $this->Ordentransportes->obtenerdispfinal();
    // $data['equipo'] = $this->Ordentransportes->obtenerEquipo();

    //SELECCION DE EQUIPOS QUE SI POSEEN CONTENEDORES ASOCIADOS
    $arregloEq = array();
    $equipos = $this->Ordentransportes->obtenerEquipo();
    $cont = count($equipos);
    if($cont != null){
      for($i=0; $i < $cont; $i++){
        $auxiliar = $equipos[$i];
        $dom = $auxiliar->dominio;
        $resp = $this->Ordentransportes->ObtenerOTpordominio($dom);
        $vehiAsignado = $resp->vehiculoAsignadoARetiro;
        $contador = $vehiAsignado->contenedores->contenedor ? count($vehiAsignado->contenedores->contenedor) : 0;
        if($contador != 0){
          $arregloEq[] = $auxiliar;
        }
      }
    }
    $data['equipo'] = $arregloEq;
    //FIN SELECCION
    $data['contenedores'] = $this->Ordentransportes->obtenerContenedores();
    $data['sotrid'] = $this->Ordentransportes->obtenerSotrid();
    $this->load->view('ordenes/orden_transporte',$data);  
  }
  
  /**
	* Genera el listado de ordenes de transporte paginados
	* @param integer;integer;string start donde comienza el listado; length cantidad de registros; search cadena a buscar
	* @return array listado paginado y la cantidad
	*/
  function Listar_OrdenTransporte(){
      log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Ordentransporte | Listar_OrdenTransporte()');
       //CODIGO PARA FILTRAR POR generador
      $sotr_id = usrIdGeneradorByNick();
      $start  = $this->input->get('start');  // offset
      $length = $this->input->get('length'); // limit
      $draw   = $this->input->get('draw');

      if (!$start)  $start  = 0;
      if (!$length) $length = 10;

      $search = $this->input->get("search")["value"];

      //ORDEN
      //$orderColIndex = $this->input->get("order")[0]["column"];
      $orderColIndex = "1";

     // $orderDir      = $this->input->get("order")[0]["dir"];
      $orderDir      = "desc";

      $columns       = $this->input->get("columns");

      $orderColumn   = $columns[$orderColIndex]["data"]; 

      /* si es admin tiene que traer todos los datos de todas las empresas */
      $empresas_admin = EMPRESAS_RESI_ADMIN;
      $isAdmin = in_array(empresa(), json_decode($empresas_admin));
      if($isAdmin){
        $sotr_id = 'todos';
      }

      if(!$search){
        // CANTIDAD TOTAL DE ORDENES DE TRANSPORTE
        $total   = $this->Ordentransportes->Total_ordenes_transporte($sotr_id);
        $search = "todos";
      }
      else{
          // Total filtrado
          $total = $this->Ordentransportes->Total_ordenes_transporte_filtrado($search, $sotr_id);
      }

      $ordenes = $this->Ordentransportes->Listar_ordenes_transporte($start, $length, $search, $orderColumn, $orderDir, $sotr_id);
       
      if (!$ordenes || !is_array($ordenes)) {
        $ordenes = array();
      }

      // RESPUESTA PARA DATATABLES
      $output = array(
          "draw"            => intval($draw),
          "recordsTotal"    => intval($total[0]->total),
          "recordsFiltered" => intval($total[0]->total),
          "data"            => $ordenes
      );

      echo json_encode($output);
  }

  /**
	* CARGA LA VISTA DEL LISTADO DE ORDENES DE TRANSPORTE
	* @return view
	*/
  function View_Listar() {
      log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Ordentransporte | View_Listar()');
      $data['empr_id'] = empresa();
      $this->load->view('ordenes/lista_orden_transporte', $data);
  }
  
  // ---------------- Funcion Cargar vista Recepcion de Orden y Datos
  function templateRecepcionOrden(){          
    $this->load->view('layout/Ordenes/recepcion_de_orden', $data);
  }

  function Guardar_ordentransporte(){
    log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Ordentransporte | Guardar_ordentransporte()');
    $resp = $this->Ordentransportes->Guardar_ordenTransportes($this->input->post('datos'));
    if($resp){
      echo "ok";
    }else{
      log_message('ERROR','#TRAZA|ORDENTRANSPORTE|Guardar_ordentransporte() >> $resp: '.$resp);
      echo 'error';
    }
  }

  function ObtenerinfoOt(){
    log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Ordentransporte | ObtenerinfoOt()');
    $resp = $this->Ordentransportes->ObtenerOTpordominio($this->input->post('dom_id'));
    echo json_encode($resp);
  }
    
  function GetChoferyTransportista(){
    $resp['chofer'] = $this->Ordentransportes->Obtenerchofertran_id($this->input->post('tran_id'));
    $resp['transp'] = $this->Ordentransportes->Obtenertranspo_id($this->input->post('tran_id'));
    echo json_encode($resp);
  }

  function Obtenerteot(){
    $resp = $this->Ordentransportes->ObtenerTeot($this->input->post('sotr_id'));
    echo json_encode($resp);
  }

  function dataDetalleOT(){
    $resp['solicitante_transporte'] = $this->Ordentransportes->getSolicitante($this->input->post('sotr_id'));
    $resp['transportista'] = $this->Ordentransportes->Obtenertranspo_id($this->input->post('tran_id'));
    $resp['contenedores'] = $this->Ordentransportes->ContenedoresEntregadosporOrtrId($this->input->post('ortr_id'));
    echo json_encode($resp);
  }
}
?>
