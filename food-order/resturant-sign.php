<?php include('partials-front/menu.php'); ?>

<div class="main-content">
 <div class="wrapper">
    <h1 style="text-align: left; width: 50%; margin-top: 30px; color: green">Sign here only for restaurant's</h1>


        <br><br>

       <form action="" method="POST" class="order">

       
       

                    
       
               
     
       
                    
                
                    <div class="order-label">Resturant Name</div>
                    <input type="text" name="resturant name" placeholder="Ours caffe" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="phone_number" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. kirubelendala15@gmail.com" class="input-responsive" required>

                    <div class="order-label">Username</div>
                    <input type="text" name="username" placeholder="Username" class="input-responsive" required>

                    <div class="order-label">Password</div>
                    <input type="password" name="password" placeholder="Password" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Sign Up" class="btn btn-primary">

                   
                    
              
                    

            </form>

            <?php

if(isset($_POST['submit']))
{
    //get the details from the form
    $resturant_name = mysqli_real_escape_string($conn, $_POST['resturant_name']) ;
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password =  md5($_POST['password']);
    $address = $_POST['address'];

//create sql querry 
          
      $sql2 = "INSERT INTO tbl_resturant SET
       resturant_name = '$resturant_name',
       phone_number = '$phone_number',
       email = '$email',
       status = 'not_approve',
       address = '$address'";

    //execute the query
    $res2 = mysqli_query($conn, $sql2);

  //check whether query executed successfully or not 
    if($res2==true)
       {

        $last_id = mysqli_insert_id($conn);
  
        $sql3 = "INSERT INTO tbl_admin SET
        user_type = 'restaurant',
        restaurant_id = '$last_id',
        full_name = '$resturant_name',
        username = '$username',
        password = '$password'";

        $res3 = mysqli_query($conn, $sql3);

        if($res3==true)
            echo "sign up successfully";
        else
            echo "sign up faild";

   //faild to sign resturant

         }
         else
            echo "sign up faild";



}

?>


  
  


        


<?php include('partials-front/footer.php'); ?>