<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Representa a la Entidad Contenedores
*
* @autor SLedesma
*/
class Contenedores extends CI_Model
{       /**
    * Constructor de Clase
    * @param
    * @return 
    */
    function __construct()
    {
        parent::__construct();
    }
        /**
        * Trae listado de Todos los contenedores
        * @param 
        * @return array datos de todos los contenedores
        */
    function Listar_Contenedor()
    {   
        log_message('INFO','#TRAZA|Contenedores|Listar_Contenedor() >> '); 
        $aux = $this->rest->callAPI("GET",REST_RESI."/contenedores");
        $aux =json_decode($aux["data"]);       
        return $aux->contenedores->contenedor;
    }
    /**
    * Guarda un nuevo contendor
    * @param array datos del contenedor
    * @return string data
    */
    function Guardar_Contenedor($data){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Contenedores | Guardar_Contenedor()');
        $usuario = userNick();
        $data["usuario_app"] = $usuario;
        $post["post_contenedor"] = $data;
        $aux = $this->rest->callAPI("POST",REST_RESI."/contenedores", $post);
        $aux = json_decode($aux["data"]);
        return $aux;
    }
    /**
    * Guarda tipo de carga
    * @param array datos tipo de carga
    * @return array tipo de carga
    */  
    function Guardar_tipo_carga($data){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Contenedores | Guardar_tipo_carga()');
        $arraycargas["_post_contenedores_tipocarga"]  = $data;
        $post["_post_contenedores_tipocarga_batch_req"]= $arraycargas;
        $aux = $this->rest->callAPI("POST",REST_RESI."/_post_contenedores_tipocarga_batch_req", $post);
        return $aux;
    }
    /**
    * Actualiza contenedor
    * @param array datos del contenedor
    * @return array contendor
    */
    function actualizar_Contenedor($data){
        log_message('INFO','#TRAZA|Contenedores|actualizar_Contenedor() >> '); 
        $usuario = userNick();
        $data["usuario_app"] = $usuario;
        $post["put_contenedor"]= $data;
        log_message('DEBUG','#Contenedores/Actualizar_Contenedor'.json_encode($post));
        $aux = $this->rest->callAPI("PUT",REST_RESI."/contenedores", $post);
        return $aux;
    }
    /**
    * Eliminar contenedor
    * @param array datos del contenedor
    * @return string estatus del servicio
    */
    function eliminar_Contenedor($data){
        log_message('INFO','#TRAZA|Contenedores|eliminar_Contenedor() >> '); 
        $post["_put_contenedores_estado"] = $data;
        $post2["_put_contenedores_tipocarga_estado"] = $data;
        log_message('DEBUG','#Contenedores/#eliminar_Contenedor: '.json_encode($post));
        log_message('DEBUG','#Contenedores/#eliminar_Contenedor_tipocarga: '.json_encode($post2));
        $aux = $this->rest->callAPI("PUT",REST_RESI."/contenedores/estado", $post);
        $aux2= $this->rest->callAPI("PUT",REST_RESI."/contenedores/tipoCarga/estado", $post2);
        $aux =json_decode($aux["status"]);
        return $aux;
    }
     /**
    * Borra tipo carga del contenedor
    * @param array datos del tipo de carga del contenedor
    * @return string estatus del servicio
    */    
    function borrar_tipo_Carga($data){
        log_message('INFO','#TRAZA|Contenedores|borrar_tipo_Carga() >> '); 
        $post2["_put_contenedores_tipocarga_estado"] = $data;
        log_message('DEBUG','#Contenedores/#eliminar_Contenedor_tipocarga: '.json_encode($post2));
        $aux2= $this->rest->callAPI("PUT",REST_RESI."/contenedores/tipoCarga/estado", $post2);
        $aux =json_decode($aux2["status"]);
        return $aux;
    }
    /**
    * Obtiene el estado del contenedor 
    * @param 
    * @return array estado 
    */  
    function obtener_Estados(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Contenedores | obtener_Estados()');
        $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/estado_contenedor");
        $aux =json_decode($aux["data"]);
        return $aux->valores->valor;
    }
    /**
    * Obtiene el tipo de carga del contenedor 
    * @param 
    * @return array tipo
    */
    function obtener_Tipo_Carga(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Contenedores | obtener_Estados()'); 
        $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/tipo_carga");
        $aux =json_decode($aux["data"]);
        return $aux->valores->valor;
    }
    /**
    * Obtiene los tipos de habilitaciones que posee los contendores
    * @param 
    * @return array data
    */
    function Obtener_Habilitacion(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Contenedores | Obtener_Habilitacion()'); 
        $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/habilitacion_contenedor");
        $aux = json_decode($aux["data"]);
        return $aux->valores->valor;
    }
    /**
    * Obtiene el listado de transportistas 
    * @param 
    * @return array transportistas
    */
    function obtener_transportista(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Contenedores | obtener_transportista()'); 
        $aux = $this->rest->callAPI("GET",REST_RESI."/transportistas");
        $aux = json_decode($aux["data"]);
        return $aux->transportistas->transportista;
    }

    function obtenerImagen_Cont_Id($cont_id)
    {
        log_message('INFO','#TRAZA|Contenedores|obtenerImagen_Zona_Id() >> ');   
        log_message('DEBUG','#Contenedores/obtenerImagen_Cont_Id: '.json_encode($dato)); 
        $auxx = $this->rest->callAPI("GET",REST_RESI."/contenedores/get/imagen/$cont_id");
        $aux =json_decode($auxx["data"]);
        return $aux;
    }
    function ObtenerContxTranid($tran_id){
        log_message('DEBUG',"#TRAZA| TRAZ-TOOLS-RESIDUOS | Contenedores | obtener_transportista($tran_id)"); 
        $auxx = $this->rest->callAPI("GET",REST_RESI."/contenedores/transportista/$tran_id");
        $aux = json_decode($auxx["data"]);
        return $aux->contenedores->contenedor;
    }

    function ObtenerContxContid($cont_id)
    {
        log_message('INFO','#TRAZA|Contenedores|ObtenerContxContid() >> '); 
        $aux = $this->rest->callAPI("GET",REST_RESI."/contenedores/$cont_id");
        $aux =json_decode($aux["data"]);       
        return $aux->contenedor;
    }
}