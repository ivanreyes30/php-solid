<?php
include_once "$filepath/web/controllers/ViewController.php";
include_once "$filepath/web/helpers/Session.php";

class ViewAuthController extends ViewController
{
    public function __construct()
    {
        parent::__construct();
        Session::hasSession();
    }

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
