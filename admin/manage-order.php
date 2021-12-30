<?php include "partials/menu.php" ?>

<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br><br>

        <a href="#" class="btn-primary">Add admin</a>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order date</th>
                <th>Status</th>
                <th>Customer name</th>
                <th>Customer contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            <?php
            //Get all the orders from database 
            $sql = "SELECT * FROM tbl_order";
            //Execute the sql query
            $res = mysqli_query($conn, $sql);
            if ($res) {
                //count the rows
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    $sn = 0;
                    while ($row = mysqli_fetch_assoc($res)) {
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
            ?>

                        <tr>
                            <td><?= $sn++ ?></td>
                            <td><?= $food ?></td>
                            <td><?= $price ?></td>
                            <td><?= $quantity ?></td>
                            <td><?= $total ?></td>
                            <td><?= $order_date ?></td>
                            <td <?php
                                switch ($status) {
                                    case "Order":
                                        echo "style=\"color:green;\"";
                                        break;
                                    case "On Delivery":
                                        echo "style=\"color:red;\"";
                                        break;
                                    case "Delivered":
                                        echo "style=\"color:yellow;\"";
                                        break;
                                    case "Cancelled":
                                        echo "style=\"color:blue;\"";
                                        break;
                                };
                                ?>><?= $status ?></td>
                            <td><?= $customer_name ?></td>
                            <td><?= $customer_contact ?></td>
                            <td><?= $customer_email ?></td>
                            <td><?= $customer_address ?></td>
                            <td>
                                <a href="update-order.php?id=<?= $id ?>" class="btn-secondary">Update</a>
                                <a href="#" class="btn-danger">Delete</a>
                            </td>
                        </tr>

            <?php
                    }
                } else {
                    echo "<tr > <td class='error text-center' colspan='12'>the order is not available<td></tr>";
                }
            }
            ?>


        </table>
    </div>
</div>
</div>

<!-- Main content section end -->
<?php include "partials/footer.php" ?>