<?php
    include 'partials/nav.php';
?>

<section class="form__section">
    <div class="container form__section-container">
        <div class="form-head">
            <h2>Add Category</h2>
            <a href="<?= ROOT_URL ?>admin/manage-categories.php">
                <button class="btn"><span class="material-icons-sharp">keyboard_backspace</span> Back</button>
            </a>
        </div>

        <?php if (isset($_SESSION['add-category'])) : ?>
        <div class="alert__message error">
            <p><?= $_SESSION['add-category']; unset($_SESSION['add-category']); ?></p>
        </div>
        <?php endif ?>

        <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="post">
            <input type="text" name="title" placeholder="Title">
            <textarea name="description" rows="10" placeholder="Description"></textarea>
            <button type="submit" name="submit" class="btn">Add Category</button>
        </form>
    </div>
</section>

</body>

</html>