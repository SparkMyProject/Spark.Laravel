<?php
namespace App\Http\Controllers\FrontPages;

class FrontPages extends \App\Http\Controllers\Controller
{
    public function index()
    {

        return view('misc.landing-page');
    }
}
