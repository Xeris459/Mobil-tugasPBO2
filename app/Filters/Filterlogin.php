<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Filterlogin implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session()->get("logged_in"))
            return redirect()->to("login")->with("error", "please login first");
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}