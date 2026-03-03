<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Representa a la Entidad Vehiculo
 *
 * @autor Ze Roberto Basañes
 */
class Vehiculo extends CI_Controller
{

    /**
     * Constructor de clase
     * @param 
     * @return 
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('general/Vehiculos');
    }

    /**
     * Carga pantalla ABM vehiculos y listado
     * @param 
     * @return view vehiculos
     */
    function templateVehiculos()
    {
        log_message('DEBUG', '#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | templateVehiculos()');
        $this->load->model('general/Choferes');
        $data["vehiculos"] = $this->Vehiculos->Listar_Vehiculo();
        $data["transportista"] = $this->Vehiculos->Obtener_Transportista();
        $data['Rsu'] = $this->Vehiculos->obtener_RSU();
        $data['tran_id'] = $this->Choferes->getIDTransportista();//Solo debe poder seleccionarse el transportista que esta logueado
        $data['empr_id'] = empresa();
        $data['form_id'] = $this->Vehiculos->obtener_form_vehiculo();
        $this->load->view('vehiculos/registrar_vehiculo', $data);
    }

    /**
     * Guarda vehiculo nuevo. Crea contenedor y lo asocia en caso de tener tolva
     * @param array datos vehiculo
     * @return string "ok, error"
     */
    function Guardar_Vehiculo()
    {
        log_message('DEBUG', '#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | Guardar_Vehiculo()');
        $datos = $this->input->post('datos');

        // Guardo datos necesarios para tolva antes de limpiar el array
        $optionsTolva = $datos['optionsTolva'];
        $capacidad = $datos['capacidad'];
        // $rsu = $datos['rsu']; // No se usa en la logica de tolva actual, pero estaba en el unset

        unset($datos['optionsTolva'], $datos['capacidad'], $datos['rsu']);

        // 1. Guardo Vehiculo primero para obtener equi_id
        $equi_id = $this->Vehiculos->Guardar_Vehiculos($datos);

        if ($equi_id) {

            // 2. Si tiene tolva creo contenedor y asocio
            if ($optionsTolva == "si") {

                $this->load->model('general/Contenedores');

                // El codigo del contenedor es TIPOS_VEHICULOS_TOLVA + equi_id del vehiculo
                $data['codigo'] = TIPOS_VEHICULOS_TOLVA . $equi_id;
                $data['descripcion'] = $datos['dominio'];
                $data['capacidad'] = $capacidad;
                $data['anio_elaboracion'] = ''; // Estaba vacio en el original
                $data['tara'] = $datos['tara'];
                $data['esco_id'] = 'estado_contenedorINGRESADO';
                $data['habilitacion'] = 'habilitacion_contenedorUso';
                $data['fec_alta'] = $datos['fecha_ingreso'];
                $data['usuario_app'] = userNick();
                $data['tran_id'] = $datos['tran_id'];
                $data['imagen'] = $datos['imagen'];

                $cont_id = $this->Contenedores->Guardar_Contenedor($data)->respuesta->cont_id;

                log_message('DEBUG', '#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | Guardar_Vehiculo(): >> DATA(CONTENEDOR) ' . json_encode($data));

                if ($cont_id) {
                    // 3. Actualizo vehiculo con cont_id
                    $datos_update = array(
                        'equi_id' => $equi_id,
                        'cont_id' => $cont_id
                    ); 
                    $this->Vehiculos->Actualizar_Vehiculo_Contenedor($datos_update);

                    // asocio tipos carga a contenedor
                    $datos_tipo_carga = $this->input->post('tipocarga');
                    if ($datos_tipo_carga) {
                        foreach ($datos_tipo_carga as $key => $carga) {
                            $tipocarga[$key]['cont_id'] = $cont_id;
                            $tipocarga[$key]['tica_id'] = $carga;
                        }
                        $this->Contenedores->Guardar_tipo_carga($tipocarga);
                    }
                } else {
                    log_message('ERROR', '#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | Guardar_Vehiculo() >> ERROR: NO GUARDO CONTENEDOR(EQUIPO CON TOLVA)');
                    // No retorno error fatal aqui porque el vehiculo ya se creo, solo logueo error de contenedor
                }
            }

            echo json_encode([
                "status" => "ok",
                "equi_id" => $equi_id
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Error al crear el vehiculo."
            ]);
        }
    }

