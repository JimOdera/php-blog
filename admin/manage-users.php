<?php
    include 'partials/nav.php';

    // fetch users from the database and not the current user
    $current_admin_id = $_SESSION['user-id'];

    $query = "SELECT * FROM users WHERE id != $current_admin_id";
    // $query = "SELECT * FROM users WHERE NOT id = $current_admin_id";

    $users = mysqli_query($connection, $query);

?>

<!-- ========================================================================================= -->
<section class="dashboard">
    <?php if (isset($_SESSION['add-user-success'])) : ?>
    <!-- shows if user added successfully -->
    <div id="success-message" class="alert__message success container">
        <p><?= $_SESSION['add-user-success']; unset($_SESSION['add-user-success']); ?></p>
    </div>
    <?php elseif (isset($_SESSION['edit-user-success'])) : ?>
    <!-- shows if user edited successfully -->
    <div id="success-message" class="alert__message success container">
        <p><?= $_SESSION['edit-user-success']; unset($_SESSION['edit-user-success']); ?></p>
    </div>
    <?php elseif (isset($_SESSION['edit-user'])) : ?>
    <!-- shows if user edited unsuccessfully -->
    <div id="success-message" class="alert__message error container">
        <p><?= $_SESSION['edit-user']; unset($_SESSION['edit-user']); ?></p>
    </div>
    <?php elseif (isset($_SESSION['delete-user'])) : ?>
    <!-- shows if user deleteed unsuccessfully -->
    <div id="success-message" class="alert__message error container">
        <p><?= $_SESSION['delete-user']; unset($_SESSION['delete-user']); ?></p>
    </div>
    <?php elseif (isset($_SESSION['delete-user-success'])) : ?>
    <!-- shows if user deleteed successfully -->
    <div id="success-message" class="alert__message success container">
        <p><?= $_SESSION['delete-user-success']; unset($_SESSION['delete-user-success']); ?></p>
    </div>
    <?php endif ?>
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="material-icons-sharp sidebar__toggle">chevron_right</button>
        <button id="hide__sidebar-btn" class="material-icons-sharp sidebar__toggle">chevron_left</button>
        <aside>
            <ul>
                <!--  -->
                <a href="add-post.php">
                    <li>
                        <span class="material-icons-sharp">library_add</span>
                        <h5>Add Post</h5>
                    </li>
                </a>
                <!--  -->
                <!--  -->
                <a href="index.php">
                    <li>
                        <span class="material-icons-sharp">content_copy</span>
                        <h5>Manage Post</h5>
                    </li>
                </a>
                <!--  -->
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                <!--  -->
                <a href="add-user.php">
                    <li>
                        <span class="material-icons-sharp">person_add_alt</span>
                        <h5>Add User</h5>
                    </li>
                </a>
                <!--  -->
                <!--  -->
                <a href="manage-users.php">
                    <li class="active">
                        <span class="material-icons-sharp">people</span>
                        <h5>Manage Users</h5>
                    </li>
                </a>
                <!--  -->
                <!--  -->
                <a href="add-category.php">
                    <li>
                        <span class="material-icons-sharp">edit_note</span>
                        <h5>Add Category</h5>
                    </li>
                </a>
                <!--  -->
                <!--  -->
                <a href="manage-categories.php">
                    <li>
                        <span class="material-icons-sharp">format_list_bulleted</span>
                        <h5>Manage Categories</h5>
                    </li>
                </a>
                <!--  -->
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Users</h2>
            <?php if (mysqli_num_rows($users) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($user = mysqli_fetch_assoc($users)) : ?>
                    <tr>
                        <td><?= "{$user['first_name']} {$user['last_name']}" ?></td>

                        <td>
                            <a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>">
                                <span class="material-icons-sharp edit">edit</span>
                            </a>
                        </td>


                        <td>
                            <a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>">
                                <span class="material-icons-sharp delete">delete</span>
                            </a>
                        </td>

                        <td> <?= $user['is_admin'] ? 'Yes' : 'No' ?> </td>
                    </tr>
                    <?php endwhile?>
                </tbody>
            </table>
            <?php else :?>
            <div class="alert__message error">
                <?= "No Users Found" ?>
            </div>
            <?php endif?>
        </main>
    </div>
</section>
<!-- ========================================================================================= -->

<?php
    include '../partials/footer.php';
?>