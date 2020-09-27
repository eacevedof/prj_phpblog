<?php
namespace App\Component;

class EnlighterjsComponent
{
    private const PATTERN = "#<code[\s]+data-enlighter-language=\"[a-z]+\">(.*?)</code>#s";
    private $data;
    private $codes;
    private $replaced;

    public function __construct(string $data)
    {
        $this->data = $data;
        $this->replaced = $data;
    }

    private function _get_tags_code()
    {
        //data-enlighter-language="less"
        $result = [];
        preg_match_all(self::PATTERN, $this->data,$result);
        return [
            "elements" => $result[0] ?? [],
            "innerhtml" => $result[1] ?? [],
        ];
    }

    private function _replace_devlan()
    {
        $this->data = str_replace(" devlan=\""," data-enlighter-language=\"",$this->data);
        $this->replaced = str_replace(" devlan=\""," data-enlighter-language=\"",$this->replaced);
    }

    private function _html_entities()
    {
        $this->codes = $this->_get_tags_code();
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
        $this->_replace_devlan();
        $this->_html_entities();
        $this->_replace_data();
        //print_r($this->replaced);die;
        return $this->replaced;
    }
}
