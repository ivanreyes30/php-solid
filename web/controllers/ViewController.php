<?php

abstract class ViewController
{
    protected $title;
    protected $body;
    protected $filepath;

    public function __construct()
    {
        global $filepath;
        $this->filepath = $filepath;
    }

    public function authTemplate()
    {
        include_once "{$this->filepath}\web\\views\\master_template\\auth.view.php";
    }

    public function studentTemplate()
    {
        include_once "{$this->filepath}\web\\views\\master_template\\student.view.php";
    }

    public function commonTemplate()
    {
        include_once "{$this->filepath}\web\\views\\master_template\\common.view.php";
    }
}
