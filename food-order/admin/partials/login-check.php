<?php
//autorization - access control
//check whether the user is logged in or out
if(!isset($_SESSION['user']))//if user session is not set
{
 //user is not logged in

 //redirect to login page with messeage
 $_SESSION['no-login-messeage'] = "<div class='error text-center'>please login to access admin panel.</div>";
//redirect to login page
 header('location:'.SITEURL.'admin/login.php');

}
?>