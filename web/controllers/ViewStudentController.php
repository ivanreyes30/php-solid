<?php
include_once "$filepath/web/controllers/ViewController.php";
include_once "$filepath/web/helpers/Session.php";

class ViewStudentController extends ViewController
{
    public function __construct()
    {
        parent::__construct();
        Session::studentPage();
    }

    public function home()
    {
        $this->title = 'Student Information';
        $this->body = "{$this->filepath}\web\\views\\student\\home.view.php";
        $this->commonTemplate();
    }
}
