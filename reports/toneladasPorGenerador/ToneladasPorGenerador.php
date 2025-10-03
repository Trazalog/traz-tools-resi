<?php

require APPPATH . '/modules/'.RESI."/libraries/koolreport/core/autoload.php";
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;
use \koolreport\processes\OnlyColumn;

//Define the class
class ToneladasPorGenerador extends \koolreport\KoolReport
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
        $param = $this->params;

        if (is_array($param) && isset($param[0])) {
            $param = $param[0];
        }

        $rows = [];

        if (is_object($param) && isset($param->generadores->generador)) {
            $generadores = $param->generadores->generador;

            if (is_object($generadores)) {
                $rows[] = (array)$generadores;
            } elseif (is_array($generadores)) {
                foreach ($generadores as $g) {
                    $rows[] = (array)$g;
                }
            }
        }

        return [
            "dataSources" => [
                "apiarray" => [
                    "class" => '\koolreport\datasources\ArrayDataSource',
                    "dataFormat" => "associate",
                    "data" => $rows,
                ]
            ]
        ];
    }


    protected function setup()
    {
        log_message('DEBUG', '#RECIDUOS| #TONELADASPORGENERADOR.PHP|#TONELADASPORGENERADOR|#SETUP| #INGRESO');

        $this->src("apiarray")

        ->pipe($this->dataStore("data_toneladasPorGenerador_table"));
    }
}