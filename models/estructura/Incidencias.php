<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Representa a la Entidad Incidencias
*
* @autor SLedesma
*/
class Incidencias extends CI_Model{
    /**
    * Constructor de Clase
    * @param 
    * @return 
    */
    function __construct()
    {
        parent::__construct();
    }

    public function guardarIncidencias($datos){
        log_message('DEBUG','#TRAZA | TRAZ-TOOLS-RESIDUOS | Incidencias | guardarIncidencia()');
        $post["_post_incidencias"] = $datos;
        $aux = $this->rest->callAPI("POST",REST_RESI."/incidencias", $post);
        $aux = json_decode($aux["status"]);
        return $aux;
    }
    function ObtenerOT($nro)
    {
      $aux = $this->rest->callAPI("GET",REST_RESI."/ordenesTransporte/lista/$nro");
      $aux =json_decode($aux["data"]);
      return $aux->ordenTransporte->ordenesTransporte;
    }

    function getTipoResiduos()
    {
      log_message('INFO','#TRAZA|Contenedores|obtener_Estado() >> '); 
      $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/tipo_carga");
      $aux =json_decode($aux["data"]);
      return $aux->valores->valor;
    }

    function getDispFinal(){
      log_message('INFO','#TRAZA|Contenedores|obtener_Estado() >> '); 
      $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/disposicion_final");
      $aux =json_decode($aux["data"]);
      return $aux->valores->valor;
    }

    function getIncidencia()
    {
      log_message('INFO','#TRAZA|Contenedores|obtener_Estado() >> '); 
      $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/tipos_incidencia");
      $aux =json_decode($aux["data"]);
      return $aux->valores->valor;
    }

    function ObtenerProximoID()
    {
      $aux = $this->rest->callAPI("GET",REST_RESI."/ordenTransporte/prox");
      $aux =json_decode($aux["data"]);
      return $aux->respuesta;
    }

    function ListarIncidencias()
    {
      $aux = $this->rest->callAPI("GET",REST_RESI."/incidencias");
      $aux =json_decode($aux["data"]);
      return $aux->incidencias->incidencia;

    }

    function AnularIncidencia($data)
    {
      $post["_delete_incidencias"] = $data;
      $aux = $this->rest->callAPI("DELETE",REST_RESI."/incidencias",$post);
      $aux =json_decode($aux["status"]);
      return $aux;	
    }

}