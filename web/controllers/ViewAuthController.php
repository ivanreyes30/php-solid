<?php
include_once "./web/controllers/ViewController.php";

class ViewAuthController extends ViewController
{
    public function login()
    {
        $this->title = 'Login';
        $this->body = "{$this->filepath}\web\\views\\auth\\login.view.php";
        $this->commonTemplate();
    }

    public function signUp()
    {
        $this->title = 'Sign Up';
        $this->body = "{$this->filepath}\web\\views\\auth\\signup.view.php";
        $this->commonTemplate();
    }
}
