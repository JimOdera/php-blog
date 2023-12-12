<?php
    include 'partials/nav.php';

    // fetch featured post from database
    $featured_query = "SELECT * FROM posts WHERE is_featured=1";
    $featured_result = mysqli_query($connection, $featured_query);
    $featured = mysqli_fetch_assoc($featured_result);

    // fetch 9 posts from the database
    $posts_query = "SELECT * FROM posts ORDER BY id DESC LIMIT 9";
    $posts = mysqli_query($connection, $posts_query);
?>

<!-- ========================================================================================= -->
<?php if(mysqli_num_rows($featured_result) == 1) : ?>
<section class="featured">
    <div class="container featured__container">
        <div class="post__thumbnail">
            <img src="assets/images/thumbnails/<?= $featured['thumbnail'] ?>" alt="thumbnail">
        </div>
        <div class="post__info">
            <?php
            $category_id = $featured['category_id'];
            $category_query = "SELECT * FROM categories WHERE id = $category_id";
            $category_result = mysqli_query($connection, $category_query);
            $category = mysqli_fetch_assoc($category_result);
            ?>
            <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $featured['category_id'] ?>"
                class="category__button"><?= $category['title'] ?></a>
            <h2 class="post__title">
                <a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>">
                    <!-- <?= $featured['title'] ?> -->
                    <?= (strlen($featured['title']) > 35) ? substr($featured['title'], 0, 35) . '...' : $featured['title'] ?>
                </a>
            </h2>
            <p class="post__body">
                <?= (strlen($featured['body']) > 650) ? substr($featured['body'], 0, 650) . '...' : $featured['body'] ?>
            </p>
            <div class="post__author">
                <?php
                // fetch author information from users table using author_id
                $author_id = $featured['author_id'];
                $author_query = "SELECT * FROM users WHERE id = $author_id";
                $author_result = mysqli_query($connection, $author_query);
                $author = mysqli_fetch_assoc($author_result);
                ?>
                <div class="post__author-avatar">
                    <img src="assets/images/avatars/<?= $author['avatar'] ?>" alt="profile">
                </div>
                <div class="post__author-info">
                    <h5>By: <?= "{$author['first_name']} {$author['last_name']}" ?></h5>
                    <small><?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?></small>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif ?>
<!-- ========================================================================================= -->

<!-- ========================================================================================= -->
<section class="posts  <?= $featured ? '' : 'section__extra-margin' ?>">
    <div class="container posts__container">
        <?php while($post = mysqli_fetch_assoc($posts)) : ?>
        <article class="post">
            <div class="post__thumbnail">
                <img src="assets/images/thumbnails/<?= $post['thumbnail'] ?>" alt="">
            </div>
            <div class="post__info">
                <?php
                $category_id = $post['category_id'];
                $category_query = "SELECT * FROM categories WHERE id = $category_id";
                $category_result = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                ?>
                <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id'] ?>"
                    class="category__button"><?= $category['title'] ?></a>
                <h3 class="post__title">
                    <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>">
                        <?= (strlen($post['title']) > 35) ? substr($post['title'], 0, 35) . '...' : $post['title'] ?>
                    </a>
                </h3>
                <p class="post__body">
                    <?= (strlen($post['body']) > 150) ? substr($post['body'], 0, 150) . '...' : $post['body'] ?>
                </p>
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
            </div>
        </article>
        <?php endwhile; ?>
    </div>
</section>
<!-- ========================================================================================= -->

<!-- ========================================================================================= -->
<section class="category__buttons">
    <div class="container category__buttons-container">
        <?php
            $all_categories_query = "SELECT * FROM categories";
            $all_categories = mysqli_query($connection, $all_categories_query);
        ?>
        <?php while($category = mysqli_fetch_assoc($all_categories)) :?>
        <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>"
            class="category__button"><?= $category['title'] ?></a>
        <?php endwhile; ?>
    </div>
</section>
<!-- ========================================================================================= -->

<?php
    include 'partials/footer.php';
?>