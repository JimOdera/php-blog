<?php
    include 'partials/nav.php';

    // fetch current user's posts from the database
    $current_user_id = $_SESSION['user-id'];
    $query = "SELECT id, title, category_id FROM posts WHERE author_id = $current_user_id ORDER BY id DESC";
    // $query = "SELECT * FROM posts WHERE author_id = {$_SESSION['user-id']}";
    $posts = mysqli_query($connection, $query);
?>

<!-- ========================================================================================= -->
<section class="dashboard">
    <?php if (isset($_SESSION['add-post-success'])) : ?>
    <!-- shows if category added successfully -->
    <div id="success-message" class="alert__message success container">
        <p><?= $_SESSION['add-post-success']; unset($_SESSION['add-post-success']); ?></p>
    </div>
    <?php elseif (isset($_SESSION['edit-post-success'])) : ?>
    <!-- shows if category edited successfully -->
    <div id="success-message" class="alert__message success container">
        <p><?= $_SESSION['edit-post-success']; unset($_SESSION['edit-post-success']); ?></p>
    </div>
    <?php elseif (isset($_SESSION['edit-post'])) : ?>
    <div id="success-message" class="alert__message error container">
        <p><?= $_SESSION['edit-post']; unset($_SESSION['edit-post']); ?></p>
    </div>
    <?php elseif (isset($_SESSION['delete-post-success'])) : ?>
    <!-- shows if category deleteed successfully -->
    <div id="success-message" class="alert__message success container">
        <p><?= $_SESSION['delete-post-success']; unset($_SESSION['delete-post-success']); ?></p>
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
                    <li class="active">
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

            <?php if (mysqli_num_rows($posts) > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($post = mysqli_fetch_assoc($posts)) : ?>
                    <!-- get category title -->
                    <?php
                            $category_id = $post['category_id'];
                            $category_query = "SELECT title FROM categories WHERE id = $category_id";
                            $category_result = mysqli_query($connection, $category_query);
                            $category = mysqli_fetch_assoc($category_result);
                        ?>
                    <tr>
                        <td><?= $post['title'] ?></td>
                        <td><?= $category['title'] ?></td>
                        <td>
                            <a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id'] ?>">
                                <span class="material-icons-sharp edit">edit</span>
                            </a>
                        </td>
                        <td>
                            <a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>">
                                <span class="material-icons-sharp delete">delete</span>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
            <?php else :?>
            <div class="alert__message error">
                <?= "No Posts Available." ?>
            </div>
            <?php endif?>
        </main>
    </div>
</section>
<!-- ========================================================================================= -->

<?php
    include '../partials/footer.php';
?>