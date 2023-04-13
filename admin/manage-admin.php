<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Start -->
        <div class="main-content">
          <div class="wrapper">
              <h2>Manage Admin</h2>
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?><br/>
              <!-- Button to Add Admin -->
              <a href="add-admin.php"><button type="button" class="btn btn-default waves-effect waves-light">Add Admin</button></a>

              <br /><br/>

              <table class="tbl-full">
                <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                </tr>

                  <?php //Query untuk mendapatkan list semua data admin
                      $sql = "SELECT * FROM tbl_admin";
                      //Execute the query
                      $res = mysqli_query($conn, $sql);

                  //Check query executed atau tidak
                  if($res==TRUE)
                  {
                      $count = mysqli_num_rows($res); //function untuk mendapatkan semua data di database

                      $sn=1; //variable untuk assign value
                      if($count>0)
                      {
                          //Data sudah ada dalam database
                          while($rows=mysqli_fetch_assoc($res))
                          {
                              //Gunakan WHile loop untuk mendapatkan data
                              //while loop akan terus berjalan selama database mempunyai data
                              $id=$rows['id'];
                              $full_name=$rows['full_name'];
                              $username=$rows['username'];

                              //DIsplay value dalam table
                              ?>
                              <tr>
                                  <td><?php echo $sn++?></td>
                                  <td><?php echo $full_name?></td>
                                  <td><?php echo $username?></td>
                                  <td>
                                      <a href="#" class="btn btn-default waves-teal btn-success">Update Admin</a>
                                      <a href="#" class="btn btn-default waves-teal btn-danger">Delete Admin</a>
                                  </td>
                              </tr>
                            <?php
                          }
                      }else{
                          //Data tersebut tidak ada
                      }
                  }

                  ?>
              </table>

           </div>
        </div>
        <!-- Main Content Seciton End -->

        <!-- Javascript Material -->
      <script type="text/javascript" src="../js/material.js"></script>

<?php include('partials/footer.php'); ?>
