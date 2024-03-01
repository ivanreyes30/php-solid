<?php

abstract class ViewController
{
    protected $title;
    protected $body;
    protected $filePath;

    public function __construct()
    {
        $this->filePath = getcwd();
    }

    public function masterTemplate()
    {
        include_once "{$this->filePath}\web\\views\\master_template\\master_template.view.php";
    }
}
