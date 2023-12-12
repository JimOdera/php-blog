<?php
    include 'partials/nav.php';

    if (isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        $query = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($result);
    } else {
        header('Location: ' . ROOT_URL . 'admin/manage-users.php');
        die();
    }
?>

<section class="form__section">
    <div class="container form__section-container">
        <div class="form__section-header">
            <h2>Edit User</h2>
        </div>
        <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <input type="text" name="first_name" value="<?= $user['first_name'] ?>" placeholder="First Name">
            <input type="text" name="last_name" value="<?= $user['last_name'] ?>" placeholder="Last Name">
            <select name="user_role">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <button type="submit" name="submit" class="btn">Update User</button>
        </form>
    </div>
</section>

</body>

</html>