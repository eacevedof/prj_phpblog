<?php
namespace App\Http\Controllers\Open;

use App\Http\Controllers\BaseController;

class ContactController extends BaseController
{
    /**
     * @return View
     */
    public function __invoke()
    {
        return view('open.home.contact', []);
    }
}
