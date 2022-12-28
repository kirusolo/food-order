<?php include('partials/menu-admin.php'); ?>

<div class="main-content">
    
    <div class="wrapper">
       <h1>Manage order</h1>

       
             
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
       <th>Food</th>
       <th>Price</th>
       <th>Qty</th>
       <th>Total</th>
       <th>Order Date</th>
       <th>Status</th>
       <th>Customer Name</th>
       <th>Conatct</th>
       <th>Email</th>
       <th>Address</th>
       <th>Actions</th>


       </tr>

       <?php
          $restaurant_id = $_SESSION['restaurant_id'];
          //get all the orders form  from database that has displayed on the admin panel
          $sql = "SELECT * FROM tbl_order ORDER BY order_date DESC";// display the leatest order at first

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
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $total = $row['total'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_conatct = $row['customer_conatct'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
                 
                ?>

                <tr>

             <td><?php echo $sn++; ?>.</td>
             <td><?php echo $food; ?></td>
             <td><?php echo $price; ?></td>
             <td><?php echo $qty; ?></td>
             <td><?php echo $total; ?></td>
             <td><?php echo $order_date; ?></td>

             <td>
                <?php 
                //ordered , on delivery, delivery, cancelled
                if($status=="ordered")
                   {
                      echo "<label>$status</label>";

                   }

                   elseif($status=="on delivery")
                   {
                    echo "<label style='color: orange;'>$status</label>";

                   }

                   
                   elseif($status=="paid")
                   {
                    echo "<label style='color: blue;'>$status</label>";

                   }

                   
                   elseif($status=="delivered")
                   {
                    echo "<label style='color: green;'>$status</label>";

                   }

                   
                   elseif($status=="cancelled")
                   {
                    echo "<label style='color: red;'>$status</label>";

                   }
                     
                
                ?>
            </td>

             <td><?php echo $customer_name; ?></td>
             <td><?php echo $customer_conatct; ?></td>
             <td><?php echo $customer_email; ?></td>
             <td><?php echo $customer_address; ?></td>

                <td>
          <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class=btn-secondary>Update Order</a>
            
    
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