<?php
    require "config/database.php";

    // fetch user from database
    if (isset($_SESSION['user-id'])) {
        $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT avatar FROM users WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $avatar = mysqli_fetch_assoc($result);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog App</title>
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/css/styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body>

    <!-- ========================================================================================= -->
    <nav>
        <div class="container nav__container">
            <a href="<?= ROOT_URL ?>" class="nav__logo">BLOG APP</a>
            <ul class="nav__items">
                <a href="<?= ROOT_URL ?>blog.php">
                    <li>Blog</li>
                </a>
                <a href="<?= ROOT_URL ?>about.php">
                    <li>About</li>
                </a>
                <a href="<?= ROOT_URL ?>services.php">
                    <li>Services</li>
                </a>
                <a href="<?= ROOT_URL ?>contact.php">
                    <li>Contact</li>
                </a>
                <?php if (isset($_SESSION['user-id'])) : ?>
                <li class="nav__profile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL . 'assets/images/avatars/' . $avatar['avatar'] ?>">
                    </div>
                    <ul>
                        <a href="<?= ROOT_URL ?>admin/index.php">
                            <li>Dashboard</li>
                        </a>
                        <a href="<?= ROOT_URL ?>logout.php">
                            <li>Logout</li>
                        </a>
                    </ul>
                </li>
                <?php else : ?>
                <a href="<?= ROOT_URL ?>signin.php">
                    <li>Sign In</li>
                </a>
                <?php endif ?>
            </ul>
            <div class="nav__medium">
                <?php if (isset($_SESSION['user-id'])) : ?>
                <div class="nav__medium-profile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL . 'assets/images/avatars/' . $avatar['avatar'] ?>">
                    </div>
                    <a href="<?= ROOT_URL ?>logout.php">
                        <span class="material-icons-sharp success">power_settings_new</span>
                    </a>
                </div>
                <button id="open__nav-btn" class="material-icons-sharp">menu</button>
                <button id="close__nav-btn" class="material-icons-sharp">close</button>
                <?php else :?>
                <a href="<?= ROOT_URL ?>signin.php">
                    <span class="material-icons-sharp danger">power_settings_new</span>
                </a>
                <?php endif ?>
            </div>
        </div>
    </nav>
    <!-- ========================================================================================= -->