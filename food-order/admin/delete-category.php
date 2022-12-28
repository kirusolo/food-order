<?php
//include constant file
include('../config/constants.php');

//check whether the id and image value set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
//get the value and delete
//echo "get the value and delete";
$id = $_GET['id'];
$image_name = $_GET['image_name'];

//remove the physical image file is avaliable 
if($image_name != "")
{
    //image is avaliable so remove it
    $path = "../images/category/".$image_name;
    //remove the image 
    $remove = unlink($path);

    //if faild to remove image then add an error message and stop the process
    if($remove==false)
    {
          
      //set the session messseage 
      $_SESSION['remove'] = "<div class='error'>failed to remove category image.</div>";
      //redirect to manage category page with messeage
      header('location:'.SITEURL.'admin/manage-category.php');
      //stop the process 
      die();  

    }
}
//delete data from databse
//sql query to delete data from database 
$sql = "DELETE FROM tbl_category WHERE id=$id";

//execute the query 
$res = mysqli_query($conn, $sql);

//check whether the delete from database or not

if($res==true)
{
    //set sucess message and redirect
    $_SESSION['delete'] = "<div class='success'>Category delete successfully.</div>";  
    //redirect to manage category
    header('location:'.SITEURL.'admin/manage-category.php');
}

else
{
    //set failed message and redirect
    $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";  
    //redirect to manage category
    header('location:'.SITEURL.'admin/manage-category.php');
    

}





}
  

else
{
    //redirect to manage category page
    header('location:' .SITEURL.'admin/manage-category.php');
}

?>