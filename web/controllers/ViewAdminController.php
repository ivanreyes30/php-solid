<?php
include_once "$filepath/web/controllers/ViewController.php";
include_once "$filepath/web/helpers/Session.php";

class ViewAdminController extends ViewController
{
    public function __construct()
    {
        parent::__construct();
        Session::adminPage();
    }

    public function home()
    {
        $this->title = 'Student Information';
        $this->body = "{$this->filepath}\web\\views\\admin\\home.view.php";
        $this->commonTemplate();
    }
}
