<?php include('partials/menu.php'); ?>

        <?php
                if (isset($_GET['id']))
                {
                    $id = $_GET['id'];

                    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

                    $res2 = mysqli_query($conn, $sql2);

                    $row2 = mysqli_fetch_assoc($res2);

                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $current_image = $row2['image_name'];
                    $current_category = $row2['category_id'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];
                }
                else
                {
                    header('location:'.HOME.'admin/manage-food.php');
                }
        ?>

    <div class="main-content">
        <div class="wrapper">
            <h2>Update Food</h2>
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-50">
                    <div class="formbold-mb-2">
                        <label for="title" class="formbold-form-label"> Title </label>
                        <input type="text" name="title" value="<?php echo $title; ?>" class="formbold-form-input" />
                        <span class="error">*</span>
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="description" class="formbold-form-label"> Description </label>
                        <textarea name="description" class="formbold-form-input" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="price" class="formbold-form-label"> Price </label>
                        <input type="number" name="price" class="formbold-form-input" value="<?php echo $price; ?>" />
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="img" class="formbold-form-label"> Current Image </label>
                        <?php
                            if ($current_image =="")
                            {
                                echo "<div class='error'>Image Not Available.</div>";
                            }
                            else
                            {
                        ?>
                                <img src="<?php echo HOME; ?>images/food/<?php echo $current_image; ?>" width="150px">
                        <?php
                            }
                        ?>
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="img" class="formbold-form-label"> Select Image </label>
                        <input type="file" name="image"/>
                        <span class="error">*</span>
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="category" class="formbold-form-label"> Category </label>
                            <select name="category" class="formbold-form-input">
                                <?php
                                    $sql ="SELECT * FROM tbl_category WHERE active='Yes'";

                                    $res = mysqli_query($conn, $sql);

                                    $count = mysqli_num_rows($res);

                                    if($count>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $category_title = $row['title'];
                                            $category_id = $row['id'];

                                ?>
                                        <option <?php if ($current_category==$category_id) {echo "Selected"; } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<option value'0'>Category Not Available.</option>";
                                    }
                                ?>
                            </select>
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="featured" class="formbold-form-label"> Featured </label>
                        <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes" /> Yes
                        <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No" /> No
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="active" class="formbold-form-label"> Active </label>
                        <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes" /> Yes
                        <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No" /> No
                    </div><br/>


                    <div class="formbold-mb-2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn btn-default waves-teal btn-success">
                    </div>
                </table>
            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $current_image = $_POST['current_image'];
                    $category = $_POST['category'];

                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

    //                2. Upload gambar baru
                    //                Check gambar pilihan
                    if (isset($_FILES['image']['name']))
                    {
                        //                Upload gambar kita harus mengetahui nama source dan destinasi path
                        $image_name = $_FILES['image']['name'];

                        if ($image_name!="")
                        {

                            //                Auto Rename IMage
                            $up_img = explode('.', $image_name);
                            $ext = end($up_img);

                            //                Rename Image
                            $image_name = "Food_img_".rand(000, 999). '.'.$ext;

                            $src_path = $_FILES['image']['tmp_name'];

                            $dst_path = "../images/food/".$image_name;

                            //                Upload Gambar
                            $upload = move_uploaded_file($src_path, $dst_path);

                            if($upload==false)
                            {
                                $_SESSION['upload'] = "<div class='error''>Failed to Upload Image.</div>";
                                header('location'.HOME."admin/manage-food.php");
                                die();
                            }
    //                            Delete current image
                            if($current_image!="")
                            {
                                $remove_path = "../images/food/".$current_image;

                                $remove = unlink($remove_path);

                                if($remove==false)
                                {
                                    $_SESSION['failed-remove'] = "<div class='failed'>Failed to Remove Current Image</div>";
                                    header('location'.HOME."admin/manage-food.php");
                                    die();
                                }
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }

    //                    4. Update Food in database
                    $sql3 = " UPDATE tbl_food SET
                            title = '$title',
                            description = '$description',
                            price = $price,
                            image_name = '$image_name',
                            category_id = '$category',
                            featured = '$featured',
                            $active = '$active'
                            WHERE id=$id
                    ";

    //                    Execute the query
                    $res3 = mysqli_query($conn, $sql3);

                    if($res3==true)
                    {
    //                     CAtegory updated
                        $_SESSION['updated'] = "<div class='success'>Food Updated Succesfully</div>";
                        header("location:".HOME.'admin/manage-food.php');
                    }else
                    {
                        $_SESSION['updated'] = "<div class='failed'>Failed to Update Food</div>";
                        echo "<script> window.location.href='admin/update-food.php';</script>";
                    }

                }

            ?>
        </div>
    </div>

<?php include('partials/footer.php'); ?>