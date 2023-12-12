<?php
    include 'partials/nav.php';
    
    // fetch post from the database if id is set
    if (isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM posts WHERE id = $id";
        $result = mysqli_query($connection, $query);
        $post = mysqli_fetch_assoc($result);
    } else {
        header('Location: ' . ROOT_URL . 'blog.php');
        die();
    }
?>

<!-- ========================================================================================= -->

<section class="singlePost">
    <div class="container singlePost__container">
        <h2 class="post__title">
            <?= $post['title'] ?>
        </h2>
        <div class="post__author">
            <?php
            // fetch author information from users table using author_id
            $author_id = $post['author_id'];
            $author_query = "SELECT * FROM users WHERE id = $author_id";
            $author_result = mysqli_query($connection, $author_query);
            $author = mysqli_fetch_assoc($author_result);
            ?>
            <div class="post__author-avatar">
                <img src="assets/images/avatars/<?= $author['avatar'] ?>" alt="profile">
            </div>
            <div class="post__author-info">
                <h5>By: <?= "{$author['first_name']} {$author['last_name']}" ?></h5>
                <small><?= date("M d, Y - H:i", strtotime($post['date_time'])) ?></small>
            </div>
        </div>
        <div class="singlePost__thumbnail">
            <img src="assets/images/thumbnails/<?= $post['thumbnail'] ?>" alt="">
        </div>
        <p class="post__body">
            <?= $post['body'] ?>.
        </p>
    </div>
</section>
<!-- ========================================================================================= -->

<?php
    include 'partials/footer.php';
?>