    /**
     * Tabla con listado de todos los Vehiculos
     * @param 
     * @return view lista_vehiculos
     */
    function Listar_Vehiculo()
    {
        log_message('DEBUG', '#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | Listar_Vehiculo()');
        $data["vehiculos"] = $this->Vehiculos->Listar_Vehiculo();
        $this->load->view('vehiculos/lista_vehiculos', $data);
    }

    /**
     * Elimina un vehiculo dado un id
     * @param  string id vehiculo , 1 
     * @return string "ok, error"
     */
    function Borrar_Vehiculo()
    {
        log_message('DEBUG', '#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | Borrar_Vehiculo()');
        $resp = $this->Vehiculos->Borrar_vehiculo($this->input->post('eliminar'));
        if ($resp == 1) {
            echo 'ok';
        } else {
            log_message('ERROR', '#TRAZA|Contenedor|Borrar_Contenedor() >> $resp: ' . $resp);
            echo 'error';
        }
    }

    /**
     * Actualiza un Vehiculo
     * @param  string datos de vehiculo 
     * @return string "ok, error"
     */
    function Actualizar_Vehiculo()
    {
        log_message('DEBUG', '#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | Actualizar_Vehiculo()');
        $datos = $this->input->post('vehiculo');
        $resp = $this->Vehiculos->actualizar_Vehiculo($datos);
        if ($resp) {
            echo 'ok';
        } else {
            log_message('ERROR', '#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | Actualizar_Vehiculo() >> $resp: ' . json_encode($resp));
            echo 'error';
        }

    }

    /**
     * Obtiene transpostista para listar en el select
     * @param  
     * @return json transportistas
     */
    function ObtenerTransportistas()
    {
        log_message('INFO', '#TRAZA|Vehiculo|ObtenerTransportistas() >>');
        $dato["tran"] = $this->Vehiculos->Obtener_Transportista();
        echo json_encode($dato);
    }

    function GetImagen()
    {
        log_message('INFO', '#TRAZA|Vehiculo|GetImagen() >>');
        $id = $this->input->post("vehi_id");
        $dato = $this->Vehiculos->obtenerImagen_Vehi_Id($id);
        echo json_encode($dato);
    }


    /**
     *verifica si ya fue cargado el dominio
     * @param 
     * @return true,false
     */

    function valida_dominio()
    {
        log_message('DEBUG', '#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | valida_dominio()');
        $dominio = $this->input->get('dominio');
        $data = $this->Vehiculos->valida_Dominio($dominio);
        echo $data;
    }

    /**
     *Actualiza un transportista en especifico 
     * @param 
     * @return string "ok","error"
     */
    public function set_InfoId_vehiculo()
    {
        log_message('DEBUG', '#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | set_InfoId_vehiculo()');
        $equi_id = $this->input->post('equi_id');
        $info_id = $this->input->post('info_id');
        $datos = [
            'equi_id' => $equi_id,
            'info_id' => $info_id
        ];
        // actualiza los datos del transportista
        $resp = $this->Vehiculos->Set_InfoId_Vehiculo($datos);
        if ($resp == 1) {
            echo "ok";
        } else {
            log_message('ERROR', '#TRAZA|Transportista|set_InfoId_transportista() >> $resp: ' . $resp);
            echo "error";
        }
    }

    /**
     *Pantalla de OT al escanear qr transportista con token 
     * @param 
     * @return view vista_cliente
     */

    public function vistaCliente()
    {

        //obtengo id de equipo de la url
        $url_info = $_SERVER["REQUEST_URI"];

        $components = parse_url($url_info);

        parse_str($components['query'], $results);

        $equi_id = $results['id'];
        //datos de la ot asociada al equipo
        $data['dataOt'] = $this->Vehiculos->getDataOtporEquiId($equi_id);
        return $this->load->view(RESI . 'vehiculos/vista_cliente', $data);

    }

      /**
     * Actualiza un Vehiculo
     * @param  string datos de vehiculo 
     * @return string "ok, error"
     */
    function Actualizar_Vehiculo_Contenedor()
    {
        log_message('DEBUG', '#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | Actualizar_Vehiculo_Contenedor()');
        $datos = $this->input->post('vehiculo');
        $resp = $this->Vehiculos->actualizar_Vehiculo_Contenedor($datos);
        if ($resp) {
            echo 'ok';
        } else {
            log_message('ERROR', '#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | Actualizar_Vehiculo_Contenedor() >> $resp: ' . json_encode($resp));
            echo 'error';
        }

    }

}


?>