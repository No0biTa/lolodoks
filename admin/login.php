<?php include('../config/constants.php'); ?>

    <html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>MakanYuk | Login</title>
        <link rel="stylesheet" href='/css/login.css'>
    </head>
    <body>
    <div class="center">
        <h1>Login</h1>
        <div class="error signup_link">Please login first to access admin panel</div>
        <form action="" method="POST">
            <div class="txt_field">
                <input type="text" name="username" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <input type="submit" name="submit" value="Login">
            <div class="signup_link"></div>
        </form>
    </div>

    </body>
    </html>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>


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