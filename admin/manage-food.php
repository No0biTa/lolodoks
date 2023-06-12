<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Manage Food</h1>
    
     <br />
              <!-- Button to Add Admin -->
              <a href="<?php echo HOME;?>admin/add-food.php"><button type="button" class="btn btn-default waves-effect waves-light">Add Food</button></a>

              <br /><br/>

                  <?php
                  if(isset($_SESSION['add_food']))
                  {
                      echo $_SESSION['add_food'];
                      unset($_SESSION['add_food']);
                  }
                  ?>

              <table class="tbl-full">
                <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                </tr>

                  <?php
//                    Create SQL query
                  $sql = "SELECT * FROM tbl_food";

//                  Execute the query
                  $res = mysqli_query($conn, $sql);

                  $sn=1;

                  $count = mysqli_num_rows($res);

                  if($count>0)
                  while($row=mysqli_fetch_assoc($res))
                  {
//                    Get data from individu colums
                      $id = $row['id'];
                      $title = $row['title'];
                      $price = $row['price'];
                      $image_name = $row['image_name'];
                      $description = $row['description'];
                      $featured = $row['featured'];
                      $active = $row['active'];
                      ?>

                      <tr>
                          <td><?php echo $sn++;?></td>
                          <td<?php echo $title;?></td>
                          <td>Rp.<?php echo $price;?></td>
                          <td>
                              <?php
                                if($image_name=="")
                              {
                                  echo "<div class='error'> Image Not Added.</div>";
                              }
                                else
                              {
                                  ?>
                                  <img src="<?php echo HOME;?>images/food/<?php echo $image_name; ?>" width="100px">
                              <?php
                              }
                              ?>
                              </td>
                          <td><?php echo $description;?>></td>
                          <td><?php echo $featured;?></td>
                          <td><?php echo $active;?></td>
                          <td>
                              <a href="#" class="btn btn-default waves-teal btn-success">Update Food</a>
                              <a href="#" class="btn btn-default waves-teal btn-danger">Delete Food</a>
                          </td>
                      </tr>
                  <?php
                  }
                  else
                  {
                      echo "<tr><td colspan='7' class='error'>Food not Added Yet.</td></tr>";
                  }
                  ?>

              </table>

</div>

<?php include('partials/footer.php'); ?>
