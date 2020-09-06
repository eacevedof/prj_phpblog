<?php
namespace App\Services\Common\Email;
use App\Services\BaseService;
use Illuminate\Support\Facades\Mail;
use \Exception;

class EmailService extends BaseService
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    private function _get_content()
    {
        return [
            "title" => "eduardoaf.com | Contacto",
            "subject" => $this->data["subjet"] || " subject xxx",
            "message" => $this->data["message"] || " some message ",
        ];
    }

    public function send_contact()
    {
        $content = $this->_get_content();

        //Mail::to("eacevedof@gmail.com")->send(new \App\Emails\MyTestMail($details));
        $emailto = $this->get_env("MAIL_TO");


        if(Mail::failures())
            throw new Exception(Mail::failures());
    }
}
