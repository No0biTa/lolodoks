<?php include('partials/menu.php'); ?>

	<div class="main-content">
		<div class="wrapper">
			<h2>Add Admin</h2>
			<br/>
            <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?><br/>


			<form action="" method="POST" onsubmit="return validate();">
				<table class="tbl-50">
					<div class="formbold-mb-2">
						<label for="title" class="formbold-form-label"> Title </label>
						<input type="text" name="title" placeholder="Full Name" class="formbold-form-input" />
						<span class="error">*</span>
					</div><br/>

                    <div class="formbold-mb-2">
                        <label for="featured" class="formbold-form-label"> Featured </label>
                        <input type="text" name="featured" placeholder="Username" class="formbold-form-input" />
                        <span class="error">*</span>
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="active" class="formbold-form-label"> Active </label>
                        <input type="active" name="active" id="password" placeholder="Password" class="formbold-form-input" />
                    </div><br/>


					<div class="formbold-mb-2">
                        <input type="submit" name="submit" value="Save" class="btn btn-default waves-teal btn-success">
					</div>

				</table>

		    </form>
	    </div>
    </div>


<?php include('partials/footer.php'); ?>


<?php
	//Process The Value Form and Save it in Database
	//check wheter the submit button is clicked or not
	if(isset($_POST['submit']))
	{
		$title = $_POST['title'];
		$featured = $_POST['featured'];
		$active = $_POST['active'];//Passwrod Encryption with MD5

        if (empty($title) or empty($featured) or empty($active)) {
            return false;
        }

		//Query SQL untuk menyimpan data ke DB
		$sql = " INSERT INTO tbl_category SET
			title='$title',
			featured='$featured',
			active='$active'
		
		";

		// Execute Query dan Simpan ke Database
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

		if($res==TRUE)
		{
			//Session untuk variable agar menampilkan message
			$_SESSION['add'] = "<div class='success'>Admin Added Successfully </div>";
			//Redirect
			header("location:".HOME.'admin/manage-admin.php');
		}
		else{
			//Session untuk variable agar menampilkan message
			$_SESSION['add'] = "<div class='failed'>Failed to Add Admin </div>";
			//Redirect
			header("location:".HOME.'admin/add-admin.php');
		}

	}
?>
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
            <br><br>

            <!-- Add Category Form Start -->
            <form action="" method="POST" onsubmit="return validate();">

                <table class="tbl-50">
                    <div class="formbold-mb-2">
                        <label for="title" class="formbold-form-label"> Title </label>
                        <input type="text" name="title" placeholder="Category Title" class="formbold-form-input" />
                        <span class="error">*</span>
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="featured" class="formbold-form-label"> Featured </label>
                        <input type="text" name="featured" value="Yes"/>
                    </div><br/>

                    <div class="formbold-mb-2">
                        <label for="active" class="formbold-form-label"> Active </label>
                        <input type="text" name="active" value="Yes"/>
                    </div><br/>

                    <div class="formbold-mb-2">
                        <input type="submit" name="submit" value="Save" class="btn btn-default waves-teal btn-success">
                        <a href="manage-category.php"><button type="button" class="btn btn-default waves-teal btn-danger">Cancel</button></a>
                    </div>


                </table>
            </form>

            <!-- Add Category Form Ends -->

        </div>
    </div>

<?php include('partials/footer.php'); ?>

<?php
        //Check Apakah Submit Button ter-Click atau tidak
        if(isset($_POST['submit']))
        {
        //                echo "Clicked";

            //1. Mendapatkan Value dari Form Category
            $title = $_POST['title'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //Untuk Input Radio, Harus Mengecek button ter-select atau tidak
        //                if(isset($_POST['featured']))
        //                {
        //                    //Mendapatkan valued dari form
        //                    $featured = $_POST['featured'];
        //                }
        //                else
        //                {
        //                    //Set Default Value
        //                    $featured = "No";
        //                }
        //
        //                if(isset($_POST['active']))
        //                {
        //                    $active = $_POST['active'];
        //                }
        //                else
        //                {
        //                    $active = "No";
        //                }

            //2. Membuat SQL query untuk memasukan data kedalam database
            $sql = " INSERT INTO tbl_category SET
                                     title='$title',
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
