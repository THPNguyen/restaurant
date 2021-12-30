<?php include "partials/menu.php" ?>

<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>DASHBOARD</h1>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <?php
        //Create sql query to display the quantity of categories.
        $sql = "SELECT * FROM tbl_category";
        //Execute the sql query
        $res = mysqli_query($conn, $sql);
        if ($res) {
            //count the items
            $count = mysqli_num_rows($res);
            if ($count > 0) {
        ?>
                <div class="col-4 text-center">
                    <h1><?= $count ?></h1>
                    <br>
                    Cateogries
                </div>
        <?php
            } else {
                //the database is not any row of item
                echo "<div class='error col-4 text-center'>The data of category is empty</div>";
            }
        }
        ?>
        <?php
        //Create sql query to display the quantity of categories.
        $sql = "SELECT * FROM tbl_food";
        //Execute the sql query
        $res = mysqli_query($conn, $sql);
        if ($res) {
            //count the items
            $count = mysqli_num_rows($res);
            if ($count > 0) {
        ?>
                <div class="col-4 text-center">
                    <h1><?= $count ?></h1>
                    <br>
                    Foods
                </div>
        <?php
            } else {
                //the database is not any row of item
                echo "<div class='error col-4 text-center'>The data of category is empty</div>";
            }
        }
        ?>
        <?php
        //Create sql query to display the quantity of categories.
        $sql = "SELECT * FROM tbl_order";
        //Execute the sql query
        $res = mysqli_query($conn, $sql);
        if ($res) {
            //count the items
            $count = mysqli_num_rows($res);
            if ($count > 0) {
        ?>
                <div class="col-4 text-center">
                    <h1><?= $count ?></h1>
                    <br>
                    Total order
                </div>
        <?php
            } else {
                //the database is not any row of item
                echo "<div class='error col-4 text-center'>The data of category is empty</div>";
            }
        }
        ?>
        <?php
        //Create sql query to display the quantity of categories.
        $sql = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
        //Execute the sql query
        $res = mysqli_query($conn, $sql);
        if ($res) {
            //count the items
            $row = mysqli_fetch_assoc($res);
            $total = $row['Total'];
        } ?>
        <div class="col-4 text-center">
            <h1>$<?= $total ?></h1>
            <br>
            Revenue Generated
        </div>
        <div class="clearfix">

        </div>
    </div>
</div>

<!-- Main content section end -->
<?php include "partials/footer.php" ?>