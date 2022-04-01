<?php

require_once "lib/controllers/controller.php";
require_once "lib/models/userManager.php";
require_once "lib/models/wishlistManager.php";
require_once "lib/models/offerManager.php";


class ProfileController extends Controller
{
    private $view  = "profile";
    private $data;
    private $isMyAccount = true;

    private $deleteWishlist  = "/deleteFromWishlist";

    public function makeView($args = array())
    {
        $this->data = (object) $_SESSION;

        Count($args) == 0 ? null : $this->getRequest($args);

        if (!$this->isUserExist()) return;

        $wishlistInfos = !$this->roleAuthorization(["admin, pilot"]) ? $this->getUserWishlistByUserID($this->data->id_user, new WishlistManager()) : null;
        $_isMyAccount = $this->isMyAccount;

        $profileInfo = $this->data;
        $updateRequest = $_SERVER['REQUEST_URI'] . '/update';
        $changePasswordRequest = $_SERVER['REQUEST_URI'] . '/updatePassword';
        $logoutRequest = $_SERVER['REQUEST_URI'] . '/logout';
        $deleteAccountRequest  = $_SERVER['REQUEST_URI'] . '/delete';


        require_once $this->viewPath . $this->view . '.php';
    }

    public function getRequest($request)
    {
        $model = new UserManager();
        $wishModel = new WishlistManager();


        // On gere les requetes générique
        switch ($request[0]) {
            case 'logout':
                $this->logout($model);
                break;
            case 'update':
                $this->updateProfile($model, $this->data);
                break;
            case 'updatePassword':
                $this->changePassword($model, $this->data);
                break;
            case 'delete':
                if (!$this->roleAuthorization(["admin", "pilot"])) {
                    break;
                }
                $this->deleteUser($model, $this->data);
                break;
                // Si on veut delete une wishlist
            case $this->requestContain($request[0],  $this->deleteWishlist):
                if ($this->roleAuthorization(["admin", "pilot", "delegate"])) {
                    break;
                }
                $this->deleteFromWishlist($request[0], $wishModel);
                break;
            default:
                if (!$this->roleAuthorization(["admin", "pilot"])) {
                    break;
                }
                $searchedUser = $this->getUser($model, $request[0]);
                // Pour ne pas acceder à un compte sans authorization
                if ($searchedUser->ID_Role != 1 && $_SESSION["ID_Role"] != $searchedUser->ID_Role) {

                    $this->data = $searchedUser;
                    $this->isMyAccount = false;
                }
                break;
        }

        if ($this->requestInQueue($request)) {
            array_shift($request);
            $this->getRequest($request);
        }
    }
    private function isUserExist(): bool
    {
        if ($this->data == null) {
            goToErrorView();
            return false;
        }
        return true;
    }
    private function updateProfile(userManager $model, object $userInfo)
    {
        $formData = (object) $_POST;

        foreach ($formData as $key => $value) {
            $formData->$key = htmlspecialchars($value);
        }

        $formData->ID_Role = $userInfo->ID_Role; // todo : recup from UI !! 
        $formData->center = $userInfo->center;   // todo : recup from UI !! 

        $currentUserEgalRequestUser = $_SESSION["id_user"] ==  $userInfo->id_user;
        $model->updateAccountInformation($userInfo->id_user, $userInfo->id_auth, $formData, $currentUserEgalRequestUser);
        header('location:' . urlGoBack());
    }
    private function getUser(userManager $model, string $request): object
    {
        // recupère toutes les formData de l'utilisateur spécifié.
        return $model->getAccountByUsername($request);
    }
    private function changePassword(userManager $model, object $userInfo)
    {
        $formData = (object) $_POST;
        $model->updatePassword($userInfo->id_auth, $formData->password, $formData->newpassword);
        header('location:' . urlGoBack());
    }
    private function logout(userManager $model)
    {
        $model->logout();
        // deleteCookie();
        header('location:' . '/');
    }
    private function deleteUser(userManager $model, object $userInfo)
    {
        $model->deleteAccount($userInfo->id_user, $userInfo->id_auth, $userInfo->ID_Role);
        header("Location:" . urlGoBack());
    }

    // Recupère les informations des wish de l'utilisateur après avoir récuperer sa liste de souhait.
    private function getUserWishlistByUserID(int $userId, WishlistManager $wishModel): ?object
    {
        $wishlist = $wishModel->getWishlistFromUserId($userId);

        $offerModel = new OfferManager();
        foreach ($wishlist as $key => $value) {
            $wishlistInfo[$key] = $offerModel->getOfferById($value["id_offer"]);
            $wishlistInfo[$key]["CompanyName"] = $value["Business_Name"];
            $wishlistInfo[$key]["requestOnBookmarkClick"] = $_SERVER['REQUEST_URI'] . $this->deleteWishlist . "&" . $value["id_offer"];
        }
        if (isset($wishlistInfo))
            return (object) $wishlistInfo;
        return null;
    }

    private function deleteFromWishlist($request, WishlistManager $wishModel)
    {
        $offer_id = explode('&', $request)[1];
        $wishModel->deleteFromWishlist($_SESSION["id_user"], $offer_id);
        header("Location:" . urlGoBack());
    }
}
