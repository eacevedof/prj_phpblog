<?php
namespace App\Http\Controllers\Open;

use App\Http\Controllers\BaseController;

class AboutmeController extends BaseController
{
    /**
     * @return View
     */
    public function __invoke()
    {
        return view('open.home.aboutme', []);
    }
}
