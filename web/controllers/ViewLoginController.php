<?php

include_once "./web/controllers/ViewController.php";

class ViewLoginController extends ViewController
{
    public function view()
    {
        $this->title = 'Login';
        $this->body = "{$this->filePath}\web\\views\\auth\\login.view.php";
        $this->masterTemplate();
    }
}
