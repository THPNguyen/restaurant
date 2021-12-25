<?php
require "../config/constants.php";

if (isset($_GET['id'])) {
    //1. get the ID of Admin to be deleted 
    $id = $_GET['id'];
    //2. Create SQL Query to DELETE Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    $cmd = mysqli_query($conn, $sql);
    //3. Redirect to Mange Admin page with message (success/error)
    if ($cmd === true) {
        $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete Admin.Try Again Later.</div>";
    }

    header('location: ' . URLPAGE . '/admin/manage-admin.php');
}
?>
