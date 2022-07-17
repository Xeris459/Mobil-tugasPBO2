<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        return view("backend/pages/login");
    }

    public function dashboard(){
        $data = [
            "title" => "dashboard"
        ];

        return view('backend/pages/dashboard', $data);
    }
}