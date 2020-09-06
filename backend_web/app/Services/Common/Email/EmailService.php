<?php
namespace App\Services\Common\Email;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class EmailService extends BaseService
{

    public function __construct()
    {

    }

    public function send_contact()
    {
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];

        \Mail::to('eacevedof@gmail.com')->send(new \App\Emails\MyTestMail($details));
    }
}
