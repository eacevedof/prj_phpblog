<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name \App\Services\Open\ToSqlService
 * @file ToSqlService.php
 * @version 1.0.0
 * @date 23-11-2020 20:46
 * @observations
 */
namespace App\Services\Open;

use App\Services\BaseService;
use App\Component\CrudComponent;
use \Exception;

final class ToSqlService extends BaseService
{
    private const COLSEPS = [
        "tab"=>"\t",
        "semicolon"=>";","comma"=>",","pipe"=>"|","hash"=>"#",
        "space-1"=>" ",
        "space-2"=>"  ",
        "space-3"=>"   "
    ];

    private const TO_SQL = ["insert","update"];
    private const FROM_FORMAT = ["csv","json","php-array","python-list"];

    private $input;
    private $colsep;
    private $from;
    private $to;
    private $table;
    private $fields;
    private $lines;

    public function __construct($input=[])
    {
        //dd($input);
        $this->input = $input;
        $this->colsep = $this->_get_separator(($input["colsep"] ?? ""));
        if (!$this->colsep)
            throw new Exception("Separador de columna inválido $this->colsep");

        $this->table = trim($input["table"] ?? "");
        if (!$this->table)
            throw new Exception("No se ha proporcionado el nombre de la tabla");

        $this->from = $input["from"] ?? "csv";
        if (!in_array($this->from, self::FROM_FORMAT))
            throw new Exception("Formato de origen no reconocido");

        $this->to = $input["to"] ?? "insert";
        if (!in_array($this->to, self::TO_SQL))
            throw new Exception("Formato de destino no reconocido");

        $this->fields = $this->_get_fields();
        if (!$this->fields)
            throw new Exception("No se ha proporcionado los nombres de los campos");

        $this->lines = $this->_get_lines();
        if (!$this->lines)
            throw new Exception("No hay contenido a transformar");
    }

    private function _get_lines(): array
    {
        $data = trim($this->input["struct"] ?? "");
        $lines = explode("\n", $data);
        return $lines;
    }

    private function _get_separator(string $sep): string
    {
        return self::COLSEPS[$sep] ?? "";
    }

    private function _get_exploded_fields(): array
    {
        $strfields = trim($this->input["fields"] ?? "");
        if(strstr($strfields,$this->colsep)) return explode($this->colsep, $strfields);
        if(strstr($strfields,"\t")) return explode("\t", $strfields);
        if(strstr($strfields,",")) return explode(",", $strfields);
        if(strstr($strfields,";")) return explode(";", $strfields);
        if(strstr($strfields,"#")) return explode(";", $strfields);
        if(strstr($strfields," ")) return explode(" ", $strfields);
        return [];
    }

    private function _get_fields(): array
    {
        $fields = $this->_get_exploded_fields();
        if (!$fields) return [];
        $fields = array_map(function ($field){
            $field = str_replace(["'","`","\"",".","$","´","*"],"", trim($field));
            if (!$field) return null;
            return $field;
        }, $fields);

        $fields = array_filter($fields);
        $fields = array_unique($fields);
        return $fields;
    }

    private function _get_mapped_data(): array
    {
        $colsep = $this->colsep;
        $rows = [];
        foreach ($this->lines as $line){
            $values = explode($colsep, $line);
            $row = [];
            foreach ($values as $i=>$value) {
                $field = $this->fields[$i] ?? "";
                if (!$field) continue;
                $row[$field] = $value;
            }
            $rows[] = $row;
        }
        return $rows;
    }

    private function _get_crud(): CrudComponent
    {
        return new CrudComponent();
    }

    private function _get_insert(): array
    {
        $mapped = $this->_get_mapped_data();
        $insert = [];
        foreach ($mapped as $row) {
            $crud = $this->_get_crud()->set_table($this->table);
            foreach ($row as $field=>$value) {
                $crud->add_insert_fv($field, $value);
            }
            $insert[] = $crud->autoinsert()->get_sql();
        }
        return $insert;
    }

    private function _get_update(): array
    {
        $mapped = $this->_get_mapped_data();
        $update = [];
        foreach ($mapped as $row) {
            $crud = $this->_get_crud()->set_table($this->table);
            foreach ($row as $field=>$value) {
                $crud->add_update_fv($field, $value);
            }
            $update[] = $crud->autoupdate()->get_sql();
        }
        return $update;
    }

    public function get(): array
    {
        switch ($this->to) {
            case "insert": return $this->_get_insert();
            case "update": return $this->_get_update();
        }
        return [];
    }
}
