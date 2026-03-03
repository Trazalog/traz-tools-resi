<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Representa a la Entidad Contenedores
 *
 * @autor SLedesma
 */
class OrdenesMuniMasivas extends CI_Model
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
     * Obtiene el tipo de carga del contenedor 
     * @param 
     * @return array tipo
     */
    // function obtener_Tipo_Carga(){
    // log_message('INFO','#TRAZA|Contenedores|obtener_Tipo_Carga() >> '); 
    // $aux = $this->rest->callAPI("GET",REST_RESI."/tablas/tipo_carga");
    // $aux =json_decode($aux["data"]);
    // return $aux->valores->valor;
    // }

    /**
     * Trae listado de Todos loas zonas
     * @param 
     * @return string data
     */
    // function obtener_Zona()
    // {
    //     log_message('INFO','#TRAZA|TemplateOrdenTP|obtenerZona() >> '); 
    //     $aux = $this->rest->callAPI("GET",REST_RESI."/zonas");
    //     $aux =json_decode($aux["data"]);
    //     return $aux->zonas->zona;
    // }

    /**
     * Trae listado de Todos los Circuitos
     * @param 
     * @return string data
     */
    // function obtener_Circuito()
    // {
    //     log_message('INFO','#TRAZA|TemplateOrdenTP|obtenerCircuito() >> '); 
    //     $aux = $this->rest->callAPI("GET",REST_RESI."/circuitos");
    //     $aux =json_decode($aux["data"]);
    //     return $aux->circuitos->circuito;
    // }

    // function Templatefiltradas($data)
    // {
    //     log_message('INFO','#TRAZA|Contenedores|borrar_tipo_Carga() >> '); 
    //     $post2["filtrar"] = $data;
    //     $aux= $this->rest->callAPI("PUT",REST_RESI."recurso", $post2);
    //     $aux =json_decode($aux["data"]);
    //     return $aux;
    // }

    function Listar_OT()
    {
        log_message('INFO', '#TRAZA|TemplateOrdenTP|Listar_templateOT() >> ');
        $usuario_app = userNick();
        $sotr = $this->rest->callAPI("GET", REST_RESI . "/solicitantesTransporte/$usuario_app");
        $sotraux = json_decode($sotr["data"]);
        $id_sotr = $sotraux->solicitantes_transporte->sotr_id;
        $aux = $this->rest->callAPI("GET", REST_RESI . "/templatesOrdenTransporte/list/solicitanteTransporte/$id_sotr");
        $aux = json_decode($aux["data"]);
        return $aux->templatesOrdenTransporte->templateOrdenTransporte;
    }

    function Ejecutar_OT($data, $coen_id)
    {

        log_message('INFO', '#TRAZA|TemplateOrdenTP|Listar_templateOT() >> ');
        $usuario_app = userNick();
        $sotr = $this->rest->callAPI("GET", REST_RESI . "/solicitantesTransporte/$usuario_app");
        $sotraux = json_decode($sotr["data"]);
        $id_sotr = $sotraux->solicitantes_transporte->sotr_id;
        $data["sotr_id"] = $id_sotr;
        $data["usuario_app"] = $usuario_app;
        $post["ordenTransporte"] = $data;
        $resp = $this->rest->callAPI("POST", API_URL . "/ordenTransporte/desdeTemplate", $post);

        // BUSCO EL ERROR ESPECIFICO EN EL STRING CRUDO (POR SI EL JSON ESTA MALFORMADO)
        if (strpos($resp["data"], "TOOLSERROR:RECI_NO_VACIO_DIST_LOTE_IGUAL_ART") !== false) {
            // EXTRAIGO EL TOOLSERROR ESPECIFICO
            if (preg_match('/TOOLSERROR:RECI_NO_VACIO_DIST_LOTE_IGUAL_ART[^\s<"]*/', $resp["data"], $matches)) {

                //elimino el contenedor entregado
                $url = REST_RESI2 . "/contenedor/entregado";
                $data = [
                    '_delete_contenedor_entregado' => [  
                        'coen_id' => $coen_id
                    ]
                ];
                $delete = $this->rest->callAPI('DELETE', $url, $data);
                return $matches[0];
            }
        }

        if (strpos($resp["data"], "TOOLSERROR:RECI_NO_VACIO_DIST_ART") !== false) {
            // EXTRAIGO EL TOOLSERROR ESPECIFICO
            if (preg_match('/TOOLSERROR:RECI_NO_VACIO_DIST_ART[^\s<"]*/', $resp["data"], $matches)) {
                //elimino el contenedor entregado
                $url = REST_RESI2 . "/contenedor/entregado";
                $data = [
                    '_delete_contenedor_entregado' => [ 
                        'coen_id' => $coen_id
                    ]
                ];
                $delete = $this->rest->callAPI('DELETE', $url, $data);

                return $matches[0];
            }
        }

        if (strpos($resp["data"], "DATOS_BATCH_NF") !== false) {
            $delete = $this->rest->callAPI("DELETE",REST_RESI2 . "/contenedor/entregado/" . $coen_id);
            return 0;
        }   

        $aux = json_decode($resp["status"]);
        if ($aux == 1) {
            return 1;
        } else {
            return 0;
        }
    }
}