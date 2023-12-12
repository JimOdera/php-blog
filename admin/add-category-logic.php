<?php
    require 'config/database.php';

    if (isset($_POST['submit'])) {
        // get form data
        $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!$title) {
            $_SESSION['add-category'] = "The Title is Required";
        } elseif (!$description) {
            $_SESSION['add-category'] = "The Description is Required";
        }

        // redirect to add category page if ther is any error in inputs
        if (isset($_SESSION['add-category'])) {
            // pass form data to sign up page
            $_SESSION['add-category-data'] = $_POST;
            header('Location: ' . ROOT_URL . 'admin/add-category.php');
            die();
        } else {
            // insert category data into database
            $query = "INSERT INTO categories (title, description) VALUES ('$title', '$description')";
            $result = mysqli_query($connection, $query);

            if (mysqli_errno($connection)) {
                $_SESSION["add-category"] = "Could not add category data to the category list.";
                header('Location: '. ROOT_URL. 'admin/add-category.php');
                die();
            } else {
                $_SESSION["add-category-success"] = "$title Category added successfully.";
                header('Location: '. ROOT_URL. 'admin/manage-categories.php');
                die();
            }
        }

    } else {
        header('Location: '. ROOT_URL. 'admin/add-category.php');
        die();
    }