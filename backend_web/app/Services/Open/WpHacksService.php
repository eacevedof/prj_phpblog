<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name WpHacksService
 * @file WpHacksService.php
 * @version 1.0.0
 * @date 23-11-2020 20:46
 * @observations
 */
namespace App\Services\Open;

use App\Component\FetchComponent as Fetch;
use App\Services\BaseService;

class WpHacksService extends BaseService
{
    private $input;
    private $clean;
    private $errors;

    public function __construct($input=[])
    {
        $this->input = $input;
        $this->_load_clean();
    }

    private function _load_clean()
    {
        $this->clean = [
            "pattern" => $this->input["pattern"] ?? "",
            "flags"    => $this->input["flags"] ?? "",
            "text"    => $this->input["text"] ?? "",
        ];
    }

    private function _post()
    {
        $url = $this->get_env("API_IPBLOCKER_URL")."/read?context=c3&schemainfo=db-security";
        $data = [];
        //$curl = new Curl();
        //refactor de Curl
    }

    private function _get_token()
    {
        //login contra read-only
        $urllogin = $this->get_env("API_IPBLOCKER_URL")."/security/login";
        $user = $this->get_env("API_IPBLOCKER_USERNAME");
        $password = $this->get_env("API_IPBLOCKER_PASSWORD");
    }

    public function get_top50()
    {
        $token = $this->_get_token();
        //llamada a ipblocker
    }

    public function get()
    {
        $url = $this->get_env("API_CURL_TEST");
        $fetch = (new Fetch($url))->get();
        print_r($fetch);
    }
}

/*
queryparts[table]: app_ip_request r
queryparts[foundrows]: 1
queryparts[distinct]: 1
queryparts[fields][0]: r.id
queryparts[fields][1]: r.remote_ip
queryparts[fields][2]: i.country
queryparts[fields][3]: i.whois
queryparts[fields][4]: r.domain
queryparts[fields][5]: r.request_uri
queryparts[fields][6]: r.`get`
queryparts[fields][7]: CASE WHEN r.`get`!='' THEN 'GET' ELSE '' END hasget
queryparts[fields][8]: r.post
queryparts[fields][9]: CASE WHEN r.`post`!='' THEN 'POST' ELSE '' END haspost
queryparts[fields][10]: r.insert_date
queryparts[fields][11]: bl.insert_date bl_date
queryparts[fields][12]: bl.reason
queryparts[fields][13]: CASE WHEN bl.id IS NULL THEN '' ELSE 'INBL' END inbl
queryparts[joins][0]: LEFT JOIN app_ip_blacklist bl ON r.remote_ip = bl.remote_ip
queryparts[joins][1]: LEFT JOIN app_ip i ON r.remote_ip = i.remote_ip
queryparts[where][0]: i.whois NOT LIKE '%google%'
queryparts[where][1]: i.whois NOT LIKE '%msn%'
queryparts[where][2]: i.whois NOT LIKE '%sitelock.com%'
queryparts[orderby][0]: r.id DESC
queryparts[limit][perpage]: 50
queryparts[limit][regfrom]: 0

apify-usertoken: UnVCd0w5TUQweHNzOWJ3RTUrK3poMTUyOVdKVTBmNmNENVh1MnFWL3pSUDE4UWZUUUg0Yy9HTHNiYzlDZklpeTQ3cE9LMFdObVRDUnlGZy96dkFCQTFtYUkvZnZuMGRFdGhSNWNwT3JheWt1WGdkYjB0emJwNnhNaXdBNW1DWFlOMTZYRzVMMk1rUlVUL00wS1YyUU1tb0FaTTFZNUtRY1dQd1RpSWR4dS8wPQ==

*/