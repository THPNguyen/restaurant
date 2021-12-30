<?php include "partials-fontend/menu.php" ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php

if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>
<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
        //1. Create SQL query to display the categories from database.
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3 ";
        //Execute the SQL query
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $image_name = $row['image_name'];
                    $title = $row['title'];
                    $category_id = $row['id'];

        ?>
                    <a href="category-foods.php?category_id=<?= $category_id ?>">
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

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        //1. Create SQL query to display the food from database.
        $sql = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 12";
        //Execute the SQL query
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $image_name = $row['image_name'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
        ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <img src="images/food/<?= $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        </div>
                        <div class="food-menu-desc">
                            <h4><?= $title ?></h4>
                            <p class="food-price"><?= $price ?></p>
                            <p class="food-detail">
                                <?= $description ?>
                            </p>
                            <br>

                            <a href="order.html" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
        <?php
                }
            } else {
                //Categories are not available
                echo "<div class='error'>Food is empty</div >";
            }
        }
        ?>
        <div class="clearfix"></div>
    </div>
    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include "partials-fontend/footer.php" ?>