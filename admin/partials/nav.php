<?php
    require "../partials/nav.php";

    // check login status
    if (!isset($_SESSION['user-id'])) {
        header('location: ' . ROOT_URL . 'signin.php');
        die();
    }
?>