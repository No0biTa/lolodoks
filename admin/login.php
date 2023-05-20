<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>
            <br><br>

            <!-- Login Form Starts Here -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>

            <p class="text-center">Created by Kelompok 6</p>
        </div>
    
    </body>
</html>

<?php
    //check
    if(isset($_POST['submit']))
    {
        //proses login
        //mengambil data
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //SQL check
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password ='$password'";

        //execute the Query
        $res = mysqli_query($conn, $sql);

        //count rows
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class='success'>Login Successfull. </div>";
            $_SESSION['user'] = $username;

            header('location:'.HOME.'admin/');
        }
        else
        {
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match. </div>";
            header('location:'.HOME.'admin/login.php');
        }

    }
?>