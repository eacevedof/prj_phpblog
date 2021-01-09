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


}
