<?php
include_once "./web/controllers/ViewController.php";

class ViewAdminController extends ViewController
{
    public function home()
    {
        $this->title = 'Student Information';
        $this->body = "{$this->filepath}\web\\views\\admin\\home.view.php";
        $this->commonTemplate();
    }
}
