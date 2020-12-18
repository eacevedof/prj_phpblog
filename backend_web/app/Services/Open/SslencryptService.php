<?php
namespace App\Services\Open;

use App\Services\BaseService;

class SslencryptService extends BaseService
{
    private $input;
    private $clean;
    private $errors;

    private const TYPES = [
        "OPENSSL_RAW_DATA" => OPENSSL_RAW_DATA,
        "OPENSSL_ZERO_PADDING" => OPENSSL_ZERO_PADDING,
    ];

    public function __construct($input=[])
    {
        $this->input = $input;
        $this->_load_clean();
    }

    private function _load_clean()
    {
        $this->clean = [
            "method"      => $this->input["method"] ?? "",
            "function"    => $this->input["function"] ?? "",
            "password"    => $this->input["password"] ?? "",
            "salt"        => $this->input["salt"] ?? "",
            "option"      => $this->input["option"] ?? "",
            "iv"          => $this->input["iv"] ?? "",
            "data"        => $this->input["data"] ?? "",
        ];
    }

    private function _is_method()
    {
        $r = openssl_get_cipher_methods();
        return in_array($this->clean["method"],$r);
    }

    private function _exception()
    {
        if(!$this->clean["function"]) throw new \Exception("No function selected");
        if(!in_array($this->clean["function"],["openssl_encrypt","openssl_decrypt"])) throw new \Exception("No function selected");
        if(!$this->clean["method"]) throw new \Exception("No method configured");
        if(!$this->_is_method()) throw new \Exception("Invalid method");
        if(!in_array($this->clean["option"],["OPENSSL_RAW_DATA","OPENSSL_ZERO_PADDING"])) throw new \Exception("Wrong option selected");
        if(!$this->clean["iv"]) throw new \Exception("Wrong Iv");
    }

    private function _get_encrypted()
    {
        $password = $this->clean["password"];
        if($this->clean["salt"]) $password .= $this->clean["salt"];

        $hashpasswd = hash("sha256", $password);
        $hashiv = substr(hash("sha256",$this->input["iv"]),0,16);
        $encrypted = openssl_encrypt(
                        $this->clean["data"],
                        $this->clean["method"],
                        $hashpasswd,
                        self::TYPES[$this->clean["option"]],
                        $hashiv
                    );
        $base64 = base64_encode($encrypted);
        return $base64;
    }

    private function _get_decrypted()
    {
        $password = $this->clean["password"];
        if($this->clean["salt"]) $password .= $this->clean["salt"];

        $hashpasswd = hash("sha256", $password);
        $hashiv = substr(hash("sha256",$this->input["iv"]),0,16);
        $base64 = base64_decode($this->clean["data"]);

        $decrypted = openssl_decrypt(
            $base64,
            $this->clean["method"],
            $hashpasswd,
            self::TYPES[$this->clean["option"]],
            $hashiv
        );

        return $decrypted;
    }

    public function get()
    {
        $this->_exception();
        return $this->clean["function"] === "openssl_encrypt" ?
                        $this->_get_encrypted() :
                        $this->_get_decrypted();
    }
}
