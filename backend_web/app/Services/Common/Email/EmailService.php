<?php
namespace App\Services\Common\Email;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use \Mail;

class EmailService extends BaseService
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function send_contact()
    {
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];

        //Mail::to('eacevedof@gmail.com')->send(new \App\Emails\MyTestMail($details));
        $emailto = $this->get_env("MAIL_TO");
        Mail::to($emailto)->send(new \App\Emails\ContactEmail($details));
    }
}
