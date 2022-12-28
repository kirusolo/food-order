<?php
include('../config/constants.php');
//echo "delete success"; 
if(isset($_GET['id']) AND isset($_GET['image_name']))

{
  //process to delete
  //echo "process to delete"; 
//1 get id and image name 
$id = $_GET['id'];
$image_name = $_GET['image_name'];


//2 remove the image if avilable
//check whether the image is avliabel or not delete only if avaliable
if($image_name != "")
{
    //it has image and need to remove from folder 
    //get the image path
    $path = "../images/food/".$image_name;

    //remove image file from folder
    $remove = unlink($path);
    //check whether the image is removed or not 
    if($remove==false)
    {
        //failed to remove image
        $_SESSION['upload'] = "<div class='error'>faild to remove image file.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
        //stop the process of deleting food
        die();


    }
}


//3 delete food from database
$sql = "DELETE FROM tbl_food WHERE id=$id";
//execute the query
$res = mysqli_query($conn, $sql);

//check whether the query executed or not and set the session message respectively
if($res==true)
{
    //food deleted
    $_SESSION['delete'] = "<div class='success'>Food deleted successfully.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

else
{
    // failed to delete food
    $_SESSION['delete'] = "<div class='error'>Failed to delete food.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

//4 redirect to manage food with session message



}

else
{
    //rediret page
    //echo "redirect";
    $_SESSION['unautorize'] = "<div class='error'>unautorized section.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
} 
 



?>