<?php

require_once "lib/controllers/controller.php";
require_once "lib/models/userManager.php";
require_once "lib/models/companyManager.php";


class ManageAccountController extends Controller
{
    private $view  = "manage_account";
    private $data;
    private bool $createView = true;
    private $userModel;
    private $companyModel;

    function __construct()
    {
        $this->userModel = new UserManager();
        $this->companyModel = new CompanyManager();
    }

    public function makeView($args = array())
    {
        Count($args) == 0 ? null : $this->getRequest($args);

        $this->data["users"] = $this->userModel->getUsersByIdRole($_SESSION["ID_Role"]);
        $this->data["companies"] = $this->companyModel->getCompagnies();


        $addUserRequest = $_SERVER['REQUEST_URI'] . '/add_user';
        $addCompanyRequest = $_SERVER['REQUEST_URI'] . '/add_company';
        $getUserRequest = '/profile/';
        $accounts =  $this->data;
        if ($this->createView) {
            require_once $this->viewPath . $this->view . '.php';
        }
    }

    public function getRequest($request)
    {

        switch ($request[0]) {
            case 'add_user':
                require_once $this->viewPath . "create_user_view" . '.php';
                // Si un formulaire pour ajouter un utilisateur a été fait.
                if (isset($_POST['username'])) {
                    $this->userModel->addUserWithObject((object)$_POST);
                }
                $this->createView = false;
                break;
            case 'add_company':
                require_once $this->viewPath . "create_company_view" . '.php';
                // Si un formulaire pour ajouter une entreprise a été fait.
                if (isset($_POST['business_name'])) {
                    $this->companyModel->addCompanyWithObject((object)$_POST);
                }
                $this->createView = false;
                break;

            default:
                // 
                break;
        }

        if ($this->requestInQueue($request)) {
            array_shift($request);
            $this->getRequest($request);
        }
    }
}
