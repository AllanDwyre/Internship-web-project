<?php

require_once "lib/controllers/controller.php";
require_once "lib/models/companyManager.php";
require_once "lib/models/offerManager.php";
require_once "lib/models/wishlistManager.php";

class CompanyController extends Controller
{
    private $view  = "companie-info";

    private $addWishlist  = "/addInWishlist";
    private $deleteWishlist  = "/deleteFromWishlist";
    private $deleteCompany  = "/deleteCompany";
    private $modifyCompany  = "/modifyCompany";
    private $modifyOffer  = "/modifyOffer";
    private $deleteOffer  = "/deleteOffer";

    private bool $createView = true;

    private $data;
    public function makeView($args = array())
    {
        if (Count($args) == 0) {
            goToErrorView();
            die();
        }
        $this->getRequest($args);

        $companyInfo = $this->data;

        $deleteOfferRequest  = $_SERVER['REQUEST_URI'] . $this->deleteOffer;
        $addOfferRequest = $_SERVER['REQUEST_URI'] . "/addOffer";
        $modifyOfferRequest = $_SERVER['REQUEST_URI'] . "/modifyOffer";
        $openOfferRequest = $_SERVER['REQUEST_URI'] . "/OpenOffer/";


        $deleteCompanyRequest = $_SERVER['REQUEST_URI'] . $this->deleteCompany;
        $modifyCompanyRequest = $_SERVER['REQUEST_URI'] . $this->modifyCompany;


        if ($this->createView) {
            require_once $this->viewPath . $this->view . '.php';
        }
    }
    public function getRequest($request)
    {
        $companyModel = new CompanyManager();
        $offerModel = new OfferManager();
        $wishModel = new WishlistManager();

        // Permet de gérer les requète composé : company/deleteFromWishlist&6 avec deleteFromWishlist le nom de la requete et 6 la valeur de celle-ci
        if ($this->requestInQueue($request) && $this->roleAuthorization(["student"])) {

            // Permet de add dans la wish-list
            if ($this->requestContain($request[1],  $this->addWishlist)) {
                $this->addInWishlist($request[1], $wishModel, $request[0]);
                die();
            }
            // Permet de delete dans la wish-list
            elseif ($this->requestContain($request[1],  $this->deleteWishlist)) {
                $this->deleteFromWishlist($request[1], $wishModel);
                die();
            }
        }
        // Permet de gérer les requète composé : company/deleteOffert&6 avec deleteOffert le nom de la requete et 6 la valeur de celle-ci
        if ($this->requestInQueue($request) && $this->roleAuthorization(["admin", "pilot"])) {

            // Permet de delete une offre
            if ($this->requestContain($request[1],  $this->deleteOffer)) {
                $this->deleteOffer($request[1], $offerModel);
                die();
            }
            // Permet de modifier une offre
            if ($this->requestContain($request[1],  $this->modifyOffer)) {

                $offer_id = explode('&', $request[1])[1];
                $offerData = (object)$offerModel->getOfferById($offer_id);
                $offerData->companyName = $request[0];
                var_dump($offerData);
                die();
                require_once $this->viewPath . "create_offer_view" . '.php';
                // Si un formulaire pour ajouter un utilisateur a été fait.
                if (isset($_POST['skills'])) {
                    $this->modifyOffer($request[1], $offerModel);
                    die();
                }
                $this->createView = false;
                die();
            }
        }

        switch ($request[0]) {
            case 'addOffer':
                $id_form = $this->data->id_form;
                require_once $this->viewPath . "create_offer_view" . '.php';
                // Si un formulaire pour ajouter un utilisateur a été fait.
                if (isset($_POST['skills'])) {
                    $offerModel->addOfferWithObject((object)$_POST);
                    die();
                }
                $this->createView = false;
                break;
            case 'deleteCompany':
                $this->deleteCompany($companyModel);
                break;
            case 'modifyCompany':
                $companyInfo = $this->data;
                require_once $this->viewPath . "create_company_view" . '.php';
                // Si un formulaire pour ajouter un utilisateur a été fait.
                if (isset($_POST['business_name'])) {
                    $this->modifyCompany($companyModel);
                    die();
                }
                $this->createView = false;
                break;
            default:
                $this->getCompanyInfo($companyModel, $offerModel, $wishModel, $request[0]);
                break;
        }

        if ($this->requestInQueue($request)) {
            array_shift($request);
            $this->getRequest($request);
        }
    }
    function getCompanyInfo(CompanyManager $companyModel, OfferManager $offerModel, WishlistManager $wishModel, string $request)
    {
        // Get the Company info
        $this->data = $companyModel->getCompanyByName($request);

        if ($this->data == "") {
            goToErrorView();
            die();
        }

        $this->data->Pilot_trust = $this->getReputationWithStars($this->data->Pilot_trust);
        $this->data->Trainee_mark = $this->getReputationWithStars($this->data->Trainee_mark);


        // Get the Company Offers info
        $this->data->offers = $offerModel->getOffersFromCompanyId($this->data->id_form);

        // See if these offers are wished from the user
        foreach ($this->data->offers as $key => $value) {
            $offerIsWishedFromUser = $wishModel->offerIsWishedFromUserById($value["id_offer"], $_SESSION["id_user"]);
            $this->data->offers[$key]["isInWishlist"] = $offerIsWishedFromUser ? "bookmark" : "bookmark_border";
            if ($offerIsWishedFromUser) {
                $this->data->offers[$key]["requestOnBookmarkClick"] = $_SERVER['REQUEST_URI'] . $this->deleteWishlist . "&" . $value["id_offer"];
            } else {
                $this->data->offers[$key]["requestOnBookmarkClick"] = $_SERVER['REQUEST_URI'] . $this->addWishlist . "&" . $value["id_offer"];
            }
        }
    }
    function getReputationWithStars($rating): string
    {
        $rating /= 2;
        $result = '';

        $fullStar = (int) $rating;
        $halfStar = ($rating - (int) $rating) != 0;

        for ($i = 0; $i < $fullStar; $i++) {
            $result .= "star" . " ";
        }

        for ($i = 0; $i < 5 - $fullStar; $i++) {
            if ($halfStar && $i == 0) {
                $result .= "star_half" . " ";
                continue;
            }
            $result .= "star_outline" . " ";
        }
        return $result;
    }

    function addInWishlist($request, WishlistManager $wishModel, $companyName)
    {
        $offer_id = explode('&', $request)[1];
        $wishModel->addInWishlist($_SESSION["id_user"], $offer_id, $companyName);
        header("Location:" . urlGoBack());
    }
    function deleteFromWishlist($request, WishlistManager $wishModel)
    {
        $offer_id = explode('&', $request)[1];
        $wishModel->deleteFromWishlist($_SESSION["id_user"], $offer_id);
        header("Location:" . urlGoBack());
    }
    function deleteOffer($request, OfferManager $model)
    {
        $offer_id = explode('&', $request)[1];
        $model->deleteOfferById($offer_id);
        header("Location:" . urlGoBack());
    }
    function modifyOffer($request, OfferManager $model)
    {
        $offer_id = explode('&', $request)[1];
        $model->updateOfferById($offer_id, (object)$_POST);
        // header("Location:" . urlGoBack());
    }
    function modifyCompany(CompanyManager $model)
    {
        $postedInfo = (object)$_POST;
        $postedInfo->id_form = $this->data->id_form;
        $model->updateCompanyById($postedInfo);
    }
    function deleteCompany(CompanyManager $model)
    {
        $model->deleteCompany($this->data->business_name, $this->data->id_form);
        header("Location:" . "/");
    }
}
