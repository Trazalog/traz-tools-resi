<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Representa la entidad Ingreso de contenedores
*
* @autor
*/
class Entregacontdescarga extends CI_Controller {
  /**
  * Constructor de Clase
  * @param
  * @return
  */
  function __construct(){
    parent::__construct();
    $this->load->model('general/Entregaordentransportes');  
  }

  public function certificadoVuelco(){
    $contEnt = $this->input->post('contEntDesc');
    $reciEnt = $this->input->post('contEntReci');
    $reciEnt['usuario_app'] = userNick();
    $request_box['_put_contenedoresEntregados_descargar'] = $contEnt;
    $request_box['_post_contenedoresEntregados_descargar_recipiente'] = $reciEnt;
    log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Entregacontdescarga | certificadoVuelco() | $request_box: >> '.json_encode($request_box));
    $resp = $this->Entregaordentransportes->CertificadoVuelco($request_box);

    echo 'ok';
  }
  public function MoverRecipiente(){
    $reciMov = $this->input->post('recipmov');
    $reciMov['usuario_app'] = userNick();
    $post['_put_lote_recipiente_mover'] = $reciMov;
    $resp = $this->Entregaordentransportes->MoverRecipiente($post);
    if($resp == 1){
        echo 'ok';
    }else{
      echo 'error';
    }
  }

  public function RedireccionarRecipiente(){
    log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Entregacontdescarga | RedireccionarRecipiente()');
    $redireccionar = $this->input->post('redirecc');
    $post['_post_contenedoresEntregados_redireccionar'] = $redireccionar;
    $resp = $this->Entregaordentransportes->RedireccionarReci($post);
    if($resp == 1){
      echo 'ok';
    }else{
      echo 'error';
    }
  }
}