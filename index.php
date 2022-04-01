<?php


//* Modèle : cette partie gère les données de votre site. Son rôle est d'aller récupérer les informations « brutes »
//* dans la base de données, de les organiser et de les assembler pour qu'elles puissent ensuite être traitées par le
//* contrôleur. On y trouve donc entre autres les requêtes SQL.

//* Vue : cette partie se concentre sur l'affichage. Elle ne fait presque aucun calcul et se contente de récupérer des
//* variables pour savoir ce qu'elle doit afficher. On y trouve essentiellement du code HTML mais aussi quelques boucles
//* et conditions PHP très simples, pour afficher par exemple une liste de messages.

//* Contrôleur : cette partie gère la logique du code qui prend des décisions. C'est en quelque sorte l'intermédiaire
//* entre le modèle et la vue : le contrôleur va demander au modèle les données, les analyser, prendre des décisions
//* et renvoyer le texte à afficher à la vue. Le contrôleur contient exclusivement du PHP. C'est notamment lui qui
//* détermine si le visiteur a le droit de voir la page ou non (gestion des droits d'accès).

//* ------------- INIT -------------- 

function __autoload($classes)
{
    if (file_exists(__DIR__ . '/lib/class/' . $classes . '.php')) {
        require_once __DIR__ . '/lib/class/' . $classes . '.php';
    }
    // elseif (file_exists(__DIR__ . '/lib/tests/' . $classes . '.php')) {
    //     // require_once __DIR__ . '/lib/tests/' . $classes . '.php';
    // }
}

// header('Cache-Control: no cache'); //no cache
// session_cache_limiter('private_no_expire'); // works

session_start();
// //* --------- Global Function -------------- 
function isUserLoggedIn(): bool
{
    if (isset($_SESSION['login'])) {
        return true;
    }
    return false;
}

// function syncCookie()
// {
//     foreach ($_SESSION as $key => $value) {
//         setcookie($key, $value, time() + (86400 * 30), "/");
//     }
//     // 
// }
// function syncSession()
// {
//     foreach ($_COOKIE as $key => $value) {
//         $_SESSION[$key] = $value;
//     }
//     // 
// }
// function deleteCookie()
// {
//     foreach ($_COOKIE as $key => $value) {
//         setcookie($key, $value, time() - 10000, "/");
//     }
// }
function urlGoBack(): string
{
    $var = explode('/', $_SERVER["REQUEST_URI"]); // string to array
    $var[Count($var) - 1] = null; // remove last index
    $var1 = implode('/', $var); // array to string
    return substr($var1, 0, -1); // remove last '/'
}

function goToErrorView(string $error = "Error 404", string $errorMessage = "I think we are lost here...", string $errorRedirection = "/", string $errorImage = "/public/assets/images/error_404.png")
{
    require_once  'lib/views/errorView.php';
}

function getRoleById($id): string
{
    switch ($id) {
        case 1:
            return "admin";
            break;
        case 2:
            return "pilot";
            break;
        case 3:
            return "student";
            break;
        case 4:
            return "delegate";
            break;
        default:
            return "student";
            break;
    }
}

//* ------------- Run -------------- 
$router = new Router();
require_once __DIR__ . '/lib/routes/routes.php';
$router->run();
//* ------------- Test -------------- 

require_once __DIR__ . '/lib/models/offerManager.php';


// $obj = (object) array(
//     "skills" => "UX Designer",
//     "localicy" => "Paris",
//     "duration" => "3 months",
//     "renumeration" => 500,
//     "added_date" => date(),
//     "offer_date" => date() + 7 * 24 * 60 * 60,
//     "id_form" => 1,
// );

// $model = new OfferManager();
// print_r($model->addOfferWithObject($obj));
