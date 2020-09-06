<?php
namespace App\Http\Controllers\Common\Email;

use App\Component\SeoComponent;
use App\Http\Controllers\BaseController;
use App\Services\Common\Email\EmailService;
use App\Services\Restrict\Post\PostIndexService;


class EmailController extends BaseController
{
    public function __invoke()
    {
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];

        \Mail::to('eacevedof@gmail.com')->send(new \App\Emails\MyTestMail($details));
    }

    public function contact()
    {

        $this->_load_authid();
        try {
            $r = (new EmailService())->send_contact();
            return Response()->json(["data"=>$r],200);
        }
        catch (\Exception $e)
        {
            return Response()->json(["error"=>$e->getMessage()],500);
        }


    }
}
