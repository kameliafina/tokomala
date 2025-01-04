<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('dashboard');
    }

    public function tampil(): string
    {
        return view('dashboard');
    }
}
