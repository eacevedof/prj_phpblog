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
    private $keys;

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

        $this->keys = $this->_get_fields($input["keys"]);
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

    private function _get_exploded_fields(string $fields=""): array
    {
        $strfields = trim($this->input["fields"] ?? "");
        if ($fields) $strfields = $fields;
        if (!strstr($strfields,",") && strstr($strfields, " ")) return explode(" ", $strfields);
        if (!strstr($strfields,",") && strstr($strfields, $this->colsep)) return explode($this->colsep, $strfields);
        return explode(",", $strfields);
    }

    private function _get_fields(string $strfields=""): array
    {
        $fields = $this->_get_exploded_fields($strfields);
        if (!$fields) return [];
        $fields = array_map(function ($field){
            $field = str_replace(["'","`","\"",".","$","´","*"],"", trim($field));
            if (!$field) return null;
            return $field;
        }, $fields);

        $fields = array_filter($fields);
        $fields = array_unique($fields);
        $fields = array_values($fields);
        return $fields;
    }

    private function _get_mapped_from_csv(): array
    {
        $colsep = $this->colsep;
        $rows = [];
        foreach ($this->lines as $line){
            $values = explode($colsep, $line);
            //print_r($this->fields);print_r($line);dd($values);
            $row = [];
            foreach ($values as $i=>$value) {
                if (!is_string($value)) continue;
                $field = $this->fields[$i] ?? "";
                if (!$field) continue;

                $row[$field] = strcmp($value,"\N")===0 ? null : $value;
            }
            $rows[] = $row;
        }
        return $rows;
    }

    private function _get_mapped_from_json(): array
    {
        $json = $this->input["struct"];
        $r = \json_decode($json,1);
        if (json_last_error() === JSON_ERROR_NONE)
            return $r;
        throw new \Exception("Documento json incorrecto");
    }

    private function _get_mapped_from_phparray(): array
    {
        try {
            $string = $this->input["struct"];
            return print_r_reverse($string);
        }
        catch (Exception $e)
        {
            throw new \Exception("print_r Array incorrecto");
        }
    }

    private function _get_mapped_from_python(): array
    {
        $json = $this->input["struct"];
        $r = \json_decode($json,1);
        if (json_last_error() === JSON_ERROR_NONE)
            return $r;

        throw new \Exception("Lista de diccionarios incorrecta");
    }

    private function _get_mapped_data(): array
    {
        switch ($this->from) {
            case "csv": return $this->_get_mapped_from_csv();
            case "json": return $this->_get_mapped_from_json();
            case "php-array": return $this->_get_mapped_from_phparray();
            case "python-list": return $this->_get_mapped_from_python();
        }
        return [];
    }

    private function _get_crud(): CrudComponent
    {
        return new CrudComponent();
    }

    private function _get_insert(): array
    {
        $mapped = $this->_get_mapped_data();
        //print_r($mapped);die;
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
        //dd($mapped);
        $update = [];
        foreach ($mapped as $row) {
            $crud = $this->_get_crud()->set_table($this->table);
            foreach ($row as $field=>$value) {
                if (in_array($field, $this->keys))
                    $crud->add_pk_fv($field, $value);
                else
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

function print_r_reverse($in)
{
    $lines = explode("\n", trim($in));
    if (trim($lines[0]) != 'Array') {
        // bottomed out to something that isn't an array
        return $in;
    } else {
        // this is an array, lets parse it
        if (preg_match("/(\s{5,})\(/", $lines[1], $match)) {
            // this is a tested array/recursive call to this function
            // take a set of spaces off the beginning
            $spaces = $match[1];
            $spaces_length = strlen($spaces);
            $lines_total = count($lines);
            for ($i = 0; $i < $lines_total; $i++) {
                if (substr($lines[$i], 0, $spaces_length) == $spaces) {
                    $lines[$i] = substr($lines[$i], $spaces_length);
                }
            }
        }
        array_shift($lines); // Array
        array_shift($lines); // (
        array_pop($lines); // )
        $in = implode("\n", $lines);
        // make sure we only match stuff with 4 preceding spaces (stuff for this array and not a nested one)
        preg_match_all("/^\s{4}\[(.+?)\] \=\> /m", $in, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
        $pos = array();
        $previous_key = '';
        $in_length = strlen($in);
        // store the following in $pos:
        // array with key = key of the parsed array's item
        // value = array(start position in $in, $end position in $in)
        foreach ($matches as $match) {
            $key = $match[1][0];
            $start = $match[0][1] + strlen($match[0][0]);
            $pos[$key] = array($start, $in_length);
            if ($previous_key != '') $pos[$previous_key][1] = $match[0][1] - 1;
            $previous_key = $key;
        }
        $ret = array();
        foreach ($pos as $key => $where) {
            // recursively see if the parsed out value is an array too
            $ret[$key] = print_r_reverse(substr($in, $where[0], $where[1] - $where[0]));
        }
        return $ret;
    }
}
