<?php include "partials/menu.php" ?>

<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <?php
        if (isset($_SESSION['add'])) {
            echo "<br>{$_SESSION['add']}<br>"; //display session message.
            unset($_SESSION['add']); //removing session add.
        }
        
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="fullname" placeholder="Enter fullname"></td>
                </tr>
                <tr>
                    <td>UserName</td>
                    <td><input type="text" name="username" placeholder="Enter fullname"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password" placeholder="Enter fullname"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Save" class="btn-secondary" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<!-- Main content section end -->
<?php include "partials/footer.php" ?>
<?php
//Process the value from form and Save it in database.
if (isset($_POST['submit'])) {
    //get the data from Form.
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password  = md5($_POST['password']);
    //SQL Query to save the data into database.
    $sql = "INSERT INTO tbl_admin SET full_name='$fullname', username='$username', password='$password'";
    //3. Executing query and saving data into database.
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    //check whether the (Query is Executed) data is inserted or not and display appropriate message
    $_SESSION['add'] = $res ? "Add is successfully" : "Add is failure";
    header("Location:".URLPAGE."/admin/manage-admin.php");
}
?>