<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Representa a la Entidad Vehiculos
*
* @autor Ze Roberto Basañes
*/
class Vehiculos extends CI_Model
{
	/**
	* Constructor de Clase
	* @param
	* @return
	*/
	function __construct()
	{
			parent::__construct();
	}

	/**
	* Trae listado de Todos los Vehiculos
	* @param
	* @return string data
	*/
	function Listar_Vehiculo(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculos | Listar_Vehiculo()');
        $aux = $this->rest->callAPI("GET",REST_RESI."/vehiculos");
        $aux =json_decode($aux["data"]);
        return $aux->vehiculos->vehiculo;
}

		/**
	* Guarda un nuevo vehiculo
	* @param  string data
	* @return string status
	*/
	function Guardar_Vehiculos($data){
		log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculos | Guardar_Vehiculos()');
		$post["post_vehiculos"] = $data;
		$aux = $this->rest->callAPI("POST",REST_RESI."/vehiculos", $post);
		$aux =json_decode($aux["data"]);
		return $aux->respuesta->equi_id;
	}

	/**
	* obtiene los transportistas
	* @param 
	* @return string data
	*/
	public function Obtener_Transportista(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculos | Obtener_Transportista()');
        $aux = $this->rest->callAPI("GET",REST_RESI."/transportistas");
        $aux =json_decode($aux["data"]);
        return $aux->transportistas->transportista;
	}

	/**
	* Elimina un vehiculo dado su id
	* @param  string equi_id , numero
	* @return string status
	*/
	function Borrar_vehiculo($data){
		log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculos | Borrar_Vehiculo()');
		$post["_delete_vehiculos"]= $data;
		log_message('DEBUG','#Vehiculos/#Borrar_vehiculo: '.json_encode($post));
		$aux = $this->rest->callAPI("DELETE",REST_RESI."/vehiculos", $post);
		$aux =json_decode($aux["status"]);
		return $aux;
	}

	function actualizar_Vehiculo($data){
		log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculos | actualizar_Vehiculo()');  
		$post["_put_vehiculos"] = $data;
		$aux = $this->rest->callAPI("PUT",REST_RESI."/vehiculos", $post);
		$aux =json_decode($aux["status"]);
		return $aux;
	}
	function obtenerImagen_Vehi_Id($equi_id)
	{
			log_message('INFO','#TRAZA|Vehiculo|obtenerImagen_Vehi_Id() >> ');   
			log_message('DEBUG','#Vehiculo/obtenerImagen_Vehi_Id: '.json_encode($equi_id)); 
			$auxx = $this->rest->callAPI("GET",REST_RESI."/vehiculos/imagen/$equi_id");
			$aux =json_decode($auxx["data"]);
			return $aux;
	}

	/**
	* Obtiene todos los tipos de carga
	* @param
	* @return array con tipos de carga
	*/
	public function obtener_RSU(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculos | obtener_RSU()');
		$aux = $this->rest->callAPI("GET",REST_RESI."/tablas/tipo_carga");
		$aux =json_decode($aux["data"]);
		return $aux->valores->valor;
	}

	/**
    * Obtiene formulario asociado a vehiculo
    * @param  
    * @return array valor , form_id
    */
    public function obtener_form_vehiculo(){   
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculos | obtener_form_vehiculo()');  
        $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/configuraciones_log");
        $aux =json_decode($aux["data"]);
        $vals = $aux->valores->valor;
        //obtengo si es vehiculo
        foreach ($vals as $v) {
                if (isset($v->valor) && $v->valor === 'form_vehiculo') {
                    $data = isset($v->valor2) ? $v->valor2 : null;
                    break;
                }
            }
        return $data;
    }


	/**
    * verifica si existe el dominio en base de datos
    * @param  
    * @return boolean true,false
    */
    function valida_Dominio($dominio){
        $aux = $this->rest->callAPI("GET",REST_RESI2."/valida/dominio/".$dominio);
        $aux =json_decode($aux["data"]);
        return $aux->resultado->existe;
	}

	     /**
    * Actualiza un  equipo
    * @param  array data
    * @return array int status
    */
    function Set_InfoId_Vehiculo($data){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculos | Set_InfoId_Vehiculo()');
        $post["equipo_info_id"] = $data;
        $aux = $this->rest->callAPI("PUT",REST_RESI2."/equipo/infoId", $post);
        $aux =json_decode($aux["status"]);
        return $aux;
    }


	function getDataOtporEquiId($equi_id)
	{
		$aux = $this->rest->callAPI("GET",REST_RESI2."/orden/transporte/equipo/".$equi_id);
    	$data =json_decode($aux["data"]);
    	return $data->orden_transportes->orden_transporte;
	}
}

?>