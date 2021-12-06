<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name FormatSql
 * @file PrettyQueryService.php
 * @version 1.0.0
 * @date 23-11-2020 20:46
 * @observations
 */
namespace App\Services\Open;

use App\Services\BaseService;
use App\Component\CrudComponent;
use \Exception;

final class ToInsert extends BaseService
{
    private const COLSEPS = ["\t",";",",","|","#"];
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
        $this->input = $input;
        $this->colsep = $input["colsep"] ?? "\t";
        if (!in_array($this->colsep, self::COLSEPS))
            throw new Exception("Separador de columna inválido");

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

    private function _get_exploded_fields(): array
    {
        $strfields = trim($this->input["fields"] ?? "");
        if(strstr($strfields," ")) return explode(" ", $strfields);
        if(strstr($strfields,"\t")) return explode("\t", $strfields);
        if(strstr($strfields,",")) return explode(",", $strfields);
        if(strstr($strfields,";")) return explode(";", $strfields);
        return [];
    }

    private function _get_fields(): array
    {
        $fields = $this->_get_exploded_fields();
        if (!$fields) return [];
        $fields = array_map(function ($field){
            $field = str_replace(["'","`","\"",".","$","´","*"],"", trim($field));
            return $field;
        }, $fields);
        return $fields;
    }

    private function _get_mapped_data(): array
    {
        $rows = [];
        foreach ($this->lines as $line){
            $values = explode($this->colsep, $line);
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

    public function get(): array
    {
        return $this->_get_insert();
    }
}
