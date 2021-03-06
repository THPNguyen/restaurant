<?php
require "../config/constants.php";
//check whether the id and image_name value is set or not 
if (isset($_GET['id'])  and isset($_GET['image_name'])) {
    //1. get the ID of category to be deleted 
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //Remove the physical image file is available
    if($image_name != '')
    {
        //Image is Available. So remove it
        $path = "../images/category/".$image_name;
        //Remove the image
        $remove = unlink($path);

        //If failed to remove image the add an error message and stop the process.
        if(!$remove)
        {
            //Set the session message
            $_SESSION['remove'] = '<div class="error">Failed to remove the  category image</div>';
            //redirect to manage category page.
            header('location: ' . URLPAGE . '/admin/manage-category.php');
            //stop the process
            die();
        }
    }
    //2. Create SQL Query to DELETE category
    $sql = "DELETE FROM tbl_category WHERE id=$id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);
    //3. Redirect to Mange Admin page with message (success/error)
    if ($res === true) {
        $_SESSION['delete'] = "<div class='success'>Category deleted successfully</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete Category.Try Again Later.</div>";
    }

    header('location: ' . URLPAGE . '/admin/manage-category.php');
}
