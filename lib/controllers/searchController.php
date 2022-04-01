<?php

require_once "lib/controllers/controller.php";
require_once "lib/models/searchManager.php";

class searchController extends Controller
{
    private $view  = "search_screen";
    public function makeView($args = array())
    {
        $userModel = new SearchManager();
        $results = [];
        if (isset($_POST['search_input']) || isset($_SESSION['last_search'])) {
            if (isset($_POST['search_input'])) {
                $_SESSION['last_search'] = $_POST;
                header("Location:" . urlGoBack());
            }
            $searchInput = $_POST['search_input'] ?? $_SESSION['last_search']['search_input'] ?? "";
            $results = $userModel->searchAll($searchInput, $_SESSION['ID_Role']);
        }
        //* ------- Pagination -----------
        $currentPage = $args[0] ?? 0; // set current page
        $itemsPerPage = 10; // number of items per page

        $nbOfResults = Count($results);
        $numberOfPage = ceil($nbOfResults / $itemsPerPage);

        $start = $currentPage * $itemsPerPage;
        $finish = min($start + $itemsPerPage, $nbOfResults);

        //* ------- Requests Links -----------
        $companyRequest = '/company/';
        $offerRequest = '/company/';
        $userRequest = '/profile/';
        $pageRequest = '/search/';

        require_once $this->viewPath . $this->view . '.php';
    }

    public function getRequest($request)
    {

        // switch ($request[0]) {
        //     default:

        //         break;
        // }

        if ($this->requestInQueue($request)) {
            array_shift($request);
            $this->getRequest($request);
        }
    }
}
