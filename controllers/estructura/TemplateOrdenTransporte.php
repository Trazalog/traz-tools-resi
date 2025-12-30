<?php defined('BASEPATH') OR exit('No direct script access allowed');

class TemplateOrdenTransporte extends CI_Controller {

  function __construct(){
    parent::__construct();
    $this->load->model('estructura/TemplateOrdenTransportes');
  }

  function templateOrdenTransporte(){
    log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | TemplateOrdenTransporte | templateOrdenTransporte()');
      $data['empresa'] = $this->TemplateOrdenTransportes->obtenerEmpresa();
      $data['circuito'] = $this->TemplateOrdenTransportes->obtenerCircuito();
      $data['disposicionFinal'] = $this->TemplateOrdenTransportes->obtenerDispFinal();
      $data['tipoResiduo'] = $this->TemplateOrdenTransportes->obtenerTipoRes();
      $data['zona'] = $this->TemplateOrdenTransportes->obtenerZona();
      $data['chofer'] = $this->TemplateOrdenTransportes->obtenerChofer();
      $data['fecha'] = date('Y-m-d');
    $this->load->view('template/template_ot',$data);  
  }

  function solicitudRetiro()
   {
       $data['empresa'] = $this->Empresas->obtener();
       $data['disposicionFinal'] = $this->DisposisionesFinales->obtener();
       $data['tipoResiduo'] = $this->TipoResiduos->obtener();
       $data['fecha'] = date('Y-m-d');
       $this->load->view('template/solicitud_retiro',$data);
   }

   function registrarRecepcionDeOrden()
   {
    //    $data['zonaDescarga'] = $this->Sectoresdescarga->obtener();
    //    $this->load->view('layout/Ordenes/recepcion_de_orden', $data);
    $this->load->view('layout/Ordenes/recepcion_de_orden');
   }
   function Controldedescarga()
   {
    
    $this->load->view('layout/control_descarga', $data);
   }

   function nueva()
   {
    
    $this->load->view('layout/nueva_vista', $data);
   }

   //COMIENZO FUNCIONES  TEMPLATE OT

    /**
      * Obtiene Vehiculos dado un id de transportista
      * @param 
      * @return json vehiculos
    */
   function obtenerVehixTran_id()
   {
    log_message('INFO','#TRAZA|Orden|obtenerVehixTran_id() >>');
    $resp = $this->TemplateOrdenTransportes->ObtenerVehixtran_id($this->input->post('id_empresa'));
    if($resp){
        echo json_encode($resp);
    }
   }

   
    /**
      * Registra Nueva Template OT 
      * @param array datos
      * @return string "Ok", "error"
    */
   function RegistrarTemplateOt()
   {
       log_message('INFO','#TRAZA|Orden|RegistrarTemplateOt() >>');
       $datos = $this->input->post();
       $params = [
                  'observaciones' => '',        
                  'circ_id'       => $datos['circuito'],
                  'equi_id'       => $datos['movilidad'],
                  'chof_id'       => $datos['chofer'],
                  'tica_id'       => $datos['tiporesiduo'],
                  'difi_id'       => $datos['dispfinal']
        ];
       $resp = $this->TemplateOrdenTransportes->RegistrarTemplateOT($params);
       if($resp == 1)
       {echo "Ok";}
       else
       {   
           log_message('ERROR','#TRAZA|Orden|RegistrarTemplateOt() >> $resp: '.$resp);
           echo "error";
       }
   }

     /**
      * Carga vista que lista las templates OT cargadas 
      * @param 
      * @return view Listar_templateOT
    */
  function Listar_templateOt()
  {
    log_message('INFO','#TRAZA|Orden|Listar_Vehiculo() >>');
    $data["templateot"] = $this->TemplateOrdenTransportes->Listar_templateOT();
    $this->load->view('template/Listar_templateOT',$data);
  }

    /**
      * Actualiza un TemplateOT 
      * @param array datos
      * @return string "ok", "error"
    */
  function ActualizarTemplateOt()
  {
    log_message('INFO','#TRAZA|Orden|ActualizarTemplateOt() >>'); 
    $datos =  $this->input->post('datosEdit');
    $resp = $this->TemplateOrdenTransportes->actualizar_templateOT($datos);
    if($resp == 1 ){
        echo "ok";
    }else{
    log_message('ERROR','#TRAZA|Orden|ActualizarTemplateOt() >> $resp: '.$resp);
    echo "error";
    }
  }

    /**
      * Eliminar una  Template OT 
      * @param array datosDelete
      * @return string "Ok", "error"
    */
  function EliminarTemplateOt()
  {
    log_message('INFO','#TRAZA|Orden|EliminarTemplateOt() >>');
    $resp = $this->TemplateOrdenTransportes->Eliminar_templateOT($this->input->post('datosDelete'));
    if($resp == 1 ){
        echo "ok";
    }else{
    log_message('ERROR','#TRAZA|Orden|EliminarTemplateOt() >> $resp: '.$resp);
    echo "error";
    }
  }
  

}