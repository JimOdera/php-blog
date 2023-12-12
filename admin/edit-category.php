<!DOCTYPE html>
<?php
    include 'partials/nav.php';

    if (isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        // fetch category from database
        $query = "SELECT * FROM categories WHERE id = $id";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) == 1) {
            $category = mysqli_fetch_assoc($result);
        }
    } else {
        header('Location : ' . ROOT_URL .'admin/manage-categories');
        die();
    }
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Category</h2>
        <div class="alert__message success">
            <p>This is an success message</p>
        </div>
        <form action="<?= ROOT_URL ?>admin/edit-category-logic.php" method="post">
            <input type="hidden" name="id" value="<?= $category['id'] ?>">
            <input type="text" name="title" value="<?= $category['title'] ?>" placeholder="Title">
            <textarea name="description" id="" rows="10"
                placeholder="Description"><?= $category['description'] ?></textarea>
            <button type="submit" name="submit" class="btn">Update Category</button>
        </form>
    </div>
</section>

</body>

</html>