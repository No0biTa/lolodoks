<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Manage Order</h1>
      <br>

      <?php
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
      ?>
              <br /><br/>

              <table class="tbl-full">
                <tr>
                        <th class="text-center">S.N.</th>
                        <th class="text-center">Food</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Order Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Customer Name</th>
                        <th class="text-center">Contact</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Actions</th>
                </tr>

                  <?php
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

                        $res = mysqli_query($conn, $sql);

                        $sn = 1;

                        $count = mysqli_num_rows($res);

                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];

                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $sn++;?></td>
                                    <td class="text-center"><?php echo $food;?></td>
                                    <td class="text-center"><?php echo $price;?></td>
                                    <td class="text-center"><?php echo $qty;?></td>
                                    <td class="text-center"><?php echo $total;?></td>
                                    <td class="text-center"><?php echo $order_date;?></td>
                                    <td class="text-center">
                                        <?php
                                            if ($status=="Ordered")
                                        {
                                            echo"<label>$status</label>";
                                        }elseif ($status=="On Delivery")
                                        {
                                            echo"<label style='color: orange;'>$status</label>";
                                        }elseif($status=="Delivered")
                                        {
                                            echo"<label style='color: #2ecc71'>$status</label>";
                                        }elseif ($status=="Cancelled")
                                        {
                                            echo"<label style='color: red'>$status</label>";
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $customer_name;?></td>
                                    <td class="text-center"><?php echo $customer_contact;?></td>
                                    <td class="text-center"><?php echo $customer_email;?></td>
                                    <td class="text-center"><?php echo $customer_address;?></td>
                                    <td class="text-center">
                                        <a href="<?php echo HOME;?>admin/update-order.php?id=<?php echo $id; ?>"><i class="fa-regular fa-border fa-pen-to-square" style="color: #2ecc71"></i></a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            echo "<tr><td colspan='12' class='error'>Order not Available</td></tr>";
                        }
                  ?>

              </table>

</div>

<?php include('partials/footer.php'); ?>
