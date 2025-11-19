<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Representa a la Entidad Transportistas
*
* @autor Hugo Gallardo
*/
class Transportista extends CI_Controller{
    /**
    * Constructor de Clase
    * @param
    * @return 
    */
    function __construct(){
      parent::__construct();
      $this->load->model('estructura/Transportistas');
    }  
   
    /**
    * Carga pantalla ABM transportistas y listado   
    * @param 
    * @return view transportistas
    */
    function templateTransportistas(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportista | templateTransportistas()');
        $data['Rsu'] = $this->Transportistas->obtener_RSU();
        $data['form_id'] = $this->Transportistas->obtener_form_transportista();  
        $this->load->view('transportistas/registrar_transportista',$data);   
    }
   
    /**
    * Guarda transportista nuevo
    * @param array datos transportista y tipo carga asociada
    * @return string "ok, error"
    */
    function Guardar_Transportista(){   
      log_message('INFO','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportista | Guardar_Transportista() >>');
      $datos =  $this->input->post('datos');
      $usr = userNick();
      $datos['usuario_app'] = $usr;
      unset($datos['tica_edit']);
      $tiposcarga = $this->input->post('tipocarga');        
      $tran_id = $this->Transportistas->Guardar_Transportista($datos);
      // agregar el id de transportista para asociar a tipo carga
      if($tran_id){
          foreach ($tiposcarga as $i=>$tipo_carga) {              
            $data[$i]['tran_id'] = $tran_id;
            $data[$i]['tica_id'] = $tipo_carga;              
          }
      }else{
        log_message('ERROR','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportista | Guardar_Transportista() >> $tran_id: '.$tran_id);
        echo "error";
        return;
      }       
      // asocio tipo de carga a transportista nuevo
      $resp = $this->Transportistas->asociarTipoCarga($data);

      if($resp){
			    echo json_encode([
            	"status" => "ok",
            	"tran_id" => $tran_id  
        	]);
      }else{
        log_message('ERROR','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportista | Guardar_Transportista() >> $resp: '.$resp);
        echo "error";
      }
    }    

    /**
    * Tabla con listado de todos los Transportistas
    * @param
    * @return view Lista_transportista
    */
    function Listar_Transportista(){
      log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportista | Listar_Transportista() >>');
      $data["transportistas"] = $this->Transportistas->Listar_Transportistas(); 
      $this->load->view('transportistas/lista_transportista',$data);
    }

    /**
    * Actualiza datos transportistas
    * @param array datos transportistas y tipos de carga
    * @return string "error, ok"
    */
    function Modificar_Transportista(){   
      log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportista | Modificar_Transportista() >> ');     
      $transportista = $this->input->post('transportista');
      unset($transportista['ticaedit']);
      $tipo_carga = $this->input->post('tipo_carga');
      $tran_id = $transportista['tran_id']; 
      // actualiza datos trnasportista
      $response = $this->Transportistas->Modificar_Transportista($transportista); 
        
      if(!$response){
        log_message('ERROR','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportista | Modificar_Transportista() >> $response: '.$response);
        echo "error_transportista";
        return;
      }else{          
        $response = $this->Transportistas->Borrar_TiposCarga($tran_id);
        foreach ($tipo_carga as $i=>$tipo_carga) {              
          $data[$i]['tran_id'] = $tran_id;
          $data[$i]['tica_id'] = $tipo_carga;              
        }
        $resp = $this->Transportistas->asociarTipoCarga($data);   
        if($resp){            
          echo "ok";
        }else{
          log_message('ERROR','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportista | Modificar_Transportista() >> $resp: '.$resp);
          echo "error";
        }          
      }       
    }
  
    /**
    * Borrado de Transportistas
    * @param string id de transportista
    * @return json status servicio 
    */
    function Borrar_Transportista(){   
      log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportista | Borrar_Transportista() >>');
      $tran_id = $this->input->post('tran_id');       
      $response = $this->Transportistas->Borrar_Transportista($tran_id);
      echo json_encode($response);
    }

  // ---------------- Funciones Obtener --------------------------------//

    /**
    * Obtiene todos los tipos de carga
    * @param 
    * @return json tipos de carga
    */
    function obtener_RSU(){ 
      log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportista | obtener_RSU() >>');
      $rsu = $this->Transportistas->obtener_RSU();
      echo json_encode($rsu);   
    }
    
    /**
	*Actualiza un transportista en especifico 
	* @param 
	* @return string "ok","error"
	*/  
	public function set_InfoId_transportista(){
		log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportista | set_InfoId_transportista()');
		$tran_id =  $this->input->post('tran_id');
		$info_id = $this->input->post('info_id');
		$datos = [
        	'tran_id' => $tran_id,
        	'info_id' => $info_id
    	];
		// actualiza los datos del transportista
		$resp = $this->Transportistas->Set_InfoId_Transportista($datos);
		if($resp == 1){
            echo "ok";
        }else{
            log_message('ERROR','#TRAZA|Transportista|set_InfoId_transportista() >> $resp: '.$resp); 
            echo "error";
        }
	}

  	/**
	*verifica si ya fue cargado el cuit
	* @param 
	* @return true,false
	*/  
	
	function valida_cuit(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Transportista | valida_cuit()');  
        $cuit = $this->input->get('cuit');
        $data = $this->Transportistas->valida_Cuit($cuit);
        echo $data;
	}

}

?>