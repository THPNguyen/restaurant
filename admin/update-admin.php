<?php include "partials/menu.php" ?>

<?php
if (isset($_GET['id'])) {
    //1.get the ID of selected admin
    $id = $_GET['id'];
    //2. create SQL query to get  the details
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        // get the details
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $full_name = $row['full_name'];
            $username = $row['username'];
        } else {
            //redirect to manage admin page.
            header('location:' . URLPAGE . 'admin/manage-admin.php');
        }
    }
}
?>
<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="fullname" placeholder="Enter fullname" value="<?= $full_name ?>"></td>
                </tr>
                <tr>
                    <td>UserName</td>
                    <td><input type="text" name="username" placeholder="Enter fullname" value="<?= $username ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" name="id" id="id" value="<?= $id ?>" hidden>
                        <input type="submit" value="Update admin" class="btn-secondary" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<!-- Main content section end -->
<?php include "partials/footer.php" ?>
<?php
//Check whether the submit button is clicked or not.
if (isset($_POST['submit'])) {

    //Get all the values from form to update
    $id = $_POST['id'];
    $full_name = $_POST['fullname'];
    $username = $_POST['username'];
    //create SQL query to update Admin
    $sql = "UPDATE tbl_admin SET 
    full_name = '$full_name',
    username = '$username'
    WHERE id='$id'";
    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if ($res) {
        //Query executed and admin updated
        $_SESSION['update'] = '<div class="success"> Admin updated successfully </div>';
    } else {
        //failed to update admin
        $_SESSION['update'] = '<div class="error"> Failed to Delete Admin </div>';
    }
    //Redirect to manage admin page.
    header('location:' . URLPAGE . '/admin/manage-admin.php');
}
?>

