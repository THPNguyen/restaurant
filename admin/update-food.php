<?php include "partials/menu.php"; ?>

<?php
if (isset($_GET['id'])) {
    //1.get the ID of selected category
    $id = $_GET['id'];
    //2. create SQL query to get  the details
    $sql = "SELECT * FROM tbl_food WHERE id=$id";
    //Execute the Query to get the seletec category
    $res = mysqli_query($conn, $sql);
    if ($res) {
        // get the details
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
            $category = $row['category_id'];
        } else {

            //category with session message.
            $_SESSION['Not-food-found'] = ' <div class="error">food not found</div >';
            //redirect to manage admin page.
            header('location:' . URLPAGE . 'admin/manage-admin.php');
        }
    }
}
?>
<!-- Main content section start -->
<div class="content">
    <div class="wrapper">
        <h1>Update food</h1>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>title</td>
                    <td><input type="text" name="title" value="<?= $title ?>"></td>
                </tr>

                <tr>
                    <td>description</td>
                    <td>
                        <textarea name="description" id="description" cols="30" rows="10"><?= $description ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>price</td>
                    <td><input type="text" name="price" value="<?= $price ?>"></td>
                </tr>

                <tr>
                    <td>current image</td>
                    <?php if (!empty($current_image)) : ?>
                        <td>
                            <img width="200px" src="<?= URLPAGE ?>/images/food/<?= $current_image ?>" alt="food <?= $title ?>">
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
                    <td>Category </td>
                    <td>
                        <select name="category" id="category">
                            <?php
                            //Create php code to display categories from database.
                            //1.Create SQL to get all category
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //Execute the SQL query
                            $res = mysqli_query($conn, $sql);
                            if ($res) {
                                //count the data from database available or not
                                $count = mysqli_num_rows($res);
                                if ($count > 0) {
                                    //2.Display on dropdown 
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $category_id = $row['id'];
                                        $title = $row['title'];
                            ?>


                                        <?php
                                        if ($category_id === $category) {
                                        ?>
                                            <option value="<?= $category_id ?>" selected><?= $title ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?= $category_id ?>"><?= $title ?></option>
                                    <?php
                                        }
                                    }
                                } else {
                                    //We do not have category.
                                    ?>
                                    <option value="0">No category Found</option>

                            <?php
                                }
                            }


                            ?>
                        </select>

                    </td>
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
                        <input type="radio" name="active" value="Yes" <?= ($active === "Yes") ? "checked" : "" ?>> Yes
                        <input type="radio" name="active" value="No" <?= ($active === "No") ? "checked" : "" ?>> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" name="id" id="id" value="<?= $id ?>" hidden>
                        <input type="submit" value="Update food" class="btn-secondary" name="submit">
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
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    if (isset($_FILES['fimage']['name'])) {
        $image_name = $_FILES['fimage']['name'];
        if ($image_name != "") {
            //auto rename our image
            //get the extension of our image(jpg, png, gif, ) 
            $ext = end(explode('.', $image_name));

            //Rename the image
            $image_name = "Food_food_" . rand(000, 999) . '.' . $ext;

            $source_path = $_FILES['fimage']['tmp_name'];

            $destination_path = "../images/food/{$image_name}";
            //finally upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            //check whether the image is uploaded or not 
            //and if the image is not uploaded then we will stop the process and redirect with error message 
            if ($upload == false) {
                //set message
                $_SESSION['upload'] = '<div class="error">Failed to upload image.</div>';
                //redirect to add food page
                header('location:' . URLPAGE . '/admin/manage-food.php');
                //stop the process.
                die();
            }
            //check the current image is available
            if (!empty($current_image)) {
                //8.Remove the current image
                $remove_path = "../images/food/" . $current_image;
                if (file_exists($remove_path)) {
                    $remove = unlink($remove_path);
                    //check whether the image is removed or not
                    //if failed to remove then display message and stop the process
                    if (!$remove) {
                        //Failed to remove image
                        $_SESSION['failed-remove'] = '<div class="error">failed to remove the current image</div>';
                        header('location:' . URLPAGE . '/admin/add-food.php');
                        die();
                    }
                }
            }
        }
    } else {
        $image_name = $current_image;
    }

    //create SQL query to update food
    $sql = "UPDATE tbl_food SET 
    title='$title', 
    description='$description',
    price='$price',
    image_name='$image_name',
    category_id='$category',
    featured='$featured', 
    active='$active'
    WHERE id=$id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);

    //Check whether the query executed successfully or not
    if ($res) {
        //Query executed and food updated
        $_SESSION['update'] = '<div class="success"> food updated successfully </div>';
        //Redirect to manage food page.
        header('location:' . URLPAGE . '/admin/manage-food.php');
    } else {
        //failed to update food
        $_SESSION['update'] = '<div class="error"> Failed to update food </div>';
        //Redirect to manage food page.
        header('location:' . URLPAGE . '/admin/manage-food.php');
    }
}
?>

<?php include "partials/footer.php"; ?>