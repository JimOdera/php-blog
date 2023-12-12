<?php
    require "config/constants.php";

    // get back form data incase there is any error
    $username_email = $_SESSION['signin-data']['username_email'] ?? null;
    $password = $_SESSION['signin-data']['password'] ?? null;

    // delete sign-up data session
    unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
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
            <h2>Sign In</h2>

            <?php if (isset($_SESSION['signup-success'])) : ?>
            <div id="success-message" class="alert__message success">
                <p><?= $_SESSION['signup-success']; unset($_SESSION['signup-success']); ?></p>
            </div>
            <?php elseif (isset($_SESSION['signin'])) : ?>
            <div id="success-message" class="alert__message error">
                <p><?= $_SESSION['signin']; unset($_SESSION['signin']); ?></p>
            </div>
            <?php endif ?>

            <form action="<?= ROOT_URL ?>signin-logic.php" method="post">
                <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Username or Email">
                <input type="password" name="password" value="<?= $password ?>" placeholder="Password">
                <button type="submit" name="submit" class="btn">Sign In</button>
                <small>Already have an account? <a href="signup.php">Sign Up</a></small>
            </form>
        </div>
    </section>

    <script>
    // Hide the success message after 3 seconds manage-users.php
    setTimeout(function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);
    </script>

</body>

</html>