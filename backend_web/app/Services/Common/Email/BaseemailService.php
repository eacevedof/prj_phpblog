<?php
namespace App\Services\Common\Email;

use App\Services\BaseService;
use Illuminate\Support\Facades\Mail;

abstract class BaseemailService extends BaseService
{
    protected $data;

    protected $to;
    protected $cc = [];
    protected $bcc = [];
    protected $attachments = [];

    protected function add_to(string $email){$this->to[] = $email; return $this;}
    protected function add_cc(string $email){$this->cc[] = $email; return $this;}
    protected function add_bcc(string $email){$this->bcc[] = $email; return $this;}
    protected function add_attachments(string $path){$this->attachments[] = $path; return $this;}

    abstract protected function _exceptions();
    abstract protected function _get_mailable();

    protected function _get_mailobj()
    {
        $mail = Mail::to(array_unique($this->to));
        $mail->locale("es");
        $mail->cc(array_unique($this->cc));
        $mail->bcc(array_unique($this->bcc));
        return $mail;
    }

    public function reset()
    {
        $this->to = []; $this->cc = []; $this->bcc = []; $this->attachments = [];
        return $this;
    }
}
