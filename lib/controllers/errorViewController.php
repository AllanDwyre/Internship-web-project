<?php

require_once "lib/controllers/controller.php";
// require_once "lib/models/userManager.php";

class ErrorViewController extends Controller
{
    private $view  = "errorView";
    public function makeView($args = array())
    {
        $args ? $this->getRequest($args) : null;
        require_once $this->viewPath . $this->view . '.php';
    }
    protected function getRequest($request)
    {
    }
}
