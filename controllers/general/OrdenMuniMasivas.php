<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Representa a la Entidad  OrdenMuniMasivas
 *
 * @autor SLedesma
 */
class OrdenMuniMasivas extends CI_Controller
{
  /**
   * Constructor de Clase
   * @param 
   * @return 
   */
  function __construct()
  {
    parent::__construct();
    $this->load->model('general/OrdenesMuniMasivas');
    $this->load->model('general/Pedidocontenedores');
    //  $this->load->model('general/Retirocontenedores');

  }
  /**
   * Carga pantalla Contenedores y listado
   * @param 
   * @return view Contenedores
   */
  function templateOrdenMuniMasivas()
  {
    log_message('INFO', '#TRAZA|OrdenMuniMasivas|templateOrdenMuniMasivas() >>');
    // $data['Carga'] = $this->OrdenesMuniMasivas->obtener_Tipo_Carga();
    // $data['Zona'] = $this->OrdenesMuniMasivas->obtener_Zona();
    // //$data['Estado'] = $this->OrdenesMuniMasivas->obtener_Estado();
    // $data['Circuito'] = $this->OrdenesMuniMasivas->obtener_Circuito();
    $this->load->view('/ordenesMunicipios/OMuniMasivas');
  }

  /**
   * Tabla con listado de todos los conteneodres
   * @param array datos
   * @return view Lista_contenedores
   */
  function Listar_OrdenesMuniMasivas()
  {
    log_message('INFO', '#TRAZA|Contenedor|Listar_Contenedor() >>');
    $data["templates"] = $this->OrdenesMuniMasivas->Listar_OT();
    $data['fecha'] = date('Y-m-d');
    $this->load->view('/ordenesMunicipios/ListaOMuniMasivas', $data);
  }


  function EjecutarOTs()
  {
    $data = $this->input->post('data');
    $aux = 0;
    foreach ($data["datos"] as $valor) {

      //simulacion para ots masivas
      //GUARDA en contenedores_entregados simulando la entrega del contenedor
      $contenedorEntregado["fec_entrega"] = date('Y-m-d');
      $contenedorEntregado["cont_id"] = $valor["cont_id"];
      //$contenedorEntregado["soco_id"] = null;
      $contenedorEntregado["tica_id"] = $valor["tica_id"];
      $contenedorEntregado["equi_id_entrega"] = $valor["equi_id"];
      $contenedorEntregado["usuario_app"] = userNick();
      $contenedorEntregado["mts_cubicos"] = '1';
      $contenedorEntregado["porc_llenado"] = '1';


      $contenedor = $this->Pedidocontenedores->GuardarContEntregadosMunicipio($contenedorEntregado);

      if ($contenedor) {

        //simula salida de contenedor y ejecucion de ot
        //necesito coen_id y equi_id
        /*  $contenedorEntregado["equi_id_salida"] = $valor["equi_id"];
         $contenedor = $this->Retirocontenedores->actualizarContenedores($contenedorEntregado); */

        log_message('DEBUG', '#TRAZA|Contenedor|EjecutarOTs() >> contenedor entregado: ' . $valor["cont_id"]);

        $masivas["difi_id"] = $valor["difi_id"];
        $masivas["sotr_id"] = $valor["sotr_id"];
        $masivas["equi_id"] = $valor["equi_id"];
        $masivas["chof_id"] = $valor["chof_id"];
        $masivas["tran_id"] = $valor["tran_id"];
        $masivas["usuario_app"] = userNick();//"hugoDS";
        $masivas["teot_id"] = $valor["teot_id"];
        $cont["cont_id"] = $valor["cont_id"];
        //$masivas["contenedores"] = $cont;
        $masivas["contenedores"] = [
          [
            "cont_id" => $valor["cont_id"]
          ]
        ];
        $masivas["fec_retiro"] = date('Y-m-d');

        $coen_id = $contenedor->respuesta->coen_id;;
        $resp = $this->OrdenesMuniMasivas->Ejecutar_OT($masivas , $coen_id);

        if (is_string($resp)) {
          echo $resp;
          return;
        }

        $aux = $aux + $resp;
      } else {
        log_message('ERROR', '#TRAZA|Contenedor|EjecutarOTs() >> error al entregar contenedor: ' . $valor["cont_id"]);
      }
    }
    if ($aux != 0) {
      echo "ok";
    } else {
      echo "error";
    }
    // log_message('INFO','#TRAZA|Contenedor|Listar_Contenedor() >>');
    // $resp = $this->OrdenesMuniMasivas->Ejecutar_OT($data);
  }
  // function ListartemplateporFiltros()
  // {
  //   log_message('INFO','#TRAZA|Contenedor|Borrar_Contenedor() >>');
  //   $data['templates'] = $this->OrdenesMuniMasivas->Templatefiltradas($this->input->post('datos'));
  //   //$this->load->view('layout/Ordenes/ListaOMuniMasivas'); 
  // }

}
?>