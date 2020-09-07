<?php
namespace App\Services\Common\Email;

use \Exception;
use \App\Emails\ContactEmail;

class EmailContactService extends BaseemailService
{
    public function __construct($post)
    {
        $this->logd($post,"emailcontactservice.construct");
        $this->data = $this->_get_data($post);
    }

    private function _get_trimmed($key,$post)
    {
        return trim($post[$key] ?? "");
    }

    private function _get_data($post)
    {
        return [
            "subject" => $this->_get_trimmed("subject",$post),
            "message" => $this->_get_trimmed("message",$post),
            "email"   => $this->_get_trimmed("email",$post),
            "phone"   => $this->_get_trimmed("phone",$post),
            "name"    => $this->_get_trimmed("name",$post),
        ];
    }

    protected function _get_mailable()
    {
        //from, subject y attachments van aqui
        return (new ContactEmail($this->data))
                ->set_from($this->get_env("MAIL_FROM_ADDRESS"),$this->get_env("MAIL_FROM_NAME"))
                ->set_subject($this->data["subject"])
                ->set_attachments($this->attachments);
    }

    protected function _exceptions()
    {
        //if(!$this->data) throw new \Exception("EmailContactService: No data provided");
        if(!$this->data["name"]) throw new Exception("EmailContactService: No name provided");
        if(!$this->data["email"]) throw new Exception("EmailContactService: No email provided");
        if(!$this->data["subject"]) throw new Exception("EmailContactService: No subject provided");
        if(!$this->data["message"]) throw new Exception("EmailContactService: Message is empty");
    }

    public function send()
    {
        $this->_exceptions();

        //viewdata, from, subject, attachments
        $mailable = $this->_get_mailable();

        //fachada que necesita un mailable
        //locale, to, cc, bcc
        $this->_get_mailobj("es")
            ->to($this->data["email"])
            ->bcc($this->get_env("MAIL_TO"))
            ->send($mailable);

        return true;
    }
}
