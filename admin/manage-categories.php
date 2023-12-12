<?php
    include 'partials/nav.php';

    // fetch categories from database
    $query = "SELECT * FROM categories ORDER BY title";
    $categories = mysqli_query($connection, $query);

?>

<!-- ========================================================================================= -->
<section class="dashboard">
    <?php if (isset($_SESSION['add-category-success'])) : ?>
    <!-- shows if category added successfully -->
    <div id="success-message" class="alert__message success container">
        <p><?= $_SESSION['add-category-success']; unset($_SESSION['add-category-success']); ?></p>
    </div>
    <?php elseif (isset($_SESSION['add-category'])) : ?>
    <!-- shows if category added successfully -->
    <div id="success-message" class="alert__message error container">
        <p><?= $_SESSION['add-category']; unset($_SESSION['add-category']); ?></p>
    </div>
    <?php elseif (isset($_SESSION['edit-category'])) : ?>
    <!-- shows if category edited successfully -->
    <div id="success-message" class="alert__message error container">
        <p><?= $_SESSION['edit-category']; unset($_SESSION['edit-category']); ?></p>
    </div>
    <?php elseif (isset($_SESSION['edit-category-success'])) : ?>
    <!-- shows if category edited successfully -->
    <div id="success-message" class="alert__message success container">
        <p><?= $_SESSION['edit-category-success']; unset($_SESSION['edit-category-success']); ?></p>
    </div>
    <?php elseif (isset($_SESSION['delete-category-success'])) : ?>
    <!-- shows if category deletedted successfully -->
    <div id="success-message" class="alert__message success container">
        <p><?= $_SESSION['delete-category-success']; unset($_SESSION['delete-category-success']); ?></p>
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
                    <li>
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
                    <li class="active">
                        <span class="material-icons-sharp">format_list_bulleted</span>
                        <h5>Manage Categories</h5>
                    </li>
                </a>
                <!--  -->
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Manage Categories</h2>
            <?php if (mysqli_num_rows($categories) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                    <tr>
                        <td><?= $category['title'] ?></td>
                        <td>
                            <a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>">
                                <span class="material-icons-sharp edit">edit</span>
                            </a>
                        </td>
                        <td>
                            <a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>">
                                <span class="material-icons-sharp delete">delete</span>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else :?>
            <div class="alert__message error">
                <?= "No Categories Available" ?>
            </div>
            <?php endif?>
        </main>
    </div>
</section>
<!-- ========================================================================================= -->

<?php
    include '../partials/footer.php';
?>