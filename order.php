<?php include "partials-fontend/menu.php" ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
        <?php
        //Check id is available or not
        if (isset($_GET['food_id'])) {
            $id = $_GET['food_id'];
            //create SQL query
            $sql = "SELECT * FROM tbl_food WHERE id='$id'";
            //Execute SQL query
            $res = mysqli_query($conn, $sql);
            if ($res) {
                //Count 
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    $row =  mysqli_fetch_assoc($res);
                    $image_name = $row['image_name'];
                    $title = $row['title'];
                    $price = $row['price'];
        ?>
                    <form action="#" method="post" class="order">
                        <fieldset>
                            <legend>Selected Food</legend>

                            <div class="food-menu-img">
                                <img src="images/food/<?= $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            </div>

                            <div class="food-menu-desc">
                                <h3><?= $title ?></h3>
                                <p class="food-price"><?= $price ?></p>

                                <div class="order-label">Quantity</div>
                                <input type="number" name="qty" class="input-responsive" min="1" value="1" required>

                            </div>

                        </fieldset>

                        <fieldset>
                            <legend>Delivery Details</legend>
                            <div class="order-label">Full Name</div>
                            <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                            <div class="order-label">Phone Number</div>
                            <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                            <div class="order-label">Email</div>
                            <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                            <div class="order-label">Address</div>
                            <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                            <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                            <input type="text" name="food" value="<?= $title ?>" hidden>
                            <input type="text" name="price" value="<?= $price ?>" hidden>

                        </fieldset>

                    </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php

                }
            }
        }
?>

<?php
if (isset($_POST['submit'])) {
    //1. get data from form.
    $food = $_POST['food'];
    $price = $_POST['price'];
    $quantity = $_POST['qty'];
    $total = $price * $quantity;
    $order_date = date('Y-m-d h:i:sa');
    $status = "order";
    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];
    //2. create sql query
    $sql = "INSERT INTO tbl_order SET 
    food= '$food',
    price= '$price',
    quantity= '$quantity',
    total= '$total',
    order_date= '$order_date',
    status= '$status',
    customer_name= '$customer_name',
    customer_contact= '$customer_contact',
    customer_email= '$customer_email',
    customer_address= '$customer_address'
    ";
    //Execute the sql query
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $_SESSION['order'] = "<div class='success'>Food ordered successfully.</div>";
    } else {
        $_SESSION['order'] = "<div class='error'>Failed to order food.</div>";
    }
    header('location:' . URLPAGE);
}

?>
<?php include "partials-fontend/footer.php" ?>