<?php

require_once "lib/controllers/controller.php";

class BoardingController extends Controller
{
    private $view  = "boarding";
    public function makeView($args = array())
    {
        $hasLogged = $this->isLogged();
        if ($hasLogged) {

            header('location:' . "home");
            return;
        }
        require_once $this->viewPath . $this->view . '.php';
    }
    public function getRequest($request)
    {
        // 
    }
}
