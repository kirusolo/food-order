
<?php include('partials/menu-admin.php');  ?>


<!---main-content start here--->

    <div class="main-content">
    
    <div class="wrapper">
       <h1>Manage Restaurant Admin</h1>
       
       <br />

       <?php if(isset($_SESSION['add']))
       {


              echo $_SESSION['add'];//displaying session messeage
              unset($_SESSION['add']);//Removing session messeage 
       }
       
       if(isset($_SESSION['delete']))
       {


              echo $_SESSION['delete'];
              unset($_SESSION['delete']);
       }
       
       if(isset($_SESSION['update']))
       {


              echo $_SESSION['update'];
              unset($_SESSION['update']);
       }

       if(isset($_SESSION['user-not-found']))
       {


              echo $_SESSION['user-not-found'];
              unset($_SESSION['user-not-found']);
       }

       if(isset($_SESSION['pass-not-match']))
       {


              echo $_SESSION['pass-not-match'];
              unset($_SESSION['pass-not-match']);
       }

       if(isset($_SESSION['pass-changed']))
       {


              echo $_SESSION['pass-changed'];
              unset($_SESSION['pass-changed']);
       }
       
       
       
       
       ?>
       <br><br><br>

       <!---button to add admin--->
      
             
       <br /><br /><br />
       <table class="tbl-full">
         
       <tr>

       <th>S.N.</th>
       <th>Full name</th>
       <th>Username</th>
       <th>Actions</th>

       </tr>
      

       <?php
        //query to get all admin

        $sql = "SELECT * FROM tbl_admin";
        //execute the query
          $res = mysqli_query($conn, $sql);
        //check wheather the query is executed or  not
        if($res==TRUE)

        {
          //count rows to check whether we have data in database or not 
          $count = mysqli_num_rows($res); // function to get all the rows in database

          $sn=1;//create a variable and assgign the value


          //check the num of rows

          if($count>0)
          {
          //we have data in database
          while($rows=mysqli_fetch_assoc($res))

          {
             //using while loop to get all the data from database
             //and while loop will run as long as we have data in database
             
         // get individual data
         $id=$rows['id'];
         $full_name=$rows['full_name'];
         $username=$rows['username'];

         //Display the value in our table

        ?>
         <tr>

      <td><?php echo $sn++;?></td>
      <td><?php echo $full_name; ?></td>
       <td><?php echo $username?></td>
         <td>
      <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>"class="btn-primary">Change password</a>
     <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class=btn-secondary>Update admin</a>
     <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Deactive admin</a>

     </td>
     <tr>

        
        
         
      <?php



          }


        }
         else
         {
            //we do not have data in database
         }


          }

        
       ?>

   
       </table>


       

    </div>
     
    
    </div>
<!---main-content end here--->



<?php include('partials/footer.php'); ?>