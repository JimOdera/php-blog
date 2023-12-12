<?php
    require "config/constants.php";

    // get back form data incase there is any error
    $first_name = $_SESSION['add-user-data']['first_name'] ?? null;
    $last_name = $_SESSION['add-user-data']['last_name'] ?? null;
    $username = $_SESSION['add-user-data']['username'] ?? null;
    $email = $_SESSION['add-user-data']['email'] ?? null;
    $create_password = $_SESSION['add-user-data']['create_password'] ?? null;
    // $confirm_password = $_SESSION['add-user-data']['confirm_password'] ?? null;

    // delete sign-up data session
    unset($_SESSION['add-user-data']);
?>

<!DOCTYPE html>
<html lang="en">

<?php
    include 'partials/nav.php';
?>
<section class="form__section">
    <div class="container form__section-container">
        <div class="form-head">
            <h2>Add User</h2>
            <a href="<?= ROOT_URL ?>admin/manage-users.php">
                <button class="btn"><span class="material-icons-sharp">keyboard_backspace</span> Back</button>
            </a>
        </div>

        <?php if (isset($_SESSION['add-user'])) : ?>
        <div class="alert__message error">
            <p><?= $_SESSION['add-user']; unset($_SESSION['add-user']); ?></p>
        </div>
        <?php endif ?>

        <form action="<?= ROOT_URL ?>admin/add-user-logic.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="first_name" value="<?= $first_name ?>" placeholder="First Name">
            <input type="text" name="last_name" value="<?= $last_name ?>" placeholder="Last Name">
            <input type="text" name="username" value="<?= $username ?>" placeholder="Username">
            <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
            <input type="password" name="create_password" value="<?= $create_password ?>" placeholder="Create Password">
            <input type="password" name="confirm_password" value="<?= $confirm_password ?>"
                placeholder="Confirm Password">
            <select name="user_role">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <div class="form__control">
                <label for="avatar">Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Add User</button>
        </form>
    </div>
</section>

</body>

</html>