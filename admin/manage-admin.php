<?php include "partials/menu.php" ?>

<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo "<br>{$_SESSION['add']}<br>";  //display session message.
            unset($_SESSION['add']); //removing session add.
        }
        ?>

        <br>
        <a href="add-admin.php" class="btn-primary">Add admin</a>
        <br>
        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>FullName</th>
                <th>UserName</th>
                <th>Actions</th>
            </tr>
            <?php
            //Query to get all admin
            $sql = "SELECT * FROM tbl_admin";
            //Execute the Query
            $res = mysqli_query($conn, $sql);

            if ($res) {
                //count rows to check whether we have data in database or not.
                $count = mysqli_num_rows($res);

                //check the num of rows
                if ($count > 0) {
                    //We have data in database.
                    $id = 1;
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //using while loopto get all the data in database.
                        //And while loop will run as long as we have data in database.

                        //get individual data
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
            ?>
                        <tr>
                            <td><?= $id++ ?></td>
                            <td><?= $full_name ?></td>
                            <td><?= $username ?></td>
                            <td>
                                <a href="#" class="btn-secondary">Update</a>
                                <a href="#" class="btn-danger">Delete</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            }
            ?>


        </table>
    </div>
</div>

<!-- Main content section end -->
<?php include "partials/footer.php" ?>