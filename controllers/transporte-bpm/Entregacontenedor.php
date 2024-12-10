<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Representa la entidad Ingreso de contenedores
*
* @autor
*/
class Entregacontenedor extends CI_Controller {
    /**
     * Constructor de Clase
    * @param
    * @return
    */
    function __construct(){
    parent::__construct();  
        $this->load->model('general/Pedidocontenedores');
    }

    public function GuardaContEntregado(){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Entregacontenedor | GuardaContEntregado()');
        $datos_contenedores =  $this->input->post('cont_entregados_listo');
        $usuario_app = userNick(); //para q en la iteracion sea mas optima
        foreach ($datos_contenedores as $key => $value) {
            $datos_contenedores[$key]['usuario_app'] = $usuario_app;
        }
        $resp = $this->Pedidocontenedores->GuardarContEntregados($datos_contenedores);
        if($resp == 1){
            echo 1;
        }else{
            echo 0;
        }

    }
    public function obtenerContenedores(){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Entregacontenedor | obtenerContenedores()');
        $resp = $this->Pedidocontenedores->ObtenerContenedores();
        echo json_encode($resp);
    }   
}
