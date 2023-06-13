<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Food</h2>
        <br><br>

        <?php
            if(isset($_SESSION['upload_food']))
            {
                echo $_SESSION['upload_food'];
                unset($_SESSION['upload_food']);
            }
        ?>

        <form action="" method="POST" onsubmit="return validate();" enctype="multipart/form-data">
            <table class="tbl-50">
                <div class="formbold-mb-2">
                    <label for="title" class="formbold-form-label"> Title </label>
                    <input type="text" name="title" placeholder="Title" class="formbold-form-input" />
                    <span class="error">*</span>
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="description" class="formbold-form-label"> Description </label>
                    <textarea name="description" class="formbold-form-input" cols="30" rows="5" placeholder="Description"></textarea>
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="price" class="formbold-form-label"> Price </label>
                    <input type="number" name="price" class="formbold-form-input" />
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
    //                            Create PHP code to display category from database
    //                        1. Create SQL to get all active category
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

    //                        Execute the query
                            $res = mysqli_query($conn, $sql);

    //                        Count riws ti check apakah kita punya kategorinya atau tidak
                            $count = mysqli_num_rows($res);

    //                        IF count is generate than zero, we have category jika tidak ya tidak
                            if($count>0)
                            {
//                                We Hace category
                                while($row=mysqli_fetch_assoc($res))
                                {
//                                    Get the detail of category
                                    $id = $row['id'];
                                    $title = $row['title'];

                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title;?></option>
                                    <?php
                                }
                            }else
                            {
//                              We dont have
                        ?>
                                <option value="0">No Category Found</option>
                        <?php
                            }
                        ?>
                    </select>
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="featured" class="formbold-form-label"> Featured </label>
                    <input type="radio" name="featured" value="Yes" /> Yes
                    <input type="radio" name="featured" value="No" /> No
                </div><br/>

                <div class="formbold-mb-2">
                    <label for="active" class="formbold-form-label"> Active </label>
                    <input type="radio" name="active" value="Yes" /> Yes
                    <input type="radio" name="active" value="No" /> No
                </div><br/>


                <div class="formbold-mb-2">
                    <input type="submit" name="submit" value="Add Food" class="btn btn-default waves-teal btn-success">
                </div>
            </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
//                Mendapatkan data dari form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

//                Check radio for featured dan active
                if(isset($_POST['featured']))
                {
                    //Mendapatkan valued dari form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Set Default Value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

//                2. Upload gambar
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

                            $src = $_FILES['image']['tmp_name'];

                            $dst = "../images/food/".$image_name;

        //                Upload Gambar
                            $upload = move_uploaded_file($src, $dst);

                            if($upload==false)
                            {
                                $_SESSION['upload_food'] = "<div class='error''>Failed to Upload Image.</div>";
                                header('location'.HOME."admin/add-food.php");
                                die();
                            }
                        }
                    }else{
                        $image_name="";
                    }

//                3. Insert to database
                $sql2 = "INSERT INTO tbl_food SET
                         title = '$title',
                         description = '$description',
                         price = $price,
                         image_name = '$image_name',
                         category_id = '$category',
                         featured = '$featured',
                         active = '$active'
                         ";

//                    Exectue the query
                $res2 = mysqli_query($conn, $sql2);

//                CHeck data inserted or not
                if($res2 == true)
                {
//                    Data inserted success
                    $_SESSION['add_food'] = "<div class='success'>Food Added Successfully </div>";
                    //Redirect
                    header('location:'.HOME.'admin/manage-food.php');
                }
                else{
                    //Session untuk variable agar menampilkan message
                    $_SESSION['add_food'] = "<div class='failed'>Failed to Add Food </div>";
                    //Redirect
                    header('location:'.HOME.'admin/manage-food.php');
                }
//                4. Redirect with message
            }

        ?>
    </div>
</div>
<?php include("partials/footer.php")?>
