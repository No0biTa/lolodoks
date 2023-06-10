<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Start -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br>

                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }

                    // Cek apakah admin sudah login
                    if (!isset($_SESSION['user'])) {
                        // Jika belum login, alihkan ke halaman login
                        header("location:".HOME."admin/login.php");
                        exit(); // Pastikan kode berhenti di sini dan tidak melanjutkan eksekusi
                    }

                ?>


                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    Categories
                </div>

                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    Categories
                </div>

                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    Categories
                </div>

                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br />
                    Categories
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Content Seciton End -->

<?php include('partials/footer.php'); ?>
