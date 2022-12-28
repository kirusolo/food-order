<?php include('partials/menu.php') ?>

<div class="main-content">

      <div class="wrapper">
      <h1>Change password</h1>

      <br><br>
      <?php
           if(isset($_GET['id']))
           $id=$_GET['id'];
      ?>
    
       <form action="" method="POST">
       <table class="tbl-30">

      <tr>
       <td>Current password: </td>
       <td>
           <input type="password" name="Current_password" placeholder="Current password">
       </td>

       </tr> 
          
       <tr>
       <td>New password: </td>
       <td>
           <input type="password" name="New_password" placeholder="New password">
       </td>

       </tr>

       <tr>
       <td>Confirm password: </td>
       <td>
           <input type="password" name="Confirm_password" placeholder="Confirm password">
       </td>

       </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id;?>">
          <input type="submit" name="submit" value="Change password" class="btn-secondary">
          

          </td>

        </tr>



       </table>


       </form>



      </div>

</div>

<?php

//check whether the button is clicked or not 
if(isset($_POST['submit']))
{
 //echo "clicked";
 //1 get data from form
 $id=$_POST['id'];
 $Current_password = md5($_POST['Current_password']);
 $New_password = md5($_POST['New_password']);
 $Confirm_password = md5($_POST['Confirm_password']);

 //2 check whether the user with the current id and current password exists or not
 $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$Current_password'";

  //execute the query
 $res = mysqli_query($conn, $sql);

 if($res==true)
 {
  //chceck whether the data is avilabile or not
  $count=mysqli_num_rows($res);

  if($count==1)
  {
    //user exists and password can be changed
     //echo "user found";
     //check whether the new password and confirm password macth or not
     if($New_password==$Confirm_password)
     {
        //update password
       $sql2 = "UPDATE tbl_admin SET
        password='$New_password' 
        WHERE id=$id;
       ";
       //execute the querry
       $res2 = mysqli_query($conn, $sql2);
       //check whether the query is executed or not
       if($res2==true)
       {

        //display success messeage
        //redirect to manage admin page with sucess message
        $_SESSION['pass-changed'] = "<div class='success'>password changed successfully.</div>";
    //redirect the user
    header('location:'.SITEURL.'admin/manage-admin.php');

       }
       else
       {
        //display error message
        $_SESSION['pass-changed'] = "<div class='error'>password did't changed.</div>";
    //redirect the user
    header('location:'.SITEURL.'admin/manage-admin.php');

       }

     }

     else
     {
      //redirect to manage admin page
      $_SESSION['pass-not-match'] = "<div class='error'>password did't macth.</div>";
    //redirect the user
    header('location:'.SITEURL.'admin/manage-admin.php');

     }
  }

  else
  {
    $_SESSION['user-not-found'] = "<div class='error'>user not found.</div>";
    //redirect the user
    header('location:'.SITEURL.'admin/manage-admin.php');
  }  
 }

  //


}
?>

<?php include('partials/footer.php') ?>