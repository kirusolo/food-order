<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Approve Restaurant</h1>

    <br><br>

    <?php 
      //check whether id is set or not
      if(isset($_GET['id']))
       {
          //get the order details
          $id=$_GET['id'];
          //get all other details based on this id
          //sql query to get order detalis
          $sql = "SELECT * FROM tbl_resturant WHERE id=$id";
          //execute the query
          $res = mysqli_query($conn, $sql);
          //count the rows
          $count = mysqli_num_rows($res);

          if($count==1)
          {
            //detail available
            $row=mysqli_fetch_assoc($res);

            $resturant_name = $row['resturant_name'];
            $phone_number = $row['phone_number'];
            $status = $row['status'];
            
            $email = $row['email'];
            $address = $row['address'];

            


          }
          else
          {

            //detail not available
            //redirect to manage order page
            header('location:'.SITEURL.'admin/resturant_approve.php');
               

          }

       }

       else
       {
        //redirect to manage order page
        header('location:'.SITEURL.'admin/resturant_approve.php');

       }

    
    ?>

    <form action="" method="POST">

        <table class="tbl_30">

          <tr>

            <td>Restaurant Name</td>
            <td><b> <?php echo $resturant_name; ?> </b></td>

          </tr>

          </tr>  
                <tr>
                  <td>Phone Number</td>
                  <td>
                    <input type="text" name="phone_number" value="<?php echo $phone_number; ?>">
                  </td>

                </tr>

         

                <tr>
                    <td>Status</td>
                    <td>
                      
                    <select name="status">

                    <option <?php if($status=="approve"){echo "selected";} ?> value="approve">approve</option>
                    <option <?php if($status=="not_approve"){echo "selected";} ?> value="not_approve">not_approve</option>
                    
                    </select>

                    </td>
                


                
                <tr>
                  <td>Email</td>
                  <td>
                    <input type="email" name="email" value="<?php echo $email; ?>">
                  </td>

                </tr>

                
                <tr>
                  <td>Address</td>
                  <td>
                    <textarea name="address" cols="30" rows="5"><?php echo $address; ?></textarea>  
                  
                  </td>

                </tr>

                    <tr>
                        <td colspan="2">
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                        
        
                        <input type="submit" name="submit" value="Approve" class="btn-secondary">
                        </td>
                    </tr>

        </table>

    </form>

    <?php
     
     //check whether update button id clicked or not 
     if(isset($_POST['submit']))
     {

        //echo "clicked";
        //get all the values from form 
        $id = $_POST['id'];
        $resturant_name = mysqli_real_escape_string($conn, $resturant_name) ;
        $phone_number = $_POST['phone_number'];
        $status = $_POST['status']; 
        $email = $_POST['email'];
        $address = $_POST['address'];     
        //update the value

        $sql2 = "UPDATE tbl_resturant SET
        
     
        resturant_name = '$resturant_name',
        phone_number = '$phone_number',
        status = '$status',
        email = '$email',
        address = '$address'
        
        
        
        
        WHERE id=$id
        
        
        "; 

        //execute the query
        $res2 = mysqli_query($conn, $sql2);

        //check whether update or not
        //and redirect to manage order with message
          if($res2==true)
          {
             //updated 
             $_SESSION['update'] = "<div class='success'>Rerturant Approved successfully.</div>";
             header('location:'.SITEURL.'admin/resturant-approve.php');
 
          }

          else
          {

            
            $_SESSION['update'] = "<div class='error'>Failed approved resturant.</div>";
            header('location:'.SITEURL.'admin/resturant-approve.php');

          }

     }
     
    ?>


      
  </div>


</div>


<?php include('partials/footer.php'); ?>