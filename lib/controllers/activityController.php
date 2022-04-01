<?php

require_once "lib/controllers/controller.php";

class ActivityController extends Controller
{
    private $view  = "activity";
    public function makeView($args = array())
    {
        require_once $this->viewPath . $this->view . '.php';
    }
    public function getRequest($request)
    {
        // 
    }
}
