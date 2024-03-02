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

    public function masterTemplate()
    {
        include_once "{$this->filepath}\web\\views\\master_template\\master_template.view.php";
    }
}
