<?php
include_once "./web/controllers/ViewController.php";

class ViewErrorController extends ViewController
{
    protected $errorTitle;
    protected $errorMessage;

    public function notFound()
    {
        $this->title = '404 Not Found';
        $this->errorTitle = '404 Not Found';
        $this->errorMessage = 'Sorry, the page you are looking for might be in another universe.';
        $this->body = "{$this->filepath}\web\\views\\master_template\\errors.view.php";
        $this->commonTemplate();
    }

    public function forbidden()
    {
        $this->title = '403 Forbidden';
        $this->errorTitle = '403 Forbidden';
        $this->errorMessage = 'Access to this resource is denied. You don\'t have permission to view this page.';
        $this->body = "{$this->filepath}\web\\views\\master_template\\errors.view.php";
        $this->commonTemplate();
    }

    public function unauthorized()
    {
        $this->title = '401 Unauthorized';
        $this->errorTitle = '401 Unauthorized';
        $this->errorMessage = 'You are not authorized to access this resource. Please log in with valid credentials.';
        $this->body = "{$this->filepath}\web\\views\\master_template\\errors.view.php";
        $this->commonTemplate();
    }
}
