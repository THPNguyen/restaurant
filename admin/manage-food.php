<?php include "partials/menu.php" ?>

<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br>
        <?php if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br>
        <a href="add-food.php" class="btn-primary">Add Food</a>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            //Create a SQL Query to get all the food
            $sql = "SELECT * FROM tbl_food";
            //Execute the SQL query
            $res = mysqli_query($conn, $sql);
            if ($res) {
                //count 
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    //display the data from database.
                    $sn = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

            ?>
                        <tr>
                            <td><?= $sn++ ?></td>
                            <td><?= $title ?></td>
                            <td><?= $price ?></td>
                            <td>
                                <?php
                                if (!empty($image_name)) { ?>
                                    <img src="<?= URLPAGE . '/images/food/' . $image_name ?>" alt="food <?= $title ?>>" width="120px">
                                <?php
                                } else {
                                    echo "<div class='error'>Image not added.</div>";
                                }
                                ?>
                            </td>
                            <td><?= $featured ?></td>
                            <td><?= $active ?></td>

                            <td>
                                <a href="update-food.php?id=<?= $id ?>" class="btn-secondary">Update</a>
                                <a href="delete-food.php?id=<?= $id ?>&image_name=<?= $image_name ?>" class="btn-danger">Delete</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    //Food not added in database
                    echo "<tr><td colspan='7' class='error'>Food not  added yet.</td></tr>";
                }
            }
            ?>

        </table>
    </div>
</div>
</div>

<!-- Main content section end -->
<?php include "partials/footer.php" ?>