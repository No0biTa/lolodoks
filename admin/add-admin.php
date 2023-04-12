 <?php include('partials/menu.php'); ?>
 
 <div class="main-content">
		<div class="wrapper">
		   <h1>add Admin</h1>
		   
		   <br><br>
		   
		   <form action="" method="POST"></form>
		   
				<table Class="tbl-30">>
					<tr>
						<td>Full Name</td>
						<td>	
							<td><input type="text" name="full_name" placeholder="Enter Your Name">
						</td>
					</tr>
					
					<tr>
						<td>Username</td>
						<td>
							<td><input type="text" name="full_name" placeholder="Your Username">
						</td>
					</tr>
					
					<tr>
						<td>Password: </td>
						<td>
							<input type="password" name="password" placeholder="Your Password"> 
						</td>
					</tr>
					
					<tr>
						<td> colspan="2">
							<input type="submit" name="submit" value="add admin" class="bts-success">
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
		//BUtton Clicked 
		//echo "button Clicked";
		
		//Get the data from Form
		$full_name = $_POST["full_name"];
		$username = $_POST["username"];
		$password = md5($_POST["password"]);//Passwrod Encryption with MD5
		
		//SQL QUery to Save data into Database
		$sql = "INSERT INTO tbl_admin SET 
			full_name="$full_name",
			username="$username",
			password="$password"
		";
		
		// Execute QUery and Save Data in Database
		$conn = mysqli_connect('myHost','myUser','myPass') or die(mysqli_error));//database connection
		$db_select = mysqli_select_db($conn, "lolodoks") or die(mmysqli_error());//Selecting Database
		
		$res = mysqli_query() or die(mysql_error()); 
	}
 ?>
