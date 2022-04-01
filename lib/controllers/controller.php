<?php

abstract class Controller
{
    public $viewPath = "lib/views/";
    abstract public function makeView($args = array());
    abstract protected function getRequest($request);

    protected function isLogged(): bool
    {
        $logged = isset($_SESSION['login']) && $_SESSION['login'] != '';
        if (!$logged) {
            return false;
        }
        return true;
    }

    protected function requestInQueue(array $requests): bool
    {
        array_shift($requests);
        if ($requests == null) {
            return false;
        }
        return true;
    }

    // return true if you are logged with the $authorizedRoles
    protected function roleAuthorization(array $authorizedRoles): bool
    {
        if ($_SESSION['role'] == "admin" || $_SESSION['ID_Role'] == 1) return true;

        foreach ($authorizedRoles as $value) {
            if ($_SESSION['role'] == $value || $_SESSION['ID_Role'] == $value) {
                return true;
            }
        }
        return false;
    }
    protected function requestContain($request, $searchedString): bool
    {
        if (strpos('/' . $request,  $searchedString) !== false) {
            return true;
        }
        return false;
    }
}
