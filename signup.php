<?php
    require "config/constants.php";

    // get back form data incase there is any error
    $first_name = $_SESSION['signup-data']['first_name'] ?? null;
    $last_name = $_SESSION['signup-data']['last_name'] ?? null;
    $username = $_SESSION['signup-data']['username'] ?? null;
    $email = $_SESSION['signup-data']['email'] ?? null;
    $create_password = $_SESSION['signup-data']['create_password'] ?? null;
    // $confirm_password = $_SESSION['signup-data']['confirm_password'] ?? null;

    // delete sign-up data session
    unset($_SESSION['signup-data']);
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

    <section class="form__section">
        <div class="container form__section-container">
            <h2>Sign Up</h2>

            <?php if (isset($_SESSION['signup'])) : ?>
            <div class="alert__message error">
                <p><?= $_SESSION['signup']; unset($_SESSION['signup']); ?></p>
            </div>
            <?php endif ?>

            <form action="<?= ROOT_URL ?>signup-logic.php" method="post" enctype="multipart/form-data">
                <input type="text" name="first_name" value="<?= $first_name ?>" placeholder="First Name">
                <input type="text" name="last_name" value="<?= $last_name ?>" placeholder="Last Name">
                <input type="text" name="username" value="<?= $username ?>" placeholder="Username">
                <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
                <input type="password" name="create_password" value="<?= $create_password ?>"
                    placeholder="Create Password">
                <input type="password" name="confirm_password" value="<?= $confirm_password ?>"
                    placeholder="Confirm Password">
                <div class="form__control">
                    <label for="avatar">Avatar</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" name="submit" class="btn">Sign Up</button>
                <small>Already have an account? <a href="signin.php">Sign In</a></small>
            </form>
        </div>
    </section>

</body>

</html>