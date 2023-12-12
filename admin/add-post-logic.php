<?php
    require 'config/database.php';

    if (isset($_POST['submit'])) {
        $author_id = $_SESSION['user-id'];
        $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
        $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
        $thumbnail = $_FILES['thumbnail'];

        // set is_featured to 0 if not checked
        $is_featured = $is_featured == 1 ?: 0;

        // validate form data
        if (!$title) {
            $_SESSION['add-post'] = "Please add the post Title";
        } elseif (!$category_id) {
            $_SESSION['add-post'] = "Please select a category";
        } elseif (!$body) {
            $_SESSION['add-post'] = "Please add the post body";
        } elseif (!$thumbnail['name']) {
            $_SESSION['add-post'] = "Please add a thumbnail";
        } else {
            //  TODO: WORK ON THUMBNAIL
            // rename image
            $time = time(); // make each image name unique
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../assets/images/thumbnails/' . $thumbnail_name;

            // make sure file is an image
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $thumbnail_name);
            $extension = end($extension);
            if (in_array($extension, $allowed_files)) {
                // make sure image is not too big. (5mb+)
                if ($thumbnail['size'] < 5_000_000) {
                    // uploafd thumbnail
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION['add-post'] = "Image size too big. Image should be less than 5mb";
                }
            } else {
                $_SESSION["add-post"] = "File Should be a png, jpg or jpeg image";
            }
        }

        // redirect back to add-post page when there is a problem
        if (isset($_SESSION["add-post"])) {
            $_SESSION["add-post-data"] = $_POST;
            header("Location: " . ROOT_URL . "admin/add-post.php");
            die();
        } else {
            // set is_featured of all posts to 0 if is_featured is 1
            if ($is_featured == 1) {
                $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0";
                $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
            }

            // insert post into database
            $query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) VALUES('$title', '$body', '$thumbnail_name', $category_id , $author_id, $is_featured)";
            $result = mysqli_query($connection, $query);

            if (!mysqli_errno($connection)) {
                $_SESSION['add-post-success'] = "Post Added Successfully";
                header("Location: " . ROOT_URL . "admin/");
                die();
            }
        }
    }

    header("Location: " . ROOT_URL ."admin/add-post.php");
    die();