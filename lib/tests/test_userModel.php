<?php

require_once "lib/models/userManager.php";

try {
    $users = new UserManager();

    if (!$users->login("gnakach", "gnakac")) {
        throw new Exception("login failed", 1);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
