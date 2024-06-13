<?php
namespace App\Http\Controllers\Web\FrontPages;

class FrontPages extends \App\Http\Controllers\Web\Controller
{
    public function index()
    {

        return view('misc.landing-page');
    }
}
