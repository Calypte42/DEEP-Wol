<?php

session_start();

if (!$_SESSION['identifie']){
    header('Location: .');
}

?>
