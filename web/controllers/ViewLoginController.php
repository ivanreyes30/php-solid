<?php
include_once "./web/controllers/ViewController.php";

class ViewLoginController extends ViewController
{
    public function login()
    {
        $this->title = 'Login';
        $this->body = "{$this->filepath}\web\\views\\auth\\login.view.php";
        $this->masterTemplate();
    }
}
