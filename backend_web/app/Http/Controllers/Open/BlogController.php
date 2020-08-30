<?php
namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * @return View
     */
    public function __invoke()
    {
        return view('open.blog', []);
    }

    public function category($slug)
    {}
}
