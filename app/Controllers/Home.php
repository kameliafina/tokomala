<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('main/layout2');
    }

    public function tampil(): string
    {
        return view('main/layout2');
    }
}
