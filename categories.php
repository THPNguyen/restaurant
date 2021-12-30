<?php include "partials-fontend/menu.php" ?>


<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
        //1. Create SQL query to display from database.
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes'";
        //Execute the SQL query
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $image_name = $row['image_name'];
                    $title = $row['title'];

        ?>
                    <a href="category-foods.php">
                        <div class="box-3 float-container">
                            <?php if (empty($image_name)) {
                                echo "<div class='error'>Image is empty</div >";
                            } else {
                            ?>
                                <img src="images/category/<?= $image_name ?>" alt="<?= $title ?>" class="img-responsive img-curve">
                            <?php } ?>
                            <h3 class="float-text text-white"><?= $title ?></h3>
                        </div>
                    </a>

        <?php
                }
            } else {
                //Categories are not available
                echo "<div class='error'>Category is empty</div >";
            }
        }


        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include "partials-fontend/footer.php" ?>