<?php

namespace App\Emails;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    private $from = ["email"=>"","name"=>""];
    private $subject = "";
    private $attachments = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this
            ->from($this->from["email"],$this->from["name"])
            ->subject($this->subject)
            ->view("emails.contact",[
                "data"  =>  $this->data
            ])
            ->attach($this->attachments)
            ;
    }

    public function set_from(string $email, string $name){$this->from = ["from"=>$email, "name"=>$name]; return $this;}
    public function set_subject(string $subject){$this->subject = $subject; return $this;}
    public function set_attachments(array $paths){$this->attachments = $paths; return $this;}
    public function add_attachments(string $path){$this->attachments[] = $path; return $this;}
}
