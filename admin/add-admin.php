<?php include('partials/menu.php'); ?>
 
 <div class="main-content">
		<div class="wrapper">
		   <h1>Add Admin</h1>
		   <br><br>
		   <form action="" method="POST">
				<table class="tbl-50">
					<tr>
						<td>Full Name</td>
						<td>	
							<input type="text" name="full_name" placeholder="Enter Your Name">
						</td>
					</tr>
					
					<tr>
						<td>Username</td>
						<td>
							<input type="text" name="username" placeholder="Your Username">
						</td>
					</tr><br/>
					
					<tr>
						<td>Password </td>
						<td>
							<input type="password" name="password" placeholder="Your Password"> 
						</td>
					</tr>
					
					<tr>
						<td>
							<input type="submit" name="submit" value="Save" class="btn btn-default waves-teal btn-success">
					</tr>
					
				</table>
				
		</form>
		</div>


<?php include('partials/footer.php'); ?>


<?php
	//Process The Value Form and Save it in Database
	//check wheter the submit button is clicked or not 
	if(isset($_POST['submit']))
	{
		$full_name = $_POST['full_name'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);//Passwrod Encryption with MD5

		//Query SQL untuk menyimpan data ke DB
		$sql = " INSERT INTO tbl_admin SET
			full_name='$full_name',
			username='$username',
			password='$password'
		
		";

		// Execute Query dan Simpan ke Database
		$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

		if($res==TRUE)
		{
			//Session untuk variable agar menampilkan message
			$_SESSION['add'] = "Admin Added Successfully";
			//Redirect
			header("location:".HOME.'admin/manage-admin.php');
		}
		else{
			//Session untuk variable agar menampilkan message
			$_SESSION['add'] = "Failed to Add Admin";
			//Redirect
			header("location:".HOME.'admin/add-admin.php');
		}

	}
?>