<?php include ('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Order</h2>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_order WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                else
                {
                    header('location:'.HOME.'admin/manage-order.php');
                }
            }
            else
            {
                header('location:'.HOME.'admin/manage-order.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-full">

                <div class="formbold-mb-5">
                    <label for="active" class="formbold-form-label"> Food Name </label>
                    <b><?php echo $food; ?></b>
                </div>

                <div class="formbold-mb-5">
                    <label for="title" class="formbold-form-label"> Price </label>
                    <b>Rp. <?php echo $price; ?></b>
                </div>

                <div class="formbold-mb-5">
                    <label for="title" class="formbold-form-label"> Qty </label>
                    <input type="number" name="qty" class="formbold-form-input" value="<?php echo $qty; ?>">
                </div>

                <div>
                    <div class="formbold-mb-5">
                        <label for="title" class="formbold-form-label"> Status </label>
                    </div>
                        <select name="status" class="formbold-form-input">
                            <option <?php if ($status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                            <option <?php if ($status=="On Delivery"){echo "selected";}?> value="On Delivery">On Delivery</option>
                            <option <?php if ($status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                            <option <?php if ($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                        </select>
                </div>

                <div class="formbold-mb-5">
                    <label for="title" class="formbold-form-label"> Customer Name </label>
                    <input type="text" name="customer_name" class="formbold-form-input" value="<?php echo $customer_name; ?>">
                </div>

                <div class="formbold-mb-5">
                    <label for="title" class="formbold-form-label"> Customer Contact </label>
                    <input type="text" name="customer_contact" class="formbold-form-input" value="<?php echo $customer_contact; ?>">
                </div>

                <div class="formbold-mb-5">
                    <label for="title" class="formbold-form-label"> Customer Email </label>
                    <input type="text" name="customer_email" class="formbold-form-input" value="<?php echo $customer_email; ?>">
                </div>

                <div class="formbold-mb-5">
                    <label for="title" class="formbold-form-label"> Customer Address </label>
                    <textarea name="customer_address" cols="30" rows="5" class="formbold-form-textarea"><?php echo $customer_address; ?></textarea>
                </div>

                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="hidden" name="price" value="<?php echo $price;?>">
                <input type="submit" name="submit" value="Update Food" class="btn btn-default waves-teal btn-success">

            </table>

        </form>

        <?php
                if(isset($_POST['submit']))
                {
                //                        echo "Button Clicked";
                //                        Get all detail from the form
                    $id = $_POST['id'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; //total harga * jumlah

                    $status = $_POST['status']; //Ordered, on delibery, cancelled

                    $customer_name = $_POST['customer_name'];
                    $customer_contact = $_POST['customer_contact'];
                    $customer_email = $_POST['customer_email'];
                    $customer_address = $_POST['customer_address'];

                    $sql2 = "UPDATE tbl_order SET
                        qty = $qty,
                        total = $total,
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                        WHERE id=$id
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true)
                    {
                        $_SESSION['update'] = "<div class='success'> Order Successfully Updated.</div>";
                        echo "<script> window.location.href='manage-order.php';</script>";
                    }
                    else
                    {
                        $_SESSION['update'] = "<div class='success'> Failed to Update Order.</div>";
                        header('location:'.HOME.'admin/manage-order.php');
                    }
                }
        ?>

    </div>
</div>

<?php include ('partials/footer.php');?>