<?php include('partials/menu.php'); ?>

<div class="main-content">
    
    <div class="wrapper">
       <h1>Manage food</h1>

       <br /><br />

       <!---button to add admin--->
       <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
             
       <br /><br /><br />

          <?php
               
               if(isset($_SESSION['add']))
            {
     
     
                   echo $_SESSION['add'];
                   unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
     
     
                   echo $_SESSION['delete'];
                   unset($_SESSION['delete']);
            }

            
            if(isset($_SESSION['upload']))
            {
     
     
                   echo $_SESSION['upload'];
                   unset($_SESSION['upload']);
            }

            if(isset($_SESSION['unautorize']))
            {
     
     
                   echo $_SESSION['unautorize'];
                   unset($_SESSION['unautorize']);
            }


            if(isset($_SESSION['update']))
            {
     
     
                   echo $_SESSION['update'];
                   unset($_SESSION['update']);
            }

        
        
        
          ?>


       <table class="tbl-full">
         
       <tr>

       <th>S.N.</th>
       <th>Title</th>
       <th>Price</th>
       <th>Image</th>
       <th>featured</th>
       <th>Active</th>
       <th>Actions</th>


       </tr>

              <?php
              if(isset($_SESSION['restaurant_id']))
              {
                     $restaurant_id = $_SESSION['restaurant_id'];
              }
       
              //create sql query to get all the food
              $sql = "SELECT tbl_food.*, tbl_food.category_id, tbl_category.restaurant_id FROM tbl_food, tbl_category, tbl_resturant WHERE tbl_category.id = tbl_food.category_id && tbl_resturant.id = tbl_category.restaurant_id && tbl_resturant.id = $restaurant_id";

              //execute the query
              $res = mysqli_query($conn, $sql);

              //count the rows whether we have foods or not 
              $count = mysqli_num_rows($res);

              //create serial number and set defalut value as 1
              $sn=1;


              if($count>0)
              {
                //we have food in database
                //get the foods from database and display
                while($row=mysqli_fetch_assoc($res))
                {
                  //get the values from individual colums
                  $id = $row['id'];
                  $title = $row['title'];
                  $price = $row['price'];
                  $image_name = $row['image_name'];
                  $featured = $row['featured'];
                  $active = $row['active'];

                  ?>
 
                   <tr>

                     <td><?php echo $sn++; ?>.</td>
                     <td><?php echo $title; ?></td>
                     <td><?php echo $price; ?></td>
                     <td>
                        <?php 
                         
                            //check whether we have image or not
                           if($image_name=="")
                           {
                              //we dont have image
                              "echo <div class='error'>Image not added</div>";

                           }

                           else
                           {
                                 
                               //we have image, display imaage
                               ?>
                                     <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">

                               <?php
                           }

                        ?>
                     </td>
                      <td><?php echo $featured; ?></td>
                      <td><?php echo $active; ?></td>
                            <td>
                 <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class=btn-secondary>Update Food</a> 
               <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class=btn-danger>Delete Food</a>
</td>


</tr>
                  <?php


                }


              }
              else
              {
                //food not added in database
                echo "<tr> <td colspan='7' class='error'> Food not added yet.</td> </tr>";

              }
 
              ?>


       </table>



    </div>
     
    
    </div>


<?php include('partials/footer.php'); ?>