<?php

require APPPATH . '/modules/' . RESI . "/libraries/koolreport/core/autoload.php";
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;
use \koolreport\processes\OnlyColumn;

//Define the class
class Incidencia extends \koolreport\KoolReport
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
        log_message('DEBUG', '#INCIDENCIA|SETTINGS');

        $data = [];

        if (!empty($this->params) && is_array($this->params)) {
            foreach ($this->params as $row) {
                $data[] = (array)$row;
            }
        }

        return [
            "dataSources" => [
                "apiarray" => [
                    "class" => '\koolreport\datasources\ArrayDataSource',
                    "dataFormat" => "associate",
                    "data" => $data,
                ]
            ]
        ];
    }


protected function setup()
{
    $src = $this->src("apiarray");

    if(!$src){
        $this->dataStore("data_incidencia_table")->data([]);
        return;
    }

    $src->pipe($this->dataStore("data_incidencia_table"));
}
}