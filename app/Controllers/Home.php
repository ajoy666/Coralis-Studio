<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Programming Test'];
        return view('welcome_message', $data);
    }
}
