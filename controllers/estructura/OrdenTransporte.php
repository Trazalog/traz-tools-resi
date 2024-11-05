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
  
  // ---------------- Funcion Listar Ordentransporte
  function Listar_OrdenTransporte(){
    $data['ordenes'] = $this->Ordentransportes->Listar_ordenes_transporte();
    $this->load->view('layout/Ordenes/lista_orden_transporte',$data); 
      
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
}
?>