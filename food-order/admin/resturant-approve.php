
<?php include('partials/menu-admin.php'); ?>

<div class="main-content">
    
    <div class="wrapper">
       <h1>Approve Resturant's</h1>

       
             
       <br /><br /><br />

        <?php  
        
        if(isset($_SESSION['update']))
       {


              echo $_SESSION['update'];
              unset($_SESSION['update']);
       }
        
        
        ?>

        <br><br>



       <table class="tbl-full">
         
       <tr>

       <th>S.N.</th>
       <th>Resturant Name</th>
       <th>Phone Number</th>
       <th>status</th>
       <th>Email</th>
       <th>Address</th>
       <th>Actions</th>


       </tr>

       <?php

          //get all the orders form  from database that has displayed on the admin panel
          $sql = "SELECT * FROM tbl_resturant ORDER BY id DESC";// display the leatest order at first

           //execute the query
           $res = mysqli_query($conn, $sql);

           //count the rows
           $count = mysqli_num_rows($res);

           $sn = 1; //create serial number and set its initial value as 1

           if($count>0)
           {

            //order available
            while($row=mysqli_fetch_assoc($res))
            {
                //get all the order details
                $id = $row['id'];
                $resturant_name = $row['resturant_name'];
                $phone_number = $row['phone_number'];
                $status = $row['status'];
                $email = $row['email'];
                $address = $row['address'];
                 
                ?>

                <tr>

             <td><?php echo $sn++; ?>.</td>
             <td><?php echo $resturant_name; ?></td>
             <td><?php echo $phone_number; ?></td>
             <td> <?php echo $status; ?> </td>
             <td><?php echo $email; ?></td>
             <td><?php echo $address; ?></td>

             
             

                <td>
          <a href="<?php echo SITEURL; ?>admin/approve-res.php?id=<?php echo $id; ?>" class=btn-secondary>Approve Restaurant</a>
            
    
              </td>
              </tr>
                
                 
                <?php
            }

           }
            
           else
           {
            //order not available
            echo "<tr><td colspan='12' class='error'>Order not available</td></tr>";

           }


        

        ?>

 
       </table>



    </div>
     
    
    </div>


<?php include('partials/footer.php'); ?>