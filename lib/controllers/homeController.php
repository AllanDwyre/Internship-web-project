<?php

require_once "lib/controllers/controller.php";

class HomeController extends Controller
{
    private $view  = "home";
    public function makeView($args = array())
    {
        $candidacies = $this->getCandidacies();
        // var_dump($candidacies);
        require_once $this->viewPath . $this->view . '.php';
    }
    public function getRequest($request)
    {
        // 
    }
    private function getCandidacies(): array
    {
        return array();
    }
}
