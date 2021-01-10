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

    private $request_uri;
    private $objresource = null;

    private $isdebug = false;
    private $objdebug = null;

    public function __construct($request_uri="")
    {
        if(!in_array("curl",get_loaded_extensions()))
            throw new \Exception("Curl extension not installed",503);
        $this->request_uri = $request_uri;
    }

    public function is_debug($on=true, $mode="w")
    {
        $this->isdebug = $on;
        if(!$this->objdebug)
        {
            $logfile = "curl.log";
            $pathfile = dirname(__FILE__) . "/$logfile";
            $this->objdebug = fopen($pathfile, $mode);
        }
        return $this;
    }

    private function _add_debug($var,$title="")
    {
        if($this->isdebug && $this->objdebug)
        {
            if($title) $title = " $title:\n";
            $now = date("Ymd-H:i:s");
            $content = var_export($var,1);
            $content = "\n\n[$now]$title$content";
            fwrite($this->objdebug, $content);
        }
        return $this;
    }

    private function _curl_setopts()
    {
        $this->_add_debug($this->options, "options")
            ->_add_debug($this->headers, "headers")
            ->_add_debug($this->gets, "gets")
            ->_add_debug($this->posts, "posts");

        curl_setopt($this->objresource, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($this->objresource, CURLOPT_RETURNTRANSFER, true);
        foreach ($this->options as $opt => $value)
            curl_setopt($this->objresource, $opt, $value);

        if($this->headers) $this->_header_opts();
        $this->_get_opts();
        //dd($this->request_uri);
        if($this->posts) $this->_post_opts();

        return $this;
    }

    private function _header_opts()
    {
        $headers = [];
        foreach ($this->headers as $k => $v)
            $headers[] = "$k: $v";

        $this->_add_debug($headers,"CURLOPT_HTTPHEADER");
        curl_setopt($this->objresource, CURLOPT_HTTPHEADER, $headers);
    }

    private function _get_opts(){curl_setopt($this->objresource, CURLOPT_URL, $this->request_uri);}

    private function _post_opts()
    {
        curl_setopt($this->objresource, CURLOPT_POST, 1);
        $urlpost = http_build_query($this->posts);
        $this->_add_debug($urlpost,"CURLOPT_POSTFIELDS");
        curl_setopt($this->objresource, CURLOPT_POSTFIELDS, $urlpost);
    }

    private function _init_uri()
    {
        if(!$this->request_uri) throw new \Exception("Missing request_uri");
        if($this->gets) $this->request_uri = $this->request_uri . "?" . http_build_query($this->gets);
        $this->_add_debug($this->request_uri,"requesturi");
        return $this;
    }

    private function _init_resource()
    {
        $this->objresource = curl_init();
        return $this;
    }

    private function _debug()
    {
        if($this->isdebug) {
            curl_setopt($this->objresource, CURLOPT_VERBOSE, 1);
            curl_setopt($this->objresource, CURLOPT_STDERR, $this->objdebug);
        }
        return $this;
    }

    public function get_array()
    {
        $r = $this->get();
        try {
            $r = \json_decode($r,1);
        }
        catch (\Exception $e)
        {
            $this->_add_debug($e->getMessage(),"exception");
            $r = [];
        }
        return $r;
    }

    public function get()
    {
        //configura objresource
        $this->_init_uri()      //inicia req_uri con query string si procede
            ->_init_resource()  //a partir de req_uri y post crea un recurso vacio o con url
            ->_curl_setopts()
            ->_debug()
        ;

        $r = curl_exec($this->objresource);
        $this->_add_debug($r,"result");
        curl_close($this->objresource);
        return $r;
    }

    public function set_request_uri($uri){$this->request_uri = $uri; return $this;}

    public function add_header($k,$v){$this->headers[$k]=$v; return $this;}

    public function add_get($k,$v){$this->gets[$k]=$v; return $this;}

    public function add_post($k,$v){$this->posts[$k]=$v; return $this;}

    public function add_option($k,$v){$this->options[$k]=$v; return $this;}

    public function reset_header(){$this->headers=[]; return $this;}

    public function reset_get(){$this->gets=[]; return $this;}

    public function reset_post(){$this->posts=[]; return $this;}

    public function set_headers(array $headers){$this->headers = $headers; return $this;}

    public function set_post(array $post){$this->posts = $post; return $this;}

    public function set_get(array $get){$this->gets = $get; return $this;}

}
