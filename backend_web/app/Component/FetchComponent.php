<?php
namespace App\Component;

use \App\Traits\LogTrait as Log;

class FetchComponent
{
    use Log;

    private $iserror = FALSE;
    private $errors = [];

    private $options = [];

    private $headers = [];
    private $gets    = [];
    private $posts   = [];

    private $request_url;
    private $urlinit = null;

    public function __construct($request_url="")
    {
        if(!in_array("curl",get_loaded_extensions()))
            throw new \Exception("Curl extension not installed",503);
        $this->request_url = $request_url;
    }

    private function _curl_setopts()
    {
        if($this->headers)
            $this->_header_opts();

        foreach ($this->options as $opt => $value)
            curl_setopt($this->urlinit, $opt, $value);

        if($this->gets)
            $this->_get_opts();

        if($this->posts)
            $this->_post_opts();

        return $this;
    }

    private function _header_opts()
    {
        $headers = array_walk($this->headers, function (&$k,$v) {
            $k="$k: $v";
        });

        curl_setopt($this->urlinit, CURLOPT_HTTPHEADER, $headers);
    }

    private function _get_opts()
    {
        $geturl = $this->request_url . "?" . http_build_query($this->gets);
        curl_setopt($this->urlinit, CURLOPT_URL, $geturl);
        curl_setopt($this->urlinit, CURLOPT_RETURNTRANSFER, true);
    }

    private function _post_opts(){curl_setopt($this->urlinit, CURLOPT_POSTFIELDS, $this->posts);}

    private function _load_urlinit()
    {
        $this->urlinit = $this->posts ? curl_init($this->request_url): curl_init();
        return $this;
    }

    public function get()
    {
        //configura urlinit
        $this->_load_urlinit()
            //si hay posts crea la opción para este fin
            ->_curl_setopts();

        $r = curl_exec($this->urlinit);
        curl_close($this->urlinit);
        return $r;
    }

    public function set_request_uri($url){$this->request_url = $url; return $this;}

    public function add_header($k,$v){$this->headers[]="$k=$v"; return $this;}

    public function add_get($k,$v){$this->gets[]="$k=$v"; return $this;}

    public function add_post($k,$v){$this->posts[]="$k=$v"; return $this;}

    public function reset_header(){$this->headers=[]; return $this;}

    public function reset_get(){$this->gets=[]; return $this;}

    public function reset_post(){$this->posts=[]; return $this;}

    public function set_headers($headers){$this->headers = $headers; return $this;}
    public function set_post($post){$this->posts = $post; return $this;}
    public function set_get($get){$this->gets = $get; return $this;}
}
