<?php
    require 'config/database.php';

    if (isset($_POST['submit'])) {
        // get form data
        $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // validate input values
        if (!$username_email) {
            $_SESSION['signin'] = 'Username or Email is required';
        } else if (!$password) {
            $_SESSION['signin'] = 'Password is required';
        } else {
            // fetch user from the database
            $fetch_user_query = "SELECT * FROM users WHERE username='$username_email' OR email='$username_email'";
            $fetch_user_result = mysqli_query($connection, $fetch_user_query);

            if (mysqli_num_rows($fetch_user_result) == 1) {
                $user = mysqli_fetch_assoc($fetch_user_result);
                $db_password = $user['password'];

                // compare the passwords against each other
                if (password_verify($password, $db_password)) {
                    // set session access control
                    $_SESSION['user-id'] = $user['id'];
                    // check if user is admin
                    if ($user['is_admin'] == 1) {
                        $_SESSION['user_is_admin'] = true;
                    }
                    // log in user
                    // $_SESSION['signin-success'] = "You have successfully logged in";
                    header('Location: '. ROOT_URL. 'admin/');
                    // die();
                } else {
                    $_SESSION['signin'] = 'Invalid Credentials provided';
                }
            } else {
                $_SESSION['signin'] = 'User not Found';
            }
        }
        // if any problem were encountered
        if (isset($_SESSION['signin'])) {
            $_SESSION['signin-data'] = $_POST;
            header('Location: '. ROOT_URL.'signin.php');
            die();
        }
    } else {
        // if btn not clicked, return
        header('Location: '. ROOT_URL.'signin.php');
        die();
    }