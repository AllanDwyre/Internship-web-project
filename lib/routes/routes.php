<?php

$router->setRoute('/', 'boardingController', false);
$router->setRoute('registration', 'registrationController', false);
$router->setRoute('errorView', 'errorViewController', false);
$router->setRoute('home', 'homeController');
$router->setRoute('search', 'searchController');
$router->setRoute('activity', 'activityController');
$router->setRoute('profile', 'profileController',);

$router->setRoute('company', 'companyController');

$router->setRoute('manage_account', 'manageAccountController', true, ["admin", "pilot", 1, 2]);
