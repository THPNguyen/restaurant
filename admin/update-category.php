<?php include "partials/menu.php" ?>

<?php
if (isset($_GET['id'])) {
    //1.get the ID of selected category
    $id = $_GET['id'];
    //2. create SQL query to get  the details
    $sql = "SELECT * FROM tbl_category WHERE id=$id";
    //Execute the Query to get the seletec category
    $res = mysqli_query($conn, $sql);
    if ($res) {
        // get the details
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
        } else {

            //category with session message.
            $_SESSION['Not-cateogry-found'] = ' <div class="error">Category not found</div >';
            //redirect to manage admin page.
            header('location:' . URLPAGE . 'admin/manage-admin.php');
        }
    }
}
?>
<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>title</td>
                    <td><input type="text" name="title" value="<?= $title ?>"></td>
                </tr>
                <tr>
                    <td>current image</td>
                    <?php if (!empty($current_image)) : ?>
                        <td>
                            <img width="200px" src="<?= URLPAGE ?>/images/category/<?= $current_image ?>" alt="category <?= $title ?>">
                        </td>
                    <?php else : ?>
                        <td>
                            <div class="error"> Image not added</div>
                        </td>
                    <?php endif ?>
                </tr>
                <tr>
                    <td>new image</td>
                    <td><input type="file" name="fimage"></td>
                </tr>
                <tr>
                    <td>featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?= ($featured == "Yes") ? "checked" : "" ?>> Yes
                        <input type="radio" name="featured" value="No" <?= ($featured == "No") ? "checked" : "" ?>> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?= ($active == "Yes") ? "checked" : "" ?>> Yes
                        <input type="radio" name="active" value="No" <?= ($active == "No") ? "checked" : "" ?>> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" name="id" id="id" value="<?= $id ?>" hidden>
                        <input type="submit" value="Update category" class="btn-secondary" name="submit">
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
    $title = $_POST['title'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    if (isset($_FILES['fimage']['name'])) {
        $image_name = $_FILES['fimage']['name'];
        if (!empty($image_name)) {
            //auto rename our image
            //get the extension of our image(jpg, png, gif, ) 
            $ext = end(explode('.', $image_name));

            //Rename the image
            $image_name = "Food_category_" . rand(000, 999) . '.' . $ext;

            $source_path = $_FILES['fimage']['tmp_name'];

            echo $destination_path = "../images/category/{$image_name}";
            //finally upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //check whether the image is uploaded or not 
            //and if the image is not uploaded then we will stop the process and redirect with error message 
            if ($upload == false) {
                //set message
                $_SESSION['upload'] = '<div class="error">Failed to upload image.</div>';
                //redirect to add category page
                header('location:' . URLPAGE . '/admin/manage-category.php');
                //stop the process.
                die();
            }
            //check the current image is available
            if (!empty($current_image)) {
                //8.Remove the current image
                $remove_path = "../images/category/" . $current_image;
                $remove = unlink($remove_path);
                //check whether the image is removed or not
                //if failed to remove then display message and stop the process
                if (!$remove) {
                    //Failed to remove image
                    $_SESSION['failed-remove'] = '<div class="error">failed to remove the current image</div>';
                    header('location:' . URLPAGE . '/admin/add-category.php');
                    die();
                }
            }
        }
    } else {
        $image_name = $current_image;
    }

    //create SQL query to update category
    $sql = "UPDATE tbl_category SET 
    title='$title', 
    image_name='$image_name',
    featured='$featured', 
    active='$active'
    WHERE id=$id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if ($res) {
        //Query executed and category updated
        $_SESSION['update'] = '<div class="success"> category updated successfully </div>';
    } else {
        //failed to update category
        $_SESSION['update'] = '<div class="error"> Failed to Delete category </div>';
    }
    //Redirect to manage category page.
    header('location:' . URLPAGE . '/admin/manage-category.php');
}
?>