<?php include ('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h2> Update Category</h2>

        <br><br>

        <?php
        //            Chech ID ter set atau tidak
                if(isset($_GET['id']))
                {
        //            Mendapatkan semua detail
                    $id=$_GET['id'];
        //            Create SQL query untuk mendapatkan data
                    $sql="SELECT * FROM tbl_category WHERE id=$id";

        //            Execute the query
                    $res=mysqli_query($conn, $sql);

        //            Count the rows
                    $count=mysqli_num_rows($res);

                    if ($count==1)
                    {
        //                Get all data
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
        //                Redirect to manage cotegory with session
                        $_SESSION['no-category-found'] = "<div class='failed'>No Category Found. </div>";
                        header("location:".HOME.'admin/manage-category.php');
                    }

                }
                else
                {
                    header("location:".HOME.'admin/manage-category.php');
                }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-full">

                <div class="formbold-mb-2">
                    <label for="title" class="formbold-form-label"> Title </label>
                    <input type="text" name="title" value="<?php echo $title;?>" class="formbold-form-input" />
                    <span class="error">*</span>
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="title" class="formbold-form-label"> Current Image </label>
                    <?php
                        if ($current_image != "")
                        {
//                            Display Image
                            ?>
                            <img src="<?php echo HOME; ?>images/category/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }else
                        {
                            echo "<div class='error'>Image Not Added.</div>";
                        }
                    ?>
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="title" class="formbold-form-label"> Select New Image </label>
                    <input type="file" name="image"/>
                    <span class="error">*</span>
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="featured" class="formbold-form-label"> Featured </label>
                    <input <?php if ($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes" /> Yes
                    <input <?php if ($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="Yes" /> No
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="active" class="formbold-form-label"> Active </label>
                    <input <?php if ($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes" /> Yes
                    <input <?php if ($active=="No"){echo "checked";} ?> type="radio" name="active" value="No" /> No
                </div><br/>

                <div class="formbold-mb-2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update Category" class="btn btn-default waves-teal btn-success">
                </div>

            </table>
        </form>

        <?php
            if(isset($_POST['submit']))
            {
//                Mendapatkan value dari form
                $id=$_POST['id'];
                $title=$_POST['title'];
                $current_image=$_POST['current_image'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

//                Update image
//                Check image selected atau tidak
                if (isset($_FILES['image']['name']))
                {
//                    Mendapatkan detail image
                    $image_name = $_FILES['image']['name'];

//                    Check imagea avail atau tidak
                    if ($image_name != "")
                    {
//                        Imgae avail
//                        upload new image
//                        Auto Rename IMage
                                $ext = end(explode('.',$image_name));

            //                Rename Image
                                $image_name = "Food_Category_".rand(000, 999). '.'.$ext;

                                $source_path = $_FILES['image']['tmp_name'];

                                $destination_path = "../images/category/".$image_name;

            //                Upload Gambar
                                $upload = move_uploaded_file($source_path, $destination_path);

                                if($upload==false)
                                {
                                    $_SESSION['upload'] = "<div class='error''>Failed to Upload Image.</div>";
                                    header('location'.HOME."admin/manage-category.php");
                                    die();
                                }
//                        Remove current image jika tersedia
                        if ($current_image !="")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);

//                        Cehck image terhapus atau tidak
                            if ($remove==false)
                            {
                                $_SESSION['failed-remove'] = "<div class='failed'>Failed to Update Category</div>";
                                header('location'.HOME."admin/manage-category.php");
                                die();
                            }
                        }

                    }else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

//                Upload new image

//                Updatea database
                $sql2="UPDATE tbl_category SET
                    title='$title',
                    image_name = '$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                    ";

//                Exectuer the query
                $res2 = mysqli_query($conn, $sql2);

//                Redirect to maanage category

//                Check exectued atau tidak
                if ($res2==true)
                {
//                    CAtegory updated
                    $_SESSION['updated'] = "<div class='success'>Category Updated Succesfully</div>";
                    header("location:".HOME.'admin/manage-category.php');
                }else
                {
                    $_SESSION['updated'] = "<div class='failed'>Failed to Update Category</div>";
                    header("location:".HOME.'admin/update-category.php');
                }

            }

        ?>
    </div>
</div>

<?php include ('partials/footer.php');?>
