<?php
    session_start();
    require "config/database.php";

    // get sign up if btn clicked
    if(isset($_POST['submit'])) {
        $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $create_password = filter_var($_POST['create_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $avatar = $_FILES['avatar'];

        // validate input values
        if (!$first_name) {
            $_SESSION['signup'] = 'Your first name is required';
        } elseif (!$last_name) {
            $_SESSION['signup'] = 'Your last name is required';
        } elseif (!$username) {
            $_SESSION['signup'] = 'Your username is required';
        } elseif (!$email) {
            $_SESSION['signup'] = 'A Valid Email, Please!';
        } elseif (strlen($create_password) < 8 || strlen($confirm_password) < 8) {
            $_SESSION['signup'] = 'Password should be 8+ characters long';
        } elseif (!$avatar['name']) {
            $_SESSION['signup'] = 'Add an avatar to the account';
        } else {
            // check if the passwords don't match
            if ($create_password !== $confirm_password) {
                $_SESSION['signup'] = 'Passwords do not match';
            } else {
                // hash password
                $hashed_password = password_hash($create_password, PASSWORD_DEFAULT);
                
                // check if the username and email already exists in the database
                $user_check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
                $user_check_result = mysqli_query($connection, $user_check_query);

                if (mysqli_num_rows($user_check_result) > 0) {
                    $_SESSION['signup'] = 'Username or Email already exists';
                } else {
                    // work on Avatar
                    // rename avatar
                    $time = time(); //make avatar unique
                    $avatar_name = $time . $avatar['name'];
                    $avatar_tmp_name = $avatar['tmp_name'];
                    $avatar_destination_path = 'assets/images/avatars/' . $avatar_name;

                    // make sure avatar is an image
                    // $avatar_extension = pathinfo($avatar_name, PATHINFO_EXTENSION);
                    $allowed_files = ['jpg', 'jpeg', 'png'];
                    $extension = explode('.', $avatar_name);
                    $extension = end($extension);
                    if (in_array($extension, $allowed_files)) {
                        // make sure avatar is not too large
                        if ($avatar['size'] < 2000000) {
                            // upload avatar
                            move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                        } else {
                            $_SESSION['signup'] = 'File size is too large. should be less than 2mb';
                        }
                    } else {
                        $_SESSION['signup'] = 'File should be png, jpeg, or jpg';
                    }

                }
            }
        }

        // redirect to sign up page if ther is any error
        if (isset($_SESSION['signup'])) {
        // if ($_SESSION['signup']) {
            // pass form data to sign up page
            $_SESSION['signup-data'] = $_POST;
            header('Location: ' . ROOT_URL . 'signup.php');
            die();
        } else {
            // insert new user into the database
            $insert_user_query = "INSERT INTO users (first_name, last_name, username, email, password, avatar, is_admin) VALUES ('$first_name', '$last_name', '$username', '$email', '$hashed_password', '$avatar_name', 0)";
            // $insert_user_query = "INSERT INTO users SET first_name='$first_name', last_name='$last_name', username='$username', email='$email', password='$hashed_password', avatar='$avatar_name', is_admin=0";

            $insert_user_result  = mysqli_query($connection, $insert_user_query);
            
            // redirect to login page
            if (!mysqli_errno($connection)) {
                $_SESSION['signup-success'] = "Registered successfully. Please log in.";
                header('Location: ' . ROOT_URL . 'signin.php');
                die();
            }
        }
    

    } else {
        // if btn not clicked, return
        header('Location: ' . ROOT_URL . 'signup.php');
        die();
    }