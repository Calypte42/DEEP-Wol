<?php
session_start();

$_SESSION = array(); // on supprime toutes les variables

// supprime le cookie de session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy(); // on supprime la session

header('Location: connexion.php');

?>
