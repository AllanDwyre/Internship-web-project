<?php
// https://devdojo.com/course/create-a-php-routing-system
class Router
{
    private $request;
    private $uri;
    private $routes = [];

    function __construct()
    {
        $this->request = $_SERVER["REQUEST_URI"];
    }

    public function setRoute($routeName, $controllerName, $loggedOnly = true, array $authorizedRoles = ["all"])
    {
        $routeName = trim($routeName, '/');
        $this->routes[$routeName] = (object) [
            "controllerName" => $controllerName,
            "loggedOnly" => $loggedOnly,
            "authorizedRoles" => $authorizedRoles
        ];
    }

    public function run()
    {
        $this->uri = trim($this->request, "/");
        $this->uri = explode("/", $this->uri);

        if (!$this->hasRoute()) {
            goToErrorView();
            return;
        }

        $routeInfo = $this->routes[$this->uri[0]];

        // Retourne vrai si il n'y a pas de restriction ou si les restrictions sont validé.
        $canView = $routeInfo->loggedOnly ? $this->UserCanView($routeInfo->authorizedRoles) : true;
        if (!$canView) {
            return;
        };

        array_shift($this->uri); // enlève la page et recupere les arguments.

        $args = $this->uri; // uri[0] : allan
        require "lib/controllers/" . $routeInfo->controllerName . '.php';
        $controller = new $routeInfo->controllerName();

        $controller->makeView($args);
    }

    private function UserCanView(array $authorizedRoles): bool
    {

        $isLogged = isUserLoggedIn();

        if (!$isLogged) {
            header('location:' . "/registration");
            return false;
        }
        if ($authorizedRoles[0] == "all") return true;

        foreach ($authorizedRoles as $value) {
            if ($_SESSION['role'] == $value || $_SESSION['ID_Role'] == $value) {
                return true;
            }
        }

        goToErrorView("Error 403", "I think we are prohibed to be here...", "/", "/public/assets/images/access_denied.png");
        return false;
    }

    private function hasRoute()
    {
        foreach ($this->routes as $key => $value) {
            if ($this->uri[0] == $key) return true;
        }
        return false;
    }
}
