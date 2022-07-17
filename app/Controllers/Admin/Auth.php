<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function proses()
    {
        if(!$this->request->getMethod() == "post") return redirect()->to("login")->with("error", "illegal http request");

        $model = new \App\Models\UserModel;

        $account = $model->where("email", $this->request->getVar("email"))->first();

        if(!$account) return redirect()->to("login")->with("error", "account not found");

        if(!password_verify($this->request->getVar("password"), $account->password))
            return redirect()->to("login")->with("error", "password salah");
        
        $dataSession = [
            "logged_in" => true,
            "username" => $account->username,
            "email"     => $account->email
        ];

        session()->set($dataSession);

        return redirect()->to("admin")->with("success", "login berhasil");
    }

    public function logout() {
        session()->destroy();
        return redirect()->to("login")->with("success", "logout berhasil");
    }
}