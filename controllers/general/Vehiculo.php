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
    function templateVehiculos(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | templateVehiculos()');
        $data["vehiculos"] = $this->Vehiculos->Listar_Vehiculo();
        $data["transportista"] = $this->Vehiculos->Obtener_Transportista();
        $data['Rsu'] = $this->Vehiculos->obtener_RSU();
        $this->load->view('vehiculos/registrar_vehiculo',$data);
    }

    /**
    * Guarda vehiculo nuevo. Crea contenedor y lo asocia en caso de tener tolva
    * @param array datos vehiculo
    * @return string "ok, error"
    */
    function Guardar_Vehiculo(){
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | Guardar_Vehiculo()');
        $datos =  $this->input->post('datos');

        // si tiene tolva doy de alta y asocio un contenedor y recipiente
        if ($datos['optionsTolva'] == "si") {

            $this->load->model('general/Contenedores');
            $data['codigo'] = $datos['codigo'];
            $data['descripcion'] = $datos['dominio'];
            $data['capacidad'] = $datos['capacidad'];
            $data['anio_elaboracion'] = $datos[''];
            $data['tara'] = $datos['tara'];
            $data['esco_id'] = 'estado_contenedorINGRESADO';
            $data['habilitacion'] = 'habilitacion_contenedorUso';
            $data['fec_alta'] = $datos['fecha_ingreso'];
            $data['usuario_app'] = userNick();
            $data['tran_id'] = $datos['tran_id'];
            $data['imagen'] = $datos['imagen'];

            $cont_id = $this->Contenedores->Guardar_Contenedor($data)->respuesta->cont_id;

            log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | Guardar_Vehiculo(): >> DATA(CONTENEDOR) '.json_encode($data));
            if ($cont_id) {
                $datos['cont_id'] = $cont_id;
            }else {
                log_message('ERROR','#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | Guardar_Vehiculo() >> ERROR: NO GUARDO CONTENEDOR(EQUIPO CON TOLVA)');
                echo "error";
                return;
            }
            // asocio tipos carga a contenedor
            $datos_tipo_carga = $this->input->post('tipocarga');
            foreach ($datos_tipo_carga as $key => $carga) {
                $tipocarga[$key]['cont_id'] = $cont_id;
                $tipocarga[$key]['tica_id'] = $carga;
            }
            $resp = $this->Contenedores->Guardar_tipo_carga($tipocarga);
        }
        unset($datos['optionsTolva'], $datos['capacidad'], $datos['rsu']);
        
        $resp = $this->Vehiculos->Guardar_Vehiculos($datos);

        $datos;
        if($resp == 1){
            echo "ok";
        }else{
            echo "error";
        }
    }

    /**
    * Tabla con listado de todos los Vehiculos
    * @param 
    * @return view lista_vehiculos
    */
    function Listar_Vehiculo(){   
        log_message('DEBUG','#TRAZA| TRAZ-TOOLS-RESIDUOS | Vehiculo | Listar_Vehiculo()');
        $data["vehiculos"] = $this->Vehiculos->Listar_Vehiculo();
        $this->load->view('vehiculos/lista_vehiculos',$data);
    }

    /**
    * Elimina un vehiculo dado un id
    * @param  string id vehiculo , 1 
    * @return string "ok, error"
    */
    function Borrar_Vehiculo(){
        log_message('INFO','#TRAZA|Vehiculo|Borrar_Vehiculo() >>');
        $resp = $this->Vehiculos->Borrar_vehiculo($this->input->post('eliminar'));
        if($resp == 1){
                echo 'ok';
        }else{
                log_message('ERROR','#TRAZA|Contenedor|Borrar_Contenedor() >> $resp: '.$resp); 
                echo 'error';
        }
    }

    /**
    * Actualiza un Vehiculo
    * @param  string datos de vehiculo 
    * @return string "ok, error"
    */    
    function Actualizar_Vehiculo(){
        log_message('INFO','#TRAZA|Vehiculo|Actualizar_Vehiculo() >>');
        $datos =  $this->input->post('vehiculo');
        $resp = $this->Vehiculos->actualizar_Vehiculo($datos);
        if($resp){
                echo 'ok';
        }else{
        log_message('ERROR','#TRAZA|Vehiculo|Actualizar_Vehiculo() >> $resp: '.$resp);
        echo 'error';
        }

    }

    /**
    * Obtiene transpostista para listar en el select
    * @param  
    * @return json transportistas
    */  
    function ObtenerTransportistas(){
        log_message('INFO','#TRAZA|Vehiculo|ObtenerTransportistas() >>');
        $dato["tran"]= $this->Vehiculos->Obtener_Transportista();
        echo json_encode($dato);
    }

    function GetImagen()
    {
        log_message('INFO','#TRAZA|Vehiculo|GetImagen() >>');
        $id = $this->input->post("vehi_id");
        $dato= $this->Vehiculos->obtenerImagen_Vehi_Id($id);
        echo json_encode($dato);
    }

    }
?>