<?php
include_once "./web/controllers/ViewController.php";

class ViewStudentController extends ViewController
{
    public function home()
    {
        $this->title = 'Student Information';
        $this->body = "{$this->filepath}\web\\views\\student\\home.view.php";
        $this->commonTemplate();
    }
}
