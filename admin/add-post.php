<?php
    include 'partials/nav.php';

    // fetch all categories fron the db
    $query = "SELECT * FROM categories ORDER BY title";
    $categories = mysqli_query($connection, $query);

    // get back form data if there is an error
    $title = $_SESSION['add-post-data']['title'] ?? null;
    $body = $_SESSION['add-post-data']['body']?? null;

    // delete form data session
    unset($_SESSION['add-post-data']);
?>
<section class="form__section">
    <div class="container form__section-container">
        <div class="form-head">
            <h2>Add Post</h2>
            <a href="<?= ROOT_URL ?>admin/index.php">
                <button class="btn"><span class="material-icons-sharp">keyboard_backspace</span> Back</button>
            </a>
        </div>

        <?php if (isset($_SESSION['add-post'])) : ?>
        <div id="success-message" class="alert__message error">
            <p><?= $_SESSION['add-post']; unset($_SESSION['add-post']); ?></p>
        </div>
        <?php endif ?>

        <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="title" value="<?= $title ?>" placeholder="Title">
            <select name="category">
                <?php while($category = mysqli_fetch_assoc($categories)): ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                <?php endwhile ?>
                <!-- <option value="1">Travel</option> -->
            </select>
            <textarea name="body" rows="10" placeholder="Description"><?= $body ?></textarea>
            <?php if(isset($_SESSION['user_is_admin'])): ?>
            <div class="form__control inline">
                <input type="checkbox" name="is_featured" value="1" id="is_featured" checked>
                <label for="is_featured">Featured</label>
            </div>
            <?php endif ?>
            <div class="form__control">
                <label for="thumbnail">Add Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Add Post</button>
        </form>
    </div>
</section>

</body>

</html>