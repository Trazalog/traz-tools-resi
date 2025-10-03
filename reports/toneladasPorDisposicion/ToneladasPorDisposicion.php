<?php

require APPPATH . '/modules/'.RESI."/libraries/koolreport/core/autoload.php";
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;
use \koolreport\processes\OnlyColumn;

//Define the class
class ToneladasPorDisposicion extends \koolreport\KoolReport
{
    use \koolreport\codeigniter\Friendship;

    function cacheSettings()
    {
        return array(
            "ttl" => 60, //determina cuántos segundos será válido el caché
        );
    }

    protected function settings()
    {
        log_message('DEBUG', '#RECIDUOS| #TONELADASPORDISPOSICION.PHP|#TONELADASPORDISPOSICION|#SETTINGS| #INGRESO');
        // Convierte stdClass -> array asociativo si es necesario
        $data = array_map(function($row) {
            return (array) $row;
        }, $this->params);

        return array(
            "dataSources" => array(
                "apiarray" => array(
                    "class" => '\koolreport\datasources\ArrayDataSource',
                    "dataFormat" => "associate",
                    "data" => $data,
                )
            )
        );

    }

    protected function setup()
    {
        log_message('DEBUG', '#RECIDUOS| #TONELADASPORDISPOSICION.PHP|#TONELADASPORDISPOSICION|#SETUP| #INGRESO');

        $this->src("apiarray")

        ->pipe($this->dataStore("data_toneladasPorDisposicion_table"));
    }
}