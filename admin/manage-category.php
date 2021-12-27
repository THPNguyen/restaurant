<?php include "partials/menu.php" ?>

<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['not-category-found'])) {
            echo $_SESSION['not-category-found'];
            unset($_SESSION['not-category-found']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>
        <br>
        <br>

        <a href="add-category.php" class="btn-primary">Add admin</a>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            //Create SQL Query to get all category from database.
            $sql = "SELECT * FROM tbl_category";

            //Execute  query
            $res = mysqli_query($conn, $sql);

            if ($res) {
                // count rows
                $count = mysqli_num_rows($res);
                //check whether we havedata in database or not.
                if ($count > 0) {
                    //create  serial number variable and asign value as 0
                    $sn = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
            ?>
                        <tr>
                            <td><?= $sn++ ?></td>
                            <td><?= $title ?></td>
                            <td>
                                <?php
                                if (!empty($image_name)) {
                                ?>
                                    <img width="100px" src="<?= URLPAGE ?>/images/category/<?= $image_name ?>" alt="category <?= $title ?>">
                                <?php
                                } else {
                                    //Display the message 
                                    echo '<div class="error">image not added.</div>';
                                }
                                ?>
                            </td>
                            <td><?= $featured ?></td>
                            <td><?= $active ?></td>
                            <td>
                                <a href="update-category.php?id=<?= $id ?>&image_name=<?= $image_name ?>" class="btn-secondary">Update</a>
                                <a href="delete-category.php?id=<?= $id ?>&image_name=<?= $image_name ?>" class="btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    //we do not have data
                    //we'll display the message inside table
                    ?>
                    <tr>
                        <td colspan="6">
                            <div class="error">
                                No category added.
                            </div>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>

        </table>
    </div>

</div>
</div>

<!-- Main content section end -->
<?php include "partials/footer.php" ?>