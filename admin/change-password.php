<?php include "partials/menu.php" ?>

<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <?php
        if (isset($_GET['id'])) {
            //Get the ID of selected Admin 
            $id = $_GET['id'];
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current password</td>
                    <td><input type="text" name="current_password" placeholder="Enter old password"></td>
                </tr>
                <tr>
                    <td>New password</td>
                    <td><input type="text" name="new_password" placeholder="Enter new password"></td>
                </tr>
                <tr>
                    <td>Comfirm password</td>
                    <td><input type="text" name="confirm_password" placeholder="Enter confirm password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" name="id" id="id" value="<?= $id ?>" hidden>
                        <input type="submit" value="Change password" class="btn-secondary" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<!-- Main content section end -->
<?php include "partials/footer.php" ?>
<?php
//check whether the submit button is clicked or not.

if (isset($_POST['submit'])) {
    //1.Get the data from form.
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    //2.Check whether the user with current id and password exists or not
    //Create SQL query to check user.
    $sql  =  "SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password'";
    //Execute the query
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //user exists and password can be changed.
            //3. check whether the new password and confirm match or not.
            if ($new_password === $confirm_password) {
                //4. update the password
                //Create SQL query to update
                $sql_update_pwd = "UPDATE tbl_admin SET password='$new_password'";
                //Execute the query
                $res_update_pwd = mysqli_query($conn, $sql_update_pwd);
                if ($res_update_pwd) {
                    //Redirect to manage admin page with success message.
                    $_SESSION['change-pwd'] = '<div class="success">Password changed success.</div>';
                    header('location:' . URLPAGE . '/admin/manage-admin.php');
                } else {
                    //Redirect  to  manage admin page. with error message.
                    $_SESSION['change-pwd'] = '<div class="error">Password did not udpate.</div>';
                    header('location:' . URLPAGE . '/admin/manage-admin.php');
                }
            } else {
                //Redirect to manage admin page with error  message.
                $_SESSION['pwd-not-match'] = '<div class="error">Password did not match.</div>';
                header('location:' . URLPAGE . '/admin/manage-admin.php');
            }
        } else {
            //the user does not exists set message  and redirect.
            $_SESSION['user-not-found'] = '<div class="error">User not found.</div>';
            header('location:' . URLPAGE . '/admin/manage-admin.php');
        }
    } else {
    }
}
?>