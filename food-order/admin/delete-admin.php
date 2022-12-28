<?php

//include constants.php file here
include('../config/constants.php');

// get the id of the admin to be deleted 
$id = $_GET['id'];

//create sql querry to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

// exceute the query
$res = mysqli_query($conn, $sql);

//check whether the query executed sucssfully or not
if($res==true)
{
//executed sucssfully and admin deleted
//echo "admin deleted";
//create session variable to displsay messege
$_SESSION['delete'] = "<div class='success'>admin deleted succssfully.</div>";
//redirect to manage admin page
header('location:' .SITEURL.'admin/manage-admin.php');
}
else
{
//faild to delete
//echo "faild to delete";
$_SESSION['delete'] = "<div class='error'>faild to delete admin try agin later.</div>";
header('location:' .SITEURL.'admin/manage-admin.php');
}

//redirect to manage admin page with messeage(success or error)



?>