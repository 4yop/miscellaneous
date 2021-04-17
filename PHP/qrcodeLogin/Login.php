<?php
namespace qrcodeLogin;

class Login
{
    public function index()
    {
        return $this->view();
    }


    public function view()
    {
        return include __DIR__."view/login.php";
    }

}