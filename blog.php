<?php
    include 'partials/nav.php';

    // fetch posts from the database
    $posts_query = "SELECT * FROM posts ORDER BY id DESC";
    $posts = mysqli_query($connection, $posts_query);
?>

<!-- ========================================================================================= -->
<section class="search__bar">
    <form action="<?= ROOT_URL ?>search.php" class="container search__bar-container" method="GET">
        <div>
            <span class="material-icons-sharp">search</span>
            <input type="search" name="search" placeholder="Search here...">
        </div>
        <button type="submit" name="submit" class="btn">Go</button>
    </form>
</section>
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
                    <!-- <?= substr($post['body'], 0, 150) ?>... -->
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