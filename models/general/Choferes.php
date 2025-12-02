<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Representa a la Entidad Choferes
*
* @autor Hugo Gallardo
*/
class Choferes extends CI_Model{
    /**
    * Constructor de Clase
    * @param 
    * @return 
    */
    function __construct(){
        parent::__construct();
    }		

    /**
    * Trae listado de Todos los Choferes
    * @param integer $tran_id
    * @return array choferes de transportista
    */
    function Listar_Choferes($tran_id){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Choferes | Listar_Choferes()');
        $aux = $this->rest->callAPI("GET",REST_RESI."/choferes/transportista/".$tran_id);
        $aux =json_decode($aux["data"]);
        return $aux->choferes->chofer;
    }

    /**
    * Trae listado de Todos los Choferes
    * @param integer
    * @return array todos los choferes 
    */
    function Listar_ChoferesAll(){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Choferes | Listar_Choferes()');
        $aux = $this->rest->callAPI("GET",REST_RESI."/choferes");
        $aux =json_decode($aux["data"]);
        return $aux->choferes->chofer;
    }

    /**
    * Crea un chofer nuevo
    * @param array datos chofer
    * @return int tran_id (id de chofer nuevo)
    */
    function Guardar_Chofer($data){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Choferes | Guardar_Chofer()');
        $post["post_chofer"] = $data;
        $aux = $this->rest->callAPI("POST",REST_RESI."/choferes", $post);
        $aux = json_decode($aux["data"]);
        return $aux;
    }

    /**
    * Actualiza datos del chofer
    * @param array datos de chofer
    * @return string status del servicio
    */
    function Modificar_Chofer($chofer){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Choferes | Modificar_Chofer()');
        $data['_put_choferes'] = $chofer;			
        log_message('DEBUG','#CHOFERES/Modificar_Chofer (datos choferes): '.json_encode($data));		
        $aux = $this->rest->callAPI("PUT",REST_RESI."/choferes", $data);
        $aux =json_decode($aux["status"]);
        return $aux;
    }

    /**
    * borrado logico de chofer
    * @param int id de chofer
    * @return string status del servicio
    */
    function Borrar_Chofer($data){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Choferes | Borrar_Chofer()');
        $post["_delete_choferes"] = $data;
        
        $aux = $this->rest->callAPI("DELETE",REST_RESI."/choferes", $post);
        $aux =json_decode($aux["status"]);
        return $aux;	
    }

    // ___________________________FUNCIONES OBTENER______________________________

    /**
    * Funcion Obtener carnet
    * @param
    * @return array con tipos de carnet
    */
    public function obtener_Carnet(){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Choferes | obtener_Carnet()');
        $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/tipo_carnet");
        $aux =json_decode($aux["data"]);           
        return $aux->valores->valor;
    }

    /**
    * Funcion Obtener categorias
    * @param 
    * @return array con info de categorias de carnet 
    */
    public function obtener_Categoria(){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Choferes | obtener_Categoria()');
        $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/categoria_carnet");
        $aux =json_decode($aux["data"]);
        return $aux->valores->valor;
    }

    /**
    * Funcion Obtener empresa
    * @param 
    * @return array con info de transportistas
    */
    public function obtener_Empresa(){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Choferes | obtener_Empresa()');
        $empr_id = empresa();
        $aux = $this->rest->callAPI("GET",REST_RESI."/transportista/empresa/".$empr_id);
        $aux =json_decode($aux["data"]);
        return $aux->transportistas->transportista;
    }

    /**
    * Obtine una imagen por chof_id
    * @param int chof_id
    * @return bynay imagen
    */
    function obtener_Imagen($chof_id){     
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Chofer | obtener_Imagen() | $chof_id >> '.json_encode($chof_id));
        $aux = $this->rest->callAPI("GET",REST_RESI."/choferes/imagen/".$chof_id);
        $aux =json_decode($aux["data"]);
        return $aux->choferes->imagen;
    }
    /**
    * Obtiene el tran_id de un transportista por su nick
    * @param string userNick
    * @return integer $tran_id
    */
    function getIDTransportista(){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Choferes | listarChoferPorTransportista()');
        $aux = $this->rest->callAPI("GET",REST_RESI."/transportista/id/".userNick());
        $aux = json_decode($aux["data"]);
        return $aux->transportista->tran_id;
    }
}