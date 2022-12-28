<?php include('partials/menu.php') ?>

<div class="main-content">

<div class="wrapper">
    <h1>Update Admin</h1>

    <br><br>

    <?php
       
          //1 get the id of selected item
               $id=$_GET['id'];
          //2 create sql query to get the details
              $sql="SELECT * FROM tbl_admin WHERE id=$id";

         //execute the query
              $res=mysqli_query($conn, $sql);

        //check whether the query is executed
        if($res==true)
        {
         // check whether the data is avaliable or not 
         $count = mysqli_num_rows($res);
         //check whether we have admin data or not
         if($count==1)
         {
           
          // get the details
          //echo "admin available";
          $row=mysqli_fetch_assoc($res);

          $full_name = $row['full_name'];
          $username = $row['username'];


         }
         else 
         {
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
         }

        }
    ?>

    <form action="" method="POST">
    <table class="tbl-30">
     <tr>
          
       <td>Full name:</td>
       <td>
        <input type="text" name="Full_name" value="<?php echo $full_name;?>">
    </td>

       </tr>

       <tr>
          
          <td>Username:</td>
          <td>
            <input type="text" name="Username" value="<?php echo $username;?>">
        </td>
   
          </tr>   

          <tr>
          
          <td colspan="2">
           <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="submit" name="submit" value="Update Admin" class="btn-secondary">

          </td>
          </tr> 

</table>


    </form>

</div>
</div>

<?php

//check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
   // echo "button clicked";
   //get all values from form to update
   
 $id = $_POST['id'];
 $Full_name = $_POST['Full_name'];
 $Username = $_POST['Username'];

//create sql query to update admin 
$sql = "UPDATE tbl_admin SET
Full_name = '$Full_name',
Username = '$Username' 
WHERE id='$id'

";


//execute the query
$res = mysqli_query($conn, $sql);

//check whether the query executed sucssfully or not

if($res==true)
{
        //query executed and admin updated
         $_SESSION['update'] = "<div class='success'>admin updated sucssfully.</div>";
       //redirect to manage admin page
 
        header('location:'.SITEURL.'admin/manage-admin.php');

}

else
{
//failed to update admin
 //query executed and admin updated
 $_SESSION['update'] = "<div class='error'>failed to update.</div>";
 //redirect to manage admin page

  header('location:'.SITEURL.'admin/manage-admin.php');




}

}

?>

<?php include('partials/footer.php') ?>