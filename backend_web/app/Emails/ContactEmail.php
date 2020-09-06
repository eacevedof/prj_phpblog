<?php

namespace App\Emails;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    private $arfrom = ["email"=>"","name"=>""];
    private $subj = "";
    private $attachs = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this
            ->from($this->arfrom["email"], $this->arfrom["name"])
            ->subject($this->subj)
            ->view("emails.contact",[
                "data"  =>  $this->data
            ])
            //->attach($this->attachs)
            ;
    }

    public function set_from(string $email, string $name){$this->arfrom = ["email"=>$email, "name"=>$name]; return $this;}
    public function set_subject(string $subject){$this->subj = $subject; return $this;}
    public function set_attachments(array $paths){$this->attachs = $paths; return $this;}
    public function add_attachments(string $path){$this->attachs[] = $path; return $this;}
}
