<?php

require_once "lib/controllers/controller.php";
require_once "lib/models/userManager.php";

class RegistrationController extends Controller
{
    private $view  = "registration";
    public function makeView($args = array())
    {
        if ($this->isLogged()) {
            header('location:' . "home");
            return;
        }

        $args ? $this->getRequest($args) : null;
        require_once $this->viewPath . $this->view . '.php';
    }
    protected function getRequest($request)
    {
        if ($this->isLogged()) {
            header('location:' . "home");
            return;
        }
        // todo: Login & registration
        if ($request[0] == 'login') {
            $this->login();
        }
    }
    function login()
    {
        $model = new UserManager();
        $isLogged = $model->login($_POST["fusername"], $_POST["fpassword"]);
        if ($isLogged) {
            // syncCookie();
            header('location:' . '/home');
        } else {
            header('location:' . '/registration');
        }
    }
}
