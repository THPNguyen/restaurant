<?php include "partials/menu.php"; ?>

<?php
if (isset($_GET['id'])) {
    //1.get the ID of selected category
    $id = $_GET['id'];
    //2. create SQL query to get  the details
    $sql = "SELECT * FROM tbl_order WHERE id=$id";
    //Execute the Query to get the seletec category
    $res = mysqli_query($conn, $sql);
    if ($res) {
        // get the details
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $food = $row['food'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $total = $row['total'];
            $order_date = $row['order_date'];
            $status = $row['status'];
            $customer_name = $row['customer_name'];
            $customer_contact = $row['customer_contact'];
            $customer_email = $row['customer_email'];
            $customer_address = $row['customer_address'];
            $id = $row['id'];
        } else {

            //category with session message.
            $_SESSION['Not-order-found'] = ' <div class="error">order not found</div >';
            //redirect to manage admin page.
            header('location:' . URLPAGE . 'admin/manage-order.php');
        }
    }
}
?>
<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>Update food</h1>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food</td>
                    <td><input type="text" name="food" value="<?= $food ?>"></td>
                </tr>

                <tr>
                    <td>price</td>
                    <td><input type="number" name="price" value="<?= $price ?>"></td>
                </tr>
                <tr>
                    <td>quantity</td>
                    <td><input type="number" name="quantity" value="<?= $quantity ?>"></td>
                </tr>
                <tr>
                    <td>order_date</td>
                    <td><input type="date" name="order_date" value="<?= $order_date ?>"></td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>
                        <select name="status">
                            <?php
                            $list_status[] = "Order";
                            $list_status[] = "On Delivery";
                            $list_status[] = "Delivered";
                            $list_status[] = "Cancelled";
                            foreach ($list_status as $key => $value) :
                                if ($value == $status) {
                                    echo "<option value='$value' selected>$value</option>";
                                } else {
                                    echo "<option value='$value'>$value</option>";
                                }
                            ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>customer_name</td>
                    <td><input type="text" name="customer_name" value="<?= $customer_name ?>"></td>
                </tr>
                <tr>
                    <td>customer_contact</td>
                    <td><input type="tel" name="customer_contact" value="<?= $customer_contact ?>"></td>
                </tr>
                <tr>
                    <td>customer_email</td>
                    <td><input type="email" name="customer_email" value="<?= $customer_email ?>"></td>
                </tr>
                <tr>
                    <td>customer_address</td>
                    <td><input type="text" name="customer_address" value="<?= $customer_address ?>"></td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="text" name="id" id="id" value="<?= $id ?>" hidden>
                        <input type="submit" value="Update order" class="btn-secondary" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<!-- Main content section end -->

<?php
//Check whether the submit button is clicked or not.
if (isset($_POST['submit'])) {
    //Get all the values from form to update
    $food = $_POST['food'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $total = $price * $quantity;
    $order_date = $_POST['order_date'];
    $status = $_POST['status'];
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];
    $id = $_POST['id'];
    //create SQL query to update food
    $sql = "UPDATE tbl_order SET 
    food= '$food',
    price= $price,
    quantity= $quantity,
    total= $total,
    order_date= '$order_date',
    status= '$status',
    customer_name= '$customer_name',
    customer_contact= '$customer_contact',
    customer_email= '$customer_email',
    customer_address= '$customer_address'
    WHERE id=$id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if ($res) {
        //Query executed and order updated
        $_SESSION['update'] = '<div class="success"> order updated successfully </div>';
        //Redirect to manage order page.
        header('location:' . URLPAGE . '/admin/manage-order.php');
    } else {
        //failed to update order
        $_SESSION['update'] = '<div class="error"> Failed to update order </div>';
        //Redirect to manage order page.
        header('location:' . URLPAGE . '/admin/manage-order.php');
    }
}
?>

<?php include "partials/footer.php"; ?>