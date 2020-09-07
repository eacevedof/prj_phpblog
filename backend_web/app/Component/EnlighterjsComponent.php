<?php
namespace App\Component;

class EnlighterjsComponent
{
    private $data;
    private $codes;
    private $pattern = "#<code[\s]+data-enlighter-language=\"[a-z]+\">(.*?)</code>#s";
    private $replaced;

    public function __construct(string $data)
    {
        $this->data = $data;
        $this->replaced = $data;
    }

    private function _get_codes()
    {
        //data-enlighter-language="less"
        $result = [];
        preg_match_all($this->pattern,$this->data,$result);
        return [
            "elements" => $result[0] ?? [],
            "innerhtml" => $result[1] ?? [],
        ];
    }

    private function _add_replaced()
    {
        $this->codes = $this->_get_codes();
        foreach ($this->codes["elements"] as $i => $element)
        {
            $innerhtml = $this->codes["innerhtml"][$i];
            $entities = htmlentities($innerhtml);
            $replaced = str_replace($innerhtml,$entities,$element);
            $this->codes["replaced"][$i] = $replaced;
        }
    }

    private function _replace_data()
    {
        foreach ($this->codes["elements"] as $i => $element)
        {
            $replaced = $this->codes["replaced"][$i];
            $this->replaced = str_replace($element, $replaced, $this->replaced);
        }
    }

    public function get_cleaned()
    {
        $this->_add_replaced();
        $this->_replace_data();

        return $this->replaced;
    }
}
