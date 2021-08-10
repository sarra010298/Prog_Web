<?php
    session_start();
    session_unset();
    session_destroy();

    $url="Acceuil.php";
    header("Location:" . $url);
    exit();
?>