<?php
include_once "./web/controllers/ViewController.php";

class ViewStudentController extends ViewController
{
    public function readUpdate()
    {
        $this->title = 'Login';
        $this->body = "{$this->filepath}\web\\views\\student\\read-update.view.php";
        $this->masterTemplate();
    }
}
