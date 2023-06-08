<?php include('partials/menu.php'); ?>

	<div class="main-content">
		<div class="wrapper">
			<h2>Add Categories</h2>
			<br/>
            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?><br/>


			<form action="" method="POST" onsubmit="return validate();" enctype="multipart/form-data">
				<table class="tbl-50">
					<div class="formbold-mb-2">
						<label for="title" class="formbold-form-label"> Title </label>
						<input type="text" name="title" placeholder="Full Name" class="formbold-form-input" />
						<span class="error">*</span>
					</div><br/>

                    <div class="formbold-mb-2">
                        <label for="title" class="formbold-form-label"> Select Image </label>
                        <input type="file" name="image"/>
                        <span class="error">*</span>
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
                        <input type="submit" name="submit" value="Add Category" class="btn btn-default waves-teal btn-success">
					</div>

				</table>

		    </form>
	    </div>
    </div>


            <!-- Add Category Form Ends -->

<?php include('partials/footer.php'); ?>

<?php
        //Check Apakah Submit Button ter-Click atau tidak
        if(isset($_POST['submit']))
        {
        //                echo "Clicked";

            //1. Mendapatkan Value dari Form Category
            $title = $_POST['title'];
            $active = $_POST['active'];

         //   Untuk Input Radio, Harus Mengecek button ter-select atau tidak
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

//            Check gambar pilihan
            if (isset($_FILES['image']['name']))
            {
//                Upload gambar kita harus mengetahui nama source dan destinasi path
                $image_name = $_FILES['image']['name'];

//                Auto Rename IMage
                $ext = end(explode('.',$image_name));

//                Rename Image
                $image_name = "Food_Category_".rand(000, 999). ','.$ext;

                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/".$image_name;

//                Upload Gambar
                $upload = move_uploaded_file($source_path, $destination_path);

                if($upload==false)
                {
                    $_SESSION['upload'] = "<div class='error''>Failed to Upload Image.</div>";
                    header('location'.HOME."admin/add-category.php");
                    die();
                }
            }else{
                $image_name="";
            }


            //2. Membuat SQL query untuk memasukan data kedalam database
            $sql = " INSERT INTO tbl_category SET
                                     title='$title',
                                     image_name='$image_name',
                                     featured='$featured',
                                     active='$active'
                                     ";

            //3. Eksekusi Query dan Simpan dalam Database
            $res = mysqli_query($conn, $sql);

            //4. Check Apakah query ter-eksekusi dan data tersimpan atau tidak
            if($res==TRUE)
            {
                //Session untuk variable agar menampilkan message
                $_SESSION['add'] = "<div class='success'>Category Added Successfully </div>";
                //Redirect
                header("location:".HOME.'admin/manage-category.php');
            }
            else{
                //Session untuk variable agar menampilkan message
                $_SESSION['add'] = "<div class='failed'>Failed to Add Category </div>";
                //Redirect
                header("location:".HOME.'admin/add-category.php');
            }
        }

?>
