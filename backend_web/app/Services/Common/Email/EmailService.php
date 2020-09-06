<?php
namespace App\Services\Common\Email;
use App\Services\BaseService;
use Illuminate\Support\Facades\Mail;
use \Exception;
use \App\Emails\ContactEmail;

class EmailService extends BaseService
{
    private $data;

    private $to;
    private $cc = [];
    private $bcc = [];
    private $attachments = [];

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

    private function _get_mailobj(){
        $mail = Mail::to(array_unique($this->to));
        $mail->locale("es");
        $mail->cc(array_unique($this->cc));
        $mail->bcc(array_unique($this->bcc));

        return $mail;
    }

    private function _get_mailable()
    {
        $data = $this->_get_content();
        //from, subject y attachments van aqui
        return (new ContactEmail($data))
                ->set_from($this->get_env("MAIL_FROM_ADDRESS"),$this->get_env("MAIL_FROM_NAME"))
                ->set_subject($data["subject"])
                ->set_attachments($this->attachments);
    }

    private function _check_post()
    {
        if(!$this->to) throw new \Exception("EmailService: No recipients supplied");
    }

    private function add_to(string $email){$this->to[] = $email; return $this;}
    private function add_cc(string $email){$this->cc[] = $email; return $this;}
    private function add_bcc(string $email){$this->bcc[] = $email; return $this;}
    private function add_attachments(string $path){$this->attachments[] = $path; return $this;}

    public function reset()
    {
        $this->to = []; $this->cc = []; $this->bcc = []; $this->attachments = [];
        return $this;
    }

    public function send_contact()
    {
        $this->_check_post();

        $mailable = $this->_get_mailable();
        $this->_get_mailobj()->send($mailable);

        if(Mail::failures())
            throw new Exception(Mail::failures());
    }
}
