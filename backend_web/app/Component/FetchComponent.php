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

    public function set_request_uri($url){$this->request_url = $url; return $this;}

    public function add_header($k,$v){$this->headers[]="$k=$v"; return $this;}

    public function add_get($k,$v){$this->gets[]="$k=$v"; return $this;}

    public function add_post($k,$v){$this->posts[]="$k=$v"; return $this;}

    public function reset_header(){$this->headers=[]; return $this;}

    public function reset_get(){$this->gets=[]; return $this;}

    public function reset_post(){$this->posts=[]; return $this;}

    private function _curl_setopts()
    {
        //curl_setopt(): changes the cURL session behavior with options
        foreach ($this->headers as $opt => $value)
            curl_setopt($this->urlinit, $opt, $value);
        if($this->posts)
            curl_setopt($this->urlinit, CURLOPT_POSTFIELDS, $this->posts);
        return $this;
    }

    private function _load_urlinit()
    {
        $this->urlinit = curl_init($this->request_url);
        return $this;
    }

    private function _handle_post()
    {
        if($this->posts)
        {

        }
        return $this;
    }

    public function get()
    {

        $this->_load_urlinit();

                   // initializes a cURL session
        $this->_curl_setopts();
        $r = curl_exec($url);       // executes the started cURL session
        curl_close($url);               // closes the cURL session and deletes the variable made by curl_init();
        return $r;
    }
}
