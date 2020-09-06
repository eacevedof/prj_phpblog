<?php
namespace App\Services\Common\Email;

use Illuminate\Support\Facades\Mail;
use \Exception;
use \App\Emails\ContactEmail;

class EmailContactService extends BaseemailService
{
    public function __construct($post)
    {
        $this->data = $post;
    }

    private function _get_content()
    {
        return [
            "title" => "Eduardo A.F | Email",
            "subject" => $this->data["subject"] ?? " subject xxx ".get_date(),
            "message" => $this->data["message"] ?? " some message ",
        ];
    }

    protected function _get_mailable()
    {
        $data = $this->_get_content();
        //from, subject y attachments van aqui
        return (new ContactEmail($data))
                ->set_from($this->get_env("MAIL_FROM_ADDRESS"),$this->get_env("MAIL_FROM_NAME"))
                ->set_subject($data["subject"])
                ->set_attachments($this->attachments);
    }

    protected function _exceptions()
    {
        if(!$this->data) throw new \Exception("EmailContactService: No data provided");
        if(!$this->to) throw new \Exception("EmailContactService: No recipients supplied");
    }

    public function send()
    {
        $this->_exceptions();

        $mailable = $this->_get_mailable();
        //fachada que necesita un mailable
        $this->_get_mailobj()->send($mailable);

        if(Mail::failures())
            throw new Exception(Mail::failures());
    }
}